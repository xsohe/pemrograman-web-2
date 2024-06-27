<?php 
    session_start();
    $name = $_SESSION['name'] ?? '';
    $hobies = $_SESSION['hobies'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 15</title>
</head>
<body>
    <form action="session.php" method="post">
        <label for="name">Your Name : </label>
        <input type="text" name="name" required value="<?= htmlspecialchars($name) ?>"><br>
        <label for="hobies">Hobies : </label>
        <input type="text" name="hobies" required value="<?= htmlspecialchars($hobies) ?>"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    </br>
    <h2 style="line-height: 0;">This is use session</h2>
    <hr>
    <?php 
    if(isset($_SESSION['name']) && isset($_SESSION['hobies'])) {
        echo "Name: " . $_SESSION['name'] . "<br>";
        echo "Hobies: " . $_SESSION['hobies'] . "<br>";
    }
    ?>
</body>
</html>
