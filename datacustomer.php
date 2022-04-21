<?php
    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    $query = mysqli_query($koneksi, "select * from customer");
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar bg-dark text-white navbar-fixed">
    <a href="index.php" class="btn btn-secondary" style="margin-left:2%;">< KEMBALI</a>
        <div class="container">
            <h1>PUTRA RENTAL</h1>
            <b class="text-uppercase"></b>
        <?php
            if(isset($_SESSION['username']) == ""){
                header("location:login.php");
            }else{ ?>
            <b class="navbar">
                <a href="datacustomer.php" class="text-white" style="text-decoration: none; margin-left:-10%;"><b>DATA CUSTOMER</b></a>
                <a href="datamobil.php" class="text-white" style="text-decoration: none;"><b>DATA MOBIL</b></a>
                <b class="text-uppercase">                    
                    <?= $_SESSION['username'] ?>
                    <a href="logout.php" class="btn btn-outline-danger ml-5">LOGOUT</a>
                </b>
            </b>
        <?php } ?>
        </div>      
    </nav>

    <div class="container py-5">
        <div class="row">   
            <div class="col-sm-12 col-md-12 col-lg-12">

            <div class="card shadow">
                <div class="navbar card-header bg-dark text-white">
                    <h3>Data Customer</h3>
                    <a href="tambah_customer.php" class="btn btn-primary">Tambah Customer</a>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr class="text-center">
                            <th>KD CUSTOMER</th>
                            <th>NAMA CUSTOMER</th>
                            <th>ALAMAT</th>
                            <th>NO HP</th>
                            <th>AKSI</th>                        
                        </tr>
                        <?php
                            while ($cst = mysqli_fetch_assoc($query)) { ?>
                                <tr class="text-center">                                
                                    <td><?= $cst['kd_customer'] ?></td>
                                    <td><?= $cst['nama'] ?></td>
                                    <td><?= $cst['alamat'] ?></td>
                                    <td><?= $cst['no_hp'] ?></td>                                    
                                    <td>
                                        <a href="edit_customer.php?kd_customer=<?= $cst['kd_customer'] ?>" class="btn btn-warning">EDIT</a>
                                        <a href="hapus_customer.php?kd_customer=<?= $cst['kd_customer'] ?>" onclick="return confirm('YAKIN HAPUS CUSTOMER?')" class="btn btn-danger">HAPUS</a>
                                    </td>
                                </tr>
                        <?php } ?>
                    </table>
                    <a href="cetak_customer.php" class="btn btn-outline-dark">PREVIEW PRINT</a>
                </div>
            </div>
        </div>      
        </div>
    </div>
    </div>
</body>
</html>