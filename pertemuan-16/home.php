<?php
    //memulai session
    session_start();

    //cek session
    if(!isset($_SESSION['login'])) {
        header('location:./login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home Remember Me</title>
    </head>
<body>
    <h1>Selamat datang dihalaman utama website</h1>
    <p><a href="./logout.php">Logout</a></p>
</body>
</html>