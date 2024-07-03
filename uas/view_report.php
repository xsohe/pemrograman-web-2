<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Mendapatkan data negara UEFA dan grupnya
$query = 'SELECT countries.name, groups.name AS group_name, wins, draws, losses, points 
          FROM countries 
          JOIN `groups` ON countries.group_id = groups.id';
$result = $conn->query($query);

$countries = [];
if ($result) {
    $countries = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}
?>

<h1>Laporan Data Negara UEFA 2024</h1>
<a href="generate_pdf.php">Cetak PDF</a>
<a href="dashboard.php">Kembali</a>

<table border="1">
    <tr>
        <th>Nama Negara</th>
        <th>Grup</th>
        <th>Menang</th>
        <th>Seri</th>
        <th>Kalah</th>
        <th>Poin</th>
    </tr>
    <?php foreach ($countries as $country): ?>
    <tr>
        <td><?php echo htmlspecialchars($country['name']); ?></td>
        <td><?php echo htmlspecialchars($country['group_name']); ?></td>
        <td><?php echo htmlspecialchars($country['wins']); ?></td>
        <td><?php echo htmlspecialchars($country['draws']); ?></td>
        <td><?php echo htmlspecialchars($country['losses']); ?></td>
        <td><?php echo htmlspecialchars($country['points']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
