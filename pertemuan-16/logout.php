<?php
    session_start();
    session_destroy();
    
    if(isset($_COOKIE['login'])) {
        $time = time();
        setcookie("login", "");
    }
    
    header('Location: ./login.php');
    exit();
 ?>
