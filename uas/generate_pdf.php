<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$html = '<h1>Laporan Data Negara UEFA 2024 Group A</h1>';
$html .= '<table border="1" width="100%">';
$html .= '<tr><th>Nama Negara</th><th>Menang</th><th>Seri</th><th>Kalah</th><th>Poin</th></tr>';

// Query data dari database
$query = 'SELECT countries.name, groups.name as group_name, wins, draws, losses, points 
          FROM countries 
          JOIN `groups` ON countries.group_id = groups.id';
$result = $conn->query($query);

if ($result) {
    while ($country = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($country['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($country['wins']) . '</td>';
        $html .= '<td>' . htmlspecialchars($country['draws']) . '</td>';
        $html .= '<td>' . htmlspecialchars($country['losses']) . '</td>';
        $html .= '<td>' . htmlspecialchars($country['points']) . '</td>';
        $html .= '</tr>';
    }
    $result->free();
}

$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('laporan_uefa_2024.pdf');
?>
