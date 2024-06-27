<?php
include 'auth.php';
include 'db.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $result = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM posts");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="my-3">
        <div class="d-flex justify-content-between">    
                <h2 class="mb-3">Dashboard</h2>
            <a href="logout.php" class="text-underline">Logout</a>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="create.php" class="btn btn-primary">Create New Post</a>
            </div>
            <a href="index.php" class="btn btn-secondary">All Posts</a>
        </div>
        <div class="col-lg-6 mb-3 mt-4">
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="show.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info ms-2">Show</a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning ms-2">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
