<?php
    include 'koneksi.php';

    $kd_mobil = $_POST['kd_mobil'];
    $kd_customer = $_POST['kd_customer'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $querymobil2 = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = $kd_mobil");
    while ($mbl = mysqli_fetch_assoc($querymobil2)) {
        $stok = $mbl['stok'];
    }

    if ($stok == 0) {
        echo"<script>alert('Stok mobil kosong, pilih mobil lain!!'); location.href='tambah.php';</script>";
    }elseif($tgl_pinjam > $tgl_kembali){
        echo"<script>alert('Tolong perbaiki tanggalnya!!'); location.href='tambah.php';</script>";
    }else{
        $kd_mobil = $_POST['kd_mobil'];
        $kd_customer = $_POST['kd_customer'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        
        $diff = date_diff(date_create($tgl_pinjam), date_create($tgl_kembali));
        $hari = $diff->format("%a") + 1;
        
        $querymobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = $kd_mobil");
        while ($mobil = mysqli_fetch_assoc($querymobil)) {
            $tarif_sewa = $mobil['tarif_sewa'];
        }
        $total_sewa = $hari * $tarif_sewa;

        $query = mysqli_query($koneksi, "INSERT INTO sewa (kd_mobil, kd_customer, tgl_pinjam, tgl_kembali, total_sewa) VALUES ('$kd_mobil', '$kd_customer', '$tgl_pinjam', '$tgl_kembali', '$total_sewa')");
        echo"<script>alert('Tambah sukses'); location.href='index.php';</script>";
    }
?>
