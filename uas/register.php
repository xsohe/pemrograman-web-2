<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare('INSERT INTO users (nim, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $nim, $hashed_password);

        try {
            $stmt->execute();
            header('Location: login.php');
            exit;
        } catch (mysqli_sql_exception $e) {
            $error = 'NIM sudah terdaftar.';
        }
        $stmt->close();
    } else {
        $error = 'Password dan konfirmasi password tidak cocok.';
    }
}
?>

<form method="post" action="register.php">
    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" required> <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required> <br>
    <label for="confirm_password">Konfirmasi Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required> <br>
    <button type="submit">Register</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
