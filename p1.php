<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script>
        let taskCounter = 1;
        const tasks = [];

        // Function to add a task
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
        }

        // Function to remove a task
        function removeTask(taskId) {
            const index = tasks.findIndex(task => task.id === taskId);
            tasks.splice(index, 1);
            updateTaskList();
        }

        // Function to mark task as completed
        function markComplete(taskId) {
            const task = tasks.find(task => task.id === taskId);
            task.completed = !task.completed;
            updateTaskList();
        }

        // Function to edit a task
        function editTask(taskId) {
            const newTaskName = prompt("Edit your task:");
            if (newTaskName) {
                const task = tasks.find(task => task.id === taskId);
                task.name = newTaskName;
                updateTaskList();
            }
        }

        // Function to filter tasks by status
        function filterTasks(status) {
            const filteredTasks = tasks.filter(task => (status === "all") || (status === "completed" && task.completed) || (status === "pending" && !task.completed));
            displayTasks(filteredTasks);
        }

        // Function to update the task list
        function updateTaskList() {
            displayTasks(tasks);
        }

        // Function to display tasks on the page
        function displayTasks(taskList) {
            const taskListElement = document.getElementById("taskList");
            taskListElement.innerHTML = "";
            taskList.forEach(task => {
                const taskElement = document.createElement("li");
                taskElement.innerHTML = `
                    <span style="text-decoration: ${task.completed ? 'line-through' : 'none'}">${task.name}</span>
                    <button onclick="editTask(${task.id})">Edit</button>
                    <button onclick="removeTask(${task.id})">Delete</button>
                    <button onclick="markComplete(${task.id})">${task.completed ? 'Undo' : 'Complete'}</button>
                `;
                taskListElement.appendChild(taskElement);
            });
        }
    </script>
</head>
<body>
    <h1>Task Manager</h1>
    
    <div>
        <input type="text" id="taskName" placeholder="Enter your task">
        <button onclick="addTask()">Add Task</button>
    </div>
    
    <div>
        <button onclick="filterTasks('all')">All Tasks</button>
        <button onclick="filterTasks('completed')">Completed</button>
        <button onclick="filterTasks('pending')">Pending</button>
    </div>
    
    <ul id="taskList">
        <!-- Tasks will appear here -->
    </ul>
</body>
</html>

