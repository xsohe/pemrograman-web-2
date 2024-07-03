<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$groups = [];
$countries = [];

// Mendapatkan data groups
$stmt = $conn->query('SELECT * FROM `groups`');
if ($stmt) {
    $groups = $stmt->fetch_all(MYSQLI_ASSOC);
}

// Mendapatkan data countries
$stmt = $conn->query('SELECT * FROM `countries`');
if ($stmt) {
    $countries = $stmt->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<ul>
    <li><a href="add_country.php">Tambah Data Negara</a></li>
    <li><a href="view_report.php">Lihat Laporan</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<h3>Data Group A</h3>
<span>Per <?php echo date('d F Y H:i:s'); ?> (Waktu dan Jam Sekarang)</span> <br>
<span>Nim : 211011401010</span>
<br>
<br>
<table border="1" width="40%">
    <tr>
        <th>Tim</th>
        <th>Menang</th>
        <th>Seri</th>
        <th>Kalah</th>
        <th>Poin</th>
    </tr>
    <?php foreach ($countries as $country): ?>
    <tr>
        <td><?php echo htmlspecialchars($country['name']); ?></td>
        <td><?php echo htmlspecialchars($country['wins']); ?></td>
        <td><?php echo htmlspecialchars($country['draws']); ?></td>
        <td><?php echo htmlspecialchars($country['losses']); ?></td>
        <td><?php echo htmlspecialchars($country['points']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
