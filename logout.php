<?php
    session_start();
    session_unset();
    session_destroy();
    echo"<script>alert('LOGOUT BERHASIL'); location.href='login.php'</script>";
?>