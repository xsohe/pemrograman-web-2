<?php 
    $value = "Eka";
    $value2 = "Rahadi Ramelan";

    setcookie("username", $value);
    setcookie("namalengkap", $value2, time()+3600);

    echo "<h2> Halaman pembuatan cookie : <a href='lihat_cookie.php'>Lihat cookie</a> </h2>";
?>