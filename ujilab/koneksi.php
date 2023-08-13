<?php
$conn= mysqli_connect("localhost","root","","db_sinar_jaya");
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
date_default_timezone_set('Asia/Jakarta');   
?>