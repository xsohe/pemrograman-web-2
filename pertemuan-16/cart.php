<?php
session_start();

function getTodoList() {
    if(isset($_SESSION['todo_list'])) {
        return $_SESSION['todo_list'];
    }
    return array();
}

function saveTodoList($todoList) {
    $_SESSION['todo_list'] = $todoList;
}

function resetTodoList() {
    unset($_SESSION['todo_list']);
}

function addToTodoList($task) {
    $todoList = getTodoList();
    $todoList[] = $task;
    saveTodoList($todoList);
}

function displayTodoList() {
    $todoList = getTodoList();
    if(empty($todoList)) {
        echo "ToDo List kosong.";
    } else {
        echo "<h2>ToDo List</h2>";
        echo "<ul>";
        foreach($todoList as $task) {
            echo "<li>{$task}</li>";
        }
        echo "</ul>";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['reset'])) {
        resetTodoList();
    } else {
        $task = $_POST['task'];
        addToTodoList($task);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ToDo List Sederhana</title>
</head>
<body>
    <h1>ToDo List : </h1>
    <p>Apa yang ingin kamu lakukan sekarang ?</p>
    <form method="post" action="">
        <label for="task">ToDo: </label>
        <input type="text" id="task" name="task" required><br><br>
        <input type="submit" value="Save">
    </form>
    <form method="post" action="">
        <input type="hidden" name="reset" value="1">
        <input type="submit" value="Reset">
    </form>

    <?php displayTodoList(); ?>
</body>
</html>
