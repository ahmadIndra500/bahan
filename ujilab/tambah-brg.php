<?php
include "koneksi.php";

$kd=$_POST['kd_barang'];
$nm=$_POST['nm'];
$hg=$_POST['hg'];
$stok=$_POST['stok'];

if(empty($_POST['kd_barang'])||empty($_POST['nm'])||empty($_POST['hg'])||empty($_POST['stok'])){
    ?>
    <script language="JavaScript">
    alert('Data Harap Dilengkapi!');
    document.location='tambah.php';
    </script>
    <?php
}else{ 
    $sql="INSERT INTO barang (kd_barang,namabrg,hargabrg,stokbrg) VALUES
    ('$kd','$nm','$hg','$stok')";
    $hasil=mysqli_query($conn,$sql);
    if ($hasil) {
        $message="Berhasil Memasukan Data";
        echo "<script>alert('$message');
        window.location.href='tambah.php';</script>";
    }
    else {
        echo "Gagal insert data";
        exit;
    }  
}
?>