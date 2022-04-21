<?php
    include 'koneksi.php';
    $kd_customer = $_GET['kd_customer'];
    $query = mysqli_query($koneksi, "DELETE FROM customer WHERE kd_customer = $kd_customer");
    
?>
<script>alert('HAPUS SUKSES!!'); location.href='datacustomer.php';</script>