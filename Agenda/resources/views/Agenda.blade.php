<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b1f27;
            color: #cbd0f7;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        header {
            background-color: #181920;
            padding: 20px;
            text-align: center;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Centralizar verticalmente */
        }

        header h1 {
            margin: 0;
        }

        header button {
            background-color: #5568fe;
            color: #cbd0f7;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 10px; /* Adicionando margem à esquerda */
        }

        header button:hover {
            background-color: #5568fe;
        }

        #task-form {
            max-width: 650px;
            width: 100%;
            margin: 35px;
            padding: 20px;
            background-color: #181920;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #task-list {
            max-width: 650px;
            width: 100%;
            margin: 10px;
            padding: 20px;
            background-color: #181920;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            padding: 15px;
            background-color: #252a34;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        li:hover {
            background-color: #252a34;
        }

        button {
            background-color: #5568fe;
            color: #cbd0f7;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            margin-right: 5px;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5568fe;
        }

        .done {
            background-color: #1e222b;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        label {
            margin-bottom: 10px;
        }

        input {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .task-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .task-buttons button {
            background-color: #5568fe;
            color: #cbd0f7;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .task-buttons button.done {
            background-color: #4caf50; /* Cor de fundo para o botão de check */
            color: #fff; /* Cor do texto para o botão de check */
        }

        .task-buttons button.delete {
            background-color: #ff5252; /* Cor de fundo para o botão de delete */
            color: #fff; /* Cor do texto para o botão de delete */
        }

        .task-buttons button:hover {
            background-color: #5568fe;
        }

        .no-tasks-message {
            margin-top: 20px;
            display: none;
        }

        .no-tasks-message.show {
            display: block;
            color: #5568fe;
            font-weight: bold;
        }
        
        h1{
            position: relative;
            left: 2.5%;
        }

    </style>
</head>
<body>
    <header>
        <h1>Agenda de Tarefas</h1>
        <button id="logoutButton">Sair</button>
    </header>

    <div id="task-form">
        <h2>Adicionar Tarefa</h2>
        <form id="add-task-form">
            <label for="task">Tarefa:</label>
            <input type="text" id="task" required>
            <label for="date">Data:</label>
            <input type="date" id="date" required>
            <label for="time">Hora:</label>
            <input type="time" id="time" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
    

    <div id="task-list">
        <h2>Lista de Tarefas</h2>
        <input type="text" id="search" placeholder="Pesquisar tarefas" oninput="searchTasks()">
        <ul id="tasks"></ul>
        <p class="no-tasks-message">Todas as tarefa foram realizadas</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('add-task-form');
            const taskInput = document.getElementById('task');
            const dateInput = document.getElementById('date');
            const timeInput = document.getElementById('time');
            const taskList = document.getElementById('tasks');
            const noTasksMessage = document.querySelector('.no-tasks-message');
            const logoutButton = document.getElementById('logoutButton');
            let editedTask = null;

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const taskText = taskInput.value.trim();
                const taskDate = dateInput.value;
                const taskTime = timeInput.value;

                if (taskText !== '' && taskDate !== '' && taskTime !== '') {
                    if (editedTask) {
                        updateTask(editedTask, taskText, taskDate, taskTime);
                        editedTask = null;
                    } else {
                        addTask(taskText, taskDate, taskTime);
                    }

                    taskInput.value = '';
                    dateInput.value = '';
                    timeInput.value = '';

                    // Mostrar a mensagem apenas se houver tarefas
                    noTasksMessage.classList.toggle('show', taskList.children.length === 0);
                }
            });

            logoutButton.addEventListener('click', function () {
                // Adicione aqui a lógica para fazer logout
                alert('Logout realizado com sucesso!');
            });

            function addTask(text, date, time) {
                const li = document.createElement('li');
                li.textContent = `${text} - ${date} ${time}`;

                const taskButtons = createTaskButtons();

                li.appendChild(taskButtons);
                taskList.appendChild(li);

                // Esconder a mensagem
                noTasksMessage.classList.remove('show');
            }

            function createTaskButtons() {
                const taskButtons = document.createElement('div');
                taskButtons.classList.add('task-buttons');

                const editButton = document.createElement('button');
                editButton.textContent = 'Editar';
                editButton.addEventListener('click', function () {
                    editTask(taskButtons.parentElement);
                });

                const deleteButton = document.createElement('button');
                deleteButton.innerHTML = '&#10006;'; // Código HTML para o ícone de X
                deleteButton.classList.add('delete'); // Adiciona a classe 'delete'
                deleteButton.addEventListener('click', function () {
                    deleteTask(taskButtons);
                });

                const doneButton = document.createElement('button');
                doneButton.innerHTML = '&#10003;'; // Código HTML para o ícone de check
                doneButton.classList.add('done'); // Adiciona a classe 'done'
                doneButton.addEventListener('click', function () {
                    confirmMarkAsDone(taskButtons.parentElement);
                });

                taskButtons.appendChild(editButton);
                taskButtons.appendChild(deleteButton);
                taskButtons.appendChild(doneButton);

                return taskButtons;
            }

            function editTask(taskElement) {
                const taskText = taskElement.textContent.split('-')[0].trim();
                const taskDate = taskElement.textContent.split('-')[1].trim().split(' ')[0];
                const taskTime = taskElement.textContent.split(' ')[2].trim();
                editedTask = taskElement;

                taskInput.value = taskText;
                dateInput.value = taskDate;
                timeInput.value = taskTime;
            }

            function updateTask(taskElement, newText, newDate, newTime) {
                taskElement.textContent = `${newText} - ${newDate} ${newTime}`;
            }

            function deleteTask(taskButtons) {
                taskButtons.parentElement.remove();

                // Mostrar a mensagem se não houver mais tarefas
                noTasksMessage.classList.toggle('show', taskList.children.length === 0);
            }

            function confirmMarkAsDone(taskElement) {
                const isConfirmed = confirm('A tarefa foi realizada');
                if (isConfirmed) {
                    markTaskAsDone(taskElement);
                }
            }

            function markTaskAsDone(taskElement) {
                taskElement.classList.add('done');
                setTimeout(function () {
                    deleteTask(taskElement);
                }, 1000);

                // Mostrar a mensagem se não houver mais tarefas
                noTasksMessage.classList.toggle('show', taskList.children.length === 0);
            }
        });

        
            function searchTasks() {
            const searchInput = document.getElementById('search');
            const filter = searchInput.value.toLowerCase();
            const tasks = document.getElementById('tasks');
            const taskItems = tasks.getElementsByTagName('li');

            for (let i = 0; i < taskItems.length; i++) {
            const taskText = taskItems[i].textContent.toLowerCase();
            const taskMatches = taskText.includes(filter);
            taskItems[i].style.display = taskMatches ? 'flex' : 'none';
        }
     }
     
</script>
</body>
</html>
