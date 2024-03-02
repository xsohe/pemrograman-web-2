<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan soal no 1.</title>
</head>
<body>
    <?php 
        $nama = "Yanuar Eka Susila";
        $email = "yanuareka@gmail.com";
        $jurusan = "Teknik Informatika";
        $hoby = "Nonton Film";
    ?>
    
    <?php 
    print "<center><font size=8 color='red' face='arial'><b>BIODATA</b></font></center></br>";
    print "<center>";
    print "<font size=6 color='blue' face='arial'>Nama : <b>$nama</b> </font></br>";
    print "<font size=6 color='blue' face='arial'>Email : $email</font></br>";
    print "<font size=6 color='blue' face='arial'>Jurusan : $jurusan</font></br>";
    print "<font size=6 color='blue' face='arial'>Hoby : $hoby</font></br>";
    print "</center>";
    ?> 
</body>
</html>