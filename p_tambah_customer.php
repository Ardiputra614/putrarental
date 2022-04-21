<?php
    include 'koneksi.php';
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = mysqli_query($koneksi, "INSERT INTO customer (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')");
    if ($query) {
        // header("location:datacustomer.php?berhasil");
        echo"<script>alert('Tambah sukses'); location.href='form_tambah_customer.php';</script>";
    }else{
        header("location:datacustomer.php?gagal");
    }

?>
