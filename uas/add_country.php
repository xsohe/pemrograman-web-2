<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_country'])) {
    $country_id = $_POST['country_id'];
    
    $stmt = $conn->prepare('DELETE FROM countries WHERE id = ?');
    $stmt->bind_param('i', $country_id);
    $stmt->execute();
    
    // Redirect to refresh the page
    header('Location: add_country.php');
    exit;
}

$groups = [];
$result = $conn->query('SELECT * FROM `groups`');
if ($result) {
    $groups = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}

// Handle form submission to add country
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $group_id = $_POST['group_id'];
    $wins = $_POST['wins'];
    $draws = $_POST['draws'];
    $losses = $_POST['losses'];

    $stmt = $conn->prepare('INSERT INTO countries (name, group_id, wins, draws, losses) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('siiii', $name, $group_id, $wins, $draws, $losses);
    $stmt->execute();
    $stmt->close();

    header('Location: add_country.php');
    exit;
}
?>

<h1>Tambah Data Negara</h1>
<form method="post" action="add_country.php">
    <label for="name">Nama Negara:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="group_id">Grup:</label>
    <select id="group_id" name="group_id" required>
        <?php foreach ($groups as $group): ?>
        <option value="<?php echo $group['id']; ?>"><?php echo htmlspecialchars($group['name']); ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="wins">Menang:</label>
    <input type="number" id="wins" name="wins" required><br>

    <label for="draws">Seri:</label>
    <input type="number" id="draws" name="draws" required><br>

    <label for="losses">Kalah:</label>
    <input type="number" id="losses" name="losses" required><br>

    <button type="submit" name="submit">Simpan</button>
</form>

<h2>Data UEFA 2024</h2>
<table border="1" width="50%">
    <tr>
        <th>Tim</th>
        <th>Menang</th>
        <th>Seri</th>
        <th>Kalah</th>
        <th>Poin</th>
        <th>Aksi</th>
    </tr>
    <?php
    $stmt = $conn->query('SELECT * FROM countries');
    while ($country = $stmt->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($country['name']) . '</td>';
        echo '<td>' . htmlspecialchars($country['wins']) . '</td>';
        echo '<td>' . htmlspecialchars($country['draws']) . '</td>';
        echo '<td>' . htmlspecialchars($country['losses']) . '</td>';
        echo '<td>' . htmlspecialchars($country['points']) . '</td>';
        echo '<td>';
        echo '<form method="post" onsubmit="return confirm(\'Anda yakin ingin menghapus data ini?\');">';
        echo '<input type="hidden" name="country_id" value="' . $country['id'] . '">';
        echo '<button type="submit" name="delete_country">Hapus</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
</table>

<br>
<br>
<a href="dashboard.php">Kembali</a>
