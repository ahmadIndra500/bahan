<?php
include "koneksi.php";
    $id = $_POST['id'];
    $tgl = $_POST['tgl_input'];
    $kd = $_POST['kode_barang'];
    $qty = $_POST['quantity'];
    $total= $_POST['subtotal'];
    
    if(empty($_POST['id'])||empty($_POST['tgl_input'])||empty($_POST['kode_barang'])||empty($_POST['quantity'])||empty($_POST['subtotal'])){
        ?>
        <script language="JavaScript">
        alert('Data Harap Dilengkapi!');
        document.location='tambah.php';
        </script>
        <?php
    }else{
        $barang=mysqli_query($conn,"SELECT * FROM barang WHERE kd_barang='$kd'");
        $x=mysqli_fetch_array($barang);
        $y=$x['stokbrg'];
        $sisa=$y-$qty;
        if($y < $qty){
            ?>
            <script language="JavaScript">
            alert('Jumlah Stok tidak ada');
            document.location='transaksi.php';
            </script>
            <?php
        }else{
            $sql = "INSERT INTO transaksi (id_transaksi,tgltransaksi,kd_barang, jmlbeli, totalbayar)
            VALUES('$id','$tgl','$kd','$qty','$total')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                mysqli_query($conn,"UPDATE barang SET stokbrg='$sisa' WHERE kd_barang='$kd'");
                $message="Berhasil Memasukan Melakukan Transaksi";
                echo "<script>alert('$message');
                window.location.href='transaksi.php';</script>";
            }else{
                $message="Gagal Melakukan Transaksi";
                echo "<script>alert('$message');
                window.location.href='transaksi.php';</script>";
            exit;
            }  
        }
    mysqli_close($conn);
    }
?>