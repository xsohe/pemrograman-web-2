<?php
    $value = "Joko";
    $value2 = "Budi Pratama";

    setcookie("username", $value);
    setcookie("namalengkap", $value2, time()+3600);

    echo "<h3>Halaman ubah cookie</h3> </br>";
    echo "<h3>Lihat Cookie : <a href='lihat_cookie.php'>Lihat</a></h3>"
?>