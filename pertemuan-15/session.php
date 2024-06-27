<?php
    session_start();

    $name = $_POST['name'];
    $hobies = $_POST['hobies'];
    $_SESSION['name'] = $name;
    $_SESSION['hobies'] = $hobies;

    header("Location: index.php");
    exit();
?>