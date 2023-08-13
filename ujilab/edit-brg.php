<?php 
include "koneksi.php";

$kd=$_POST['kd_barang'];
$nm=$_POST['nm'];
$hg=$_POST['hg'];
$stok=$_POST['stok'];
 
mysqli_query($conn,"UPDATE barang SET kd_barang='$kd', namabrg='$nm', hargabrg='$hg', stokbrg='$stok' WHERE kd_barang='$kd'");
$message="Berhasil Mengedit data";
echo "<script>alert('$message');
window.location.href='barang.php';</script>";
?>