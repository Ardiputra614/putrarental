<?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "select * from sewa");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        @media print{
            #hide{
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center">DATA SEWA</h1>
        <table class="table table-bordered">
            <tr class="text-center bg-dark text-white">
                <th>KD SEWA</th>
                <th>KD MOBIL</th>
                <th>KD CUSTOMER</th>
                <th>TANGGAL PINJAM</th>
                <th>TANGGAL KEMBALI</th>
                <th>TOTAL SEWA</th>                      
            </tr>
        <?php
            while ($sewa = mysqli_fetch_assoc($query)) { ?>
            <tr class="text-center">
                <td><?= $sewa['kd_sewa'] ?></td>
                <td><?= $sewa['kd_mobil'] ?></td>
                <td><?= $sewa['kd_customer'] ?></td>
                <td><?= date("d - m - Y", strtotime($sewa['tgl_pinjam'])) ?></td>
                <td><?= date("d - m - Y", strtotime($sewa['tgl_kembali'])) ?></td>
                <td>Rp. <?= number_format($sewa['total_sewa']) ?></td>
            </tr>
        <?php } ?>
        </table>
        <div class="text-center">
            <a href="index.php" class="btn btn-secondary" id="hide"><< KEMBALI</a>
            <button class="btn btn-outline-primary" onclick="window.print()" id="hide">PRINT</button> 
        </div>
    </div>
</body>
</html>