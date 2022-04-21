<?php
    include 'koneksi.php';
    $jenis_mobil = $_POST['jenis_mobil'];
    $warna = $_POST['warna'];
    $stok = $_POST['stok'];
    $tarif_sewa = $_POST['tarif_sewa'];

    $query = mysqli_query($koneksi, "INSERT INTO mobil (jenis_mobil, warna, stok, tarif_sewa) VALUES ('$jenis_mobil', '$warna', '$stok', '$tarif_sewa')");
    if ($query) {
        // header("location:datamobil.php?berhasil");
        echo"<script>alert('Tambah sukses'); location.href='form_tambah_mobil.php';</script>";
    }else{
        header("location:datamobil.php?gagal");
    }

?>
