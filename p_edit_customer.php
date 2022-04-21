<?php
    include 'koneksi.php';
    $kd_customer = $_POST['kd_customer'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = mysqli_query($koneksi, "UPDATE customer SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp' WHERE kd_customer = $kd_customer");
    if ($query) {
        header("location:datacustomer.php?berhasil");
    }else{
        header("location:datacustomer.php?gagal");
    }

?>