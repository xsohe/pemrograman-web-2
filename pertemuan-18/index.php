<?php
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ?");
    $search_param = '%' . $search . '%';
    $stmt->bind_param('ss', $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM posts");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top my-2">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold fs-4" href="#">Blogs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item me-3">
                <a class="nav-link" aria-current="page" href="index.php">Blog</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Create Blog</a>
                </li>
            </ul>
            </div>
            <div>
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-success">Register</a>
            </div>
        </div>
    </nav>
    <div class="col-lg-6 mt-4 mx-auto">
        <form class="d-flex" action="index.php" method="GET">
            <input type="text" name="search" class="form-control me-2" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>
    <div class="row mt-4">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="https://picsum.photos/600/300?random=<?php echo rand(); ?>" class="card-img-top img-fluid" alt="random">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="text-primary text-sm">Posted at: <?php echo date('H:i', strtotime($row['created_at'])); ?></p>
                        </div>
                        <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz7MLBYj1N8d2FltQFZ6duXWgG7E6E/2NeYw/1JKclN2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-IQsoLXlYLnL+f/iIxbu9nU5eKCMOssyPc8W5evoGvuvqGKOq6UC69PslbWf5s1c9" crossorigin="anonymous"></script>
</body>
</html>
