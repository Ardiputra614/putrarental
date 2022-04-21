<?php
    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    $query = mysqli_query($koneksi, "select * from mobil");
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
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
            <div class="col-sm-8 col-md-8 col-lg-8">

            <div class="card shadow">
                <div class="navbar card-header bg-dark text-white">
                    <h3>Data Mobil</h3>
                    <a href="datamobil.php" class="btn btn-secondary"><< Data Mobil</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="text-center">
                            <th>KD MOBIL</th>
                            <th>JENIS MOBIL</th>
                            <th>WARNA</th>
                            <th>STOK</th>
                            <th>TARIF SEWA/HARI</th>
                            <th>AKSI</th>                        
                        </tr>
                        <?php
                            while ($mobil = mysqli_fetch_assoc($query)) { ?>
                                <tr class="text-center">                                
                                    <td><?= $mobil['kd_mobil'] ?></td>
                                    <td><?= $mobil['jenis_mobil'] ?></td>
                                    <td><?= $mobil['warna'] ?></td>
                                    <td><?= $mobil['stok'] ?></td>
                                    <td>Rp. <?= number_format($mobil['tarif_sewa']) ?></td>
                                    <td>
                                        <a href="edit_mobil.php?kd_mobil=<?= $mobil['kd_mobil'] ?>" class="btn btn-warning">EDIT</a>
                                        <a href="hapus_mobil.php?kd_mobil=<?= $mobil['kd_mobil'] ?>" onclick="return confirm('YAKIN HAPUS MOBIL?')" class="btn btn-danger">HAPUS</a>
                                    </td>
                                </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3>Tambah Mobil</h3>
                </div>
                <div class="card-body">
                    <form action="p_tambah_mobil.php" method="post">
                        <div>
                            <label>JENIS MOBIL</label>
                            <input type="text" name="jenis_mobil" placeholder="Masukan jenis mobil" class="form-control" required>
                        </div>
                        <div>
                            <label>WARNA MOBIL</label>
                            <input type="text" name="warna" placeholder="Masukan warna mobil" class="form-control" required>
                        </div>
                        <div>
                            <label>STOK MOBIL</label>
                            <input type="number" name="stok" placeholder="Masukan stok mobil" class="form-control" required>
                        </div>
                        <div>
                            <label>TARIF SEWA / HARI</label>
                            <input type="text" name="tarif_sewa" placeholder="contoh: 250000" class="form-control" required>
                        </div>
                        <div>
                            <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mt-2 col-sm-12">
                        </div>
                    </form>  
                </div>
            </div>            
        </div>
    </div>
    </div>
</body>
</html>