<?php
include 'auth.php';
include 'db.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container my-4">
    <div class="d-flex justify-content-between mb-3 ">
        <h2>Edit Post</h2>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
    <form method="post" action="">
        <div class="form-group mb-2">
            <label for="title" class="mb-2">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group mb-2">
            <label for="content" class="mb-2">Content:</label>
            <textarea class="form-control" rows="6" id="content" name="content" required><?php echo $content; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
