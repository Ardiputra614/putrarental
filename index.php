<?php
    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    $query = mysqli_query($koneksi, "select * from sewa");      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA SEWA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar bg-dark text-white navbar-fixed">
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
    <div class="alert alert-info">
        <h3>!INFORMASI</h3> MOBIL YANG TIDAK BISA DISEWA KARENA STOK KOSONG: 
    <?php
        $mobil = mysqli_query($koneksi, "SELECT * FROM mobil");
        while ($mbl = mysqli_fetch_assoc($mobil)) { 
        if($mbl['stok'] == 0) { ?>                            
            <b class="badge bg-danger text-white"><?= $mbl['jenis_mobil'] ?></b>        
        <?php }else{ 
            echo ""; 
        } } ?>
    </div>

        <div class="card shadow">
            <div class="navbar card-header bg-dark text-white">
                <h3>Rental Mobil</h3>
                <a href="tambah.php" class="btn btn-primary">TAMBAH</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <tr class="text-center">
                        <th>KD SEWA</th>
                        <th>KD MOBIL</th>
                        <th>KD CUSTOMER</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL KEMBALI</th>
                        <th>TOTAL SEWA</th>
                        <th>AKSI</th>                        
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
                                <td>
                                    <a href="edit.php?kd_sewa=<?= $sewa['kd_sewa'] ?>" class="btn btn-warning">EDIT</a>
                                    <a href="hapus.php?kd_sewa=<?= $sewa['kd_sewa'] ?>" onclick="return confirm('YAKIN SUDAH SELESAI SEWA?')" class="btn btn-success">SELESAI</a>
                                </td>
                            </tr>
                    <?php } ?>
                </table>
                <a href="cetak.php" class="btn btn-outline-dark">PREVIEW PRINT</a>
            </div>
        </div>
    </div>
</body>
</html>