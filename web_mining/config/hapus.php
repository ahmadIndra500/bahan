<?php
include 'connect.php';
$NISN= $_GET['NISN'];
$query="DELETE from tranformasi where NISN='$NISN'";
$query1="DELETE from pendaftar where NISN='$NISN'";
$query2="DELETE from hasil_cluster where NISN='$NISN'";
mysqli_query($koneksi, $query);
mysqli_query($koneksi, $query1);
mysqli_query($koneksi, $query2);
header("location:../index.php");
?>