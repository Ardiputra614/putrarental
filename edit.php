<?php
    session_start();
    include 'koneksi.php';
    $kd_sewa = $_GET['kd_sewa'];
    $sql = "SELECT * FROM sewa WHERE kd_sewa = $kd_sewa";
    $query = mysqli_query($koneksi, $sql);
    while ($sewa = mysqli_fetch_assoc($query)) {        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT SEWA</title>
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
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3>EDIT SEWA</h3>
                </div>
                <div class="card-body">
                    <form action="p_edit.php" method="post">
                        <input type="hidden" name="kd_sewa" value="<?= $sewa['kd_sewa'] ?>">
                        <div>
                            <label>JENIS MOBIL</label>
                            <select name="kd_mobil" id="" class="form-control form-select" required>
                                <option value="">PILIH MOBIL</option>
                                <?php
                                    $querymobil = mysqli_query($koneksi, "SELECT * FROM mobil");
                                    while ($mobil = mysqli_fetch_assoc($querymobil)) { ?>
                                        <option value="<?= $mobil['kd_mobil'] ?>" <?php if($mobil['kd_mobil'] == $sewa['kd_mobil']) {echo"selected";} ?>>
                                            <?= $mobil['jenis_mobil'] ?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label>NAMA CUSTOMER</label>
                            <select name="kd_customer" id="" class="form-control form-select" required>
                                <option value="">PILIH CUSTOMER</option>
                                <?php
                                    $querycustomer = mysqli_query($koneksi, "SELECT * FROM customer");
                                    while ($customer = mysqli_fetch_assoc($querycustomer)) { ?>
                                        <option value="<?= $customer['kd_customer'] ?>" <?php if($customer['kd_customer'] == $sewa['kd_customer']) {echo"selected";} ?>>
                                            <?= $customer['nama'] ?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label>TANGGAL PINJAM</label>
                            <input type="date" name="tgl_pinjam" class="form-control" value="<?= $sewa['tgl_pinjam'] ?>" required>
                        </div>
                        <div>
                            <label>TANGGAL KEMBALI</label>
                            <input type="date" name="tgl_kembali" class="form-control" value="<?= $sewa['tgl_kembali'] ?>" required>
                        </div>
                        <div>
                            <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary mt-3 col-sm-12">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3>DATA MOBIL</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th>KD MOBIL</th>
                                <th>JENIS MOBIL</th>
                                <th>WARNA</th>
                                <th>STOK</th>
                                <th>TARIF SEWA</th>
                            </tr>                        
                                <?php
                                $querymbl2 = mysqli_query($koneksi, "SELECT * FROM mobil");                                     
                                    while ($mbl = mysqli_fetch_assoc($querymbl2)) { ?>
                                        <tr class="text-center">
                                            <td><?= $mbl['kd_mobil'] ?></td>
                                            <td><?= $mbl['jenis_mobil'] ?></td>
                                            <td><?= $mbl['warna'] ?></td>
                                            <td><?= $mbl['stok'] ?></td>
                                            <td>Rp. <?= number_format($mbl['tarif_sewa']) ?></td>
                                        </tr>
                                <?php } ?>
                        </table>
                        <div class="alert alert-info">
                        MOBIL YANG TIDAK BISA DISEWA KARENA STOK KOSONG: 
                            <?php
                                $mobil = mysqli_query($koneksi, "SELECT * FROM mobil");
                                while ($mbl = mysqli_fetch_assoc($mobil)) { 
                                    if($mbl['stok'] == 0) { ?>                            
                                    <b class="badge bg-danger text-white"><?= $mbl['jenis_mobil'] ?></b>        
                            <?php }else{ 
                            echo ""; 
                            } } ?>
                        </div>
                </div>                
            </div>
        </div>
    </div>
    </div>
</body>
</html>

<?php } ?>