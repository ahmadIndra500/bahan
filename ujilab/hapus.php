<?php
include 'koneksi.php';
$kd= $_GET['kd_barang'];
$query="DELETE from barang where kd_barang='$kd'";
$query1="DELETE from transaksi where kd_barang='$kd'";
mysqli_query($conn, $query);
mysqli_query($conn, $query1);
$message="Berhasil Menghapus data";
echo "<script>alert('$message');
window.location.href='barang.php';</script>";
?>