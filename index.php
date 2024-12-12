<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do list!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            background-color: #d8bbf1; 
        }

        .container {
            background-color: #f7c9d6; 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #a0c9f1;
            border: none;
            color: white;
            margin: 5px;
        }

        .btn-custom:hover {
            background-color: #8bb8d1; 
        }

        .task-list {
            margin-top: 20px;
        }

        .task-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }

        .task-list button {
            margin-left: 5px;
        }

        h1 {
            text-align: center;
            color: #4e4e4e;
        }
    </style>
    <script>
        let taskCounter = 1;
        const tasks = [];


        function addTask() {
            const taskName = document.getElementById("taskName").value;
            if (taskName === "") return;

            const task = {
                id: taskCounter++,
                name: taskName,
                completed: false
            };
            tasks.push(task);
            updateTaskList();
            document.getElementById("taskName").value = ""; 
        }

     
        function removeTask(taskId) {
            const index = tasks.findIndex(task => task.id === taskId);
            tasks.splice(index, 1);
            updateTaskList();
        }

  
        function markComplete(taskId) {
            const task = tasks.find(task => task.id === taskId);
            task.completed = !task.completed;
            updateTaskList();
        }


        function editTask(taskId) {
            const newTaskName = prompt("Edit your task:");
            if (newTaskName) {
                const task = tasks.find(task => task.id === taskId);
                task.name = newTaskName;
                updateTaskList();
            }
        }


        function filterTasks(status) {
            const filteredTasks = tasks.filter(task => (status === "all") || (status === "completed" && task.completed) || (status === "pending" && !task.completed));
            displayTasks(filteredTasks);
        }

        function updateTaskList() {
            displayTasks(tasks);
        }

        function displayTasks(taskList) {
            const taskListElement = document.getElementById("taskList");
            taskListElement.innerHTML = "";
            taskList.forEach(task => {
                const taskElement = document.createElement("li");
                taskElement.innerHTML = `
                    <span style="text-decoration: ${task.completed ? 'line-through' : 'none'}">${task.name}</span>
                    <div>
                        <button class="btn-custom" onclick="editTask(${task.id})">Edit</button>
                        <button class="btn-custom" onclick="removeTask(${task.id})">Delete</button>
                        <button class="btn-custom" onclick="markComplete(${task.id})">${task.completed ? 'Undo' : 'Complete'}</button>
                    </div>
                `;
                taskListElement.appendChild(taskElement);
            });
        }
    </script>
</head>
<body>

    <div class="container mt-5">
        <h1>to-do list</h1>


        <div class="mb-3">
            <input type="text" id="taskName" class="form-control" placeholder="Enter your task:">
            <button class="btn-custom btn mt-3" onclick="addTask()">Add</button>
        </div>

        <div class="mb-3">
            <button class="btn-custom btn" onclick="filterTasks('all')">All Tasks</button>
            <button class="btn-custom btn" onclick="filterTasks('completed')">Completed</button>
            <button class="btn-custom btn" onclick="filterTasks('pending')">Not Completed</button>
        </div>


        <ul id="taskList" class="task-list">

        </ul>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
