<?php
    include 'koneksi.php';
    $kd_sewa = $_GET['kd_sewa'];
    $query = mysqli_query($koneksi, "DELETE FROM sewa WHERE kd_sewa = $kd_sewa");
    if ($query) {
        header("location:index.php");        
    }else{
        header("location:index.php");
    }
?>