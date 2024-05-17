<?php 
    session_start();
    if (!isset($_SESSION['datas'])) {
        $_SESSION['datas'] = [];
    }

    if(isset($_POST['submit'])) {
        $negara = $_POST['negara'];
        $jmlPertandingan = $_POST['jmlPertandingan'];
        $jmlMenang = $_POST['jmlMenang'];
        $jmlSeri = $_POST['jmlSeri'];
        $jmlKalah = $_POST['jmlKalah'];
        $jmlPoin = $_POST['jmlPoin'];
        $namaOperator = $_POST['namaOperator'];
        
        $data = array(
            'negara' => $negara,
            'jmlPertandingan' => $jmlPertandingan,
            'jmlMenang' => $jmlMenang,
            'jmlSeri' => $jmlSeri,
            'jmlKalah' => $jmlKalah,
            'jmlPoin' => $jmlPoin,
            'namaOperator' => $namaOperator
        );

        $_SESSION['datas'][] = $data;

        // Menulis data ke dalam file data.txt
        $dataString = implode(',', $data) . PHP_EOL;
        file_put_contents('data.txt', $dataString, FILE_APPEND);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container my-3">
    <div>
        <form action="" method="post">
            <div class="row justify-content-center">
                <h3 class="text-center my-5">Form Input data piala asia U-23</h3>
                <div class="col-lg-4">
                    <label for="negara" class="mb-2">Negara</label>
                    <select name="negara" id="negara" class="form-select mb-3">
                        <option value="Qatar U23">Qatar U23</option>
                        <option value="Indonesia U23">Indonesia U23</option>
                        <option value="Australia U23">Australia U23</option>
                        <option value="yo">Yordania U23</option>
                    </select>
                    <label for="jumlahPertandingan" class="mb-2">Jumlah Pertandingan</label>
                    <input type="number" name="jmlPertandingan" class="form-control mb-3" required> 
                    <label for="jumlahMenang" class="mb-2">Jumlah Menang</label>
                    <input type="number" name="jmlMenang" class="form-control mb-3" required>
                    <label for="jumlahSeri" class="mb-2">Jumlah Seri</label>
                    <input type="number" name="jmlSeri" class="form-control mb-3" required>
                </div>
                <div class="col-lg-4">
                    <label for="jumlahKalah" class="mb-2">Jumlah Kalah</label>
                    <input type="number" name="jmlKalah" class="form-control mb-3" required>
                    <label for="jumlahPoin" class="mb-2">Jumlah Poin</label>
                    <input type="number" name="jmlPoin" class="form-control mb-3" required>
                    <label for="namaOperator" class="mb-2">Nama Operator</label>
                    <input type="text" name="namaOperator" class="form-control mb-3" required>
                </div>            
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-">
                    <div class="text-center">
                        <p>Data Group A Piala Asia Qatar U-23</p>
                        <p>Per <?= date("d-M-Y H:i:s") ?>  (Waktu dan Jam Sekarang)</p>
                        <p class="text-primary">Yanuar Eka Susila - 211011401010</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <table class='table table-striped mt-3'> 
                <tr>
                    <th>Negara</th>
                    <th>P</th>
                    <th>M</th>
                    <th>S</th>
                    <th>K</th>
                    <th>Poin</th>
                </tr>

                <?php 
                    foreach ($_SESSION['datas'] as $data) {
                        echo "
                        <tr>
                            <td>{$data['negara']}</td>
                            <td>{$data['jmlPertandingan']}</td>
                            <td>{$data['jmlMenang']}</td>
                            <td>{$data['jmlSeri']}</td>
                            <td>{$data['jmlKalah']}</td>
                            <td>{$data['jmlPoin']}</td>
                        </tr> ";
                    }
                ?>
            </table>
        </div>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
