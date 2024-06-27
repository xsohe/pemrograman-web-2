<?php
include 'db.php';

// Mengambil ID dari parameter GET dan memastikan hanya integer yang diterima
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found.";
        exit();
    }
} else {
    echo "Invalid ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <img src="https://picsum.photos/800/400?random=<?php echo rand(); ?>" class="card-img-top img-fluid" alt="random image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($post['content']); ?></p>
                </div>
                <div class="card-footer">
                    <a href="dashboard.php" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz7MLBYj1N8d2FltQFZ6duXWgG7E6E/2NeYw/1JKclN2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-IQsoLXlYLnL
