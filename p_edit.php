<?php
    include 'koneksi.php';
    
    $kd_sewa = $_POST['kd_sewa'];
    $kd_mobil = $_POST['kd_mobil'];
    $kd_customer = $_POST['kd_customer'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $querymobil2 = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = $kd_mobil");
    while ($mbl = mysqli_fetch_assoc($querymobil2)) {
        $stok = $mbl['stok'];
    }

    $a = mysqli_query($koneksi, "SELECT * FROM sewa WHERE kd_sewa = $kd_sewa");
        while($a1 = mysqli_fetch_assoc($a)){
        $k_mobil = $a1['kd_mobil'];
    }

    if ($k_mobil == $kd_mobil) {
        $kd_sewa = $_POST['kd_sewa'];        
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
        
        $query = mysqli_query($koneksi, "UPDATE sewa SET kd_customer = $kd_customer, tgl_pinjam = '$tgl_pinjam', tgl_kembali = '$tgl_kembali', total_sewa = $total_sewa WHERE kd_sewa = $kd_sewa");
        echo"<script>alert('Edit sukses'); location.href='index.php';</script>";  
                                      
    }elseif($tgl_pinjam > $tgl_kembali){
        echo"<script>alert('Tolong perbaiki tanggalnya!!'); location.href='edit.php?kd_sewa=$kd_sewa';</script>";
    }elseif($stok < 1){
        echo"<script>alert('Stok mobil kosong, pilih mobil lain!!'); location.href='edit.php?kd_sewa=$kd_sewa';</script>";    
    }else{
        $kd_sewa = $_POST['kd_sewa'];        
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
        
        $query2 = mysqli_query($koneksi, "UPDATE sewa SET kd_mobil = $kd_mobil, kd_customer = $kd_customer, tgl_pinjam = '$tgl_pinjam', tgl_kembali = '$tgl_kembali', total_sewa = $total_sewa WHERE kd_sewa = $kd_sewa");
        echo"<script>alert('Edit sukses'); location.href='index.php';</script>"; 
}

?>