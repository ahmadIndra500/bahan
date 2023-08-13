<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie('username', '', 0, '/');
    setcookie('nama', '', 0, '/');
    header('location:../index.php');
    echo "<script>alert('Anda Berhasil Logout');</script>";
?>