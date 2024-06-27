<?php 
    $conn = mysqli_connect("localhost", "root", "", "mhs");
        $cari = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs where nama like '%$cari%' or alamat like '%$jurusan%' order by nama asc");

        echo "
            <html>
            <body>
                <table border=1> 
                    <tr>
                        <td>NIM</td>
                        <td>NAMA</td>
                        <td>ALAMAT</td>
                        <td>JURUSAN</td>
                    </tr>
                
            ";

            while($data= mysqli_fetch_array($hasil)) {
                echo "<tr>
                    <td>".$data['nim']."</td>
                    <td>".$data['nama']."</td>
                    <td>".$data['alamat']."</td>
                    <td>".$data['jurusan']."</td>
                </tr>
                </table>
                </body>
                </html>";
            }

?>