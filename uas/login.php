<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE nim = ?');
    $stmt->bind_param('s', $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging output
    echo '<pre>';
    print_r($user);
    echo '</pre>';

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Login gagal, periksa NIM dan password Anda.';
    }
    $stmt->close();
}
?>

<form method="post" action="login.php">
    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" required> <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required> <br>
    <button type="submit">Login</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
<p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
