<?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "select * from mobil");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT MOBIL</title>
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
        <h1 class="text-center">DATA MOBIL</h1>
                <table class="table table-bordered shadow">
                        <tr class="text-center bg-dark text-white">
                            <th>NO. </th>
                            <th>KD MOBIL</th>
                            <th>JENIS MOBIL</th>
                            <th>WARNA</th>
                            <th>STOK</th>
                            <th>TARIF SEWA/HARI</th>                      
                        </tr>
                        <?php
                            $no = 1;
                            while ($mobil = mysqli_fetch_assoc($query)) { ?>
                                <tr class="text-center">                                
                                    <td><?= $no++; ?></td>
                                    <td><?= $mobil['kd_mobil'] ?></td>
                                    <td><?= $mobil['jenis_mobil'] ?></td>
                                    <td><?= $mobil['warna'] ?></td>
                                    <td><?= $mobil['stok'] ?></td>
                                    <td>Rp. <?= number_format($mobil['tarif_sewa']) ?></td>
                                </tr>
                        <?php } ?>
                    </table>
                <div class="text-center">
                    <a href="datamobil.php" class="btn btn-secondary" id="hide"><< KEMBALI</a>
                    <button class="btn btn-outline-primary" onclick="window.print()" id="hide">PRINT</button> 
                </div>
    </div>
</body>
</html>