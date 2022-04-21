<?php
    include 'koneksi.php';
    $kd_mobil = $_GET['kd_mobil'];
    $query = mysqli_query($koneksi, "DELETE FROM mobil WHERE kd_mobil = $kd_mobil");
    if ($query) {
        header("location:datamobil.php");        
    }else{
        header("location:datamobil.php");
    }
?>