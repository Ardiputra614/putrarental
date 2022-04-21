<?php
    include 'koneksi.php';
    $query = mysqli_query($koneksi, "select * from customer");
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
        <h1 class="text-center">DATA CUSTOMER</h1>
                <table class="table table-bordered shadow">
                        <tr class="text-center bg-dark text-white">                        
                            <th>KD CUSTOMER</th>
                            <th>NAMA CUSTOMER</th>
                            <th>ALAMAT</th>
                            <th>NO HP</th>                            
                        </tr>
                        <?php                            
                            while ($mobil = mysqli_fetch_assoc($query)) { ?>
                                <tr class="text-center">                                                                    
                                    <td><?= $mobil['kd_customer'] ?></td>
                                    <td><?= $mobil['nama'] ?></td>
                                    <td><?= $mobil['alamat'] ?></td>
                                    <td><?= $mobil['no_hp'] ?></td>                                    
                                </tr>
                        <?php } ?>
                    </table>
                <div class="text-center">
                    <a href="datacustomer.php" class="btn btn-secondary" id="hide"><< KEMBALI</a>
                    <button class="btn btn-outline-primary" onclick="window.print()" id="hide">PRINT</button> 
                </div>
    </div>
</body>
</html>