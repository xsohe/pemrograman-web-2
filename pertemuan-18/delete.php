<?php
include 'auth.php';
include 'db.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: dashboard.php");
} else {
    echo "Error: " . $stmt->error;
}
?>
