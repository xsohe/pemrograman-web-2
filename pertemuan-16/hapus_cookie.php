<?php
    $value = "";
    $value2 = "";

    setcookie("username", $value);
    setcookie("namalengkap", $value2, time()+3600);

    echo "<h3>Halaman Hapus cookie</h3> </br>";
    echo "<h3>Lihat Cookie : <a href='lihat_cookie.php'>Lihat</a></h3>"
?>