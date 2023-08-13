<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <style>
        .form-group{
            margin:10px;
        }
        label{
            margin-right:10px;
        }
        form{
            margin:auto;
            width: 25%;
        }
    </style>
</head>
<body>
    <header>
        <h1>TOKO</h1>
        <h1>SINAR JAYA</h1>
    </header>
    <main>
    <?php 
	include "koneksi.php";
	$id = $_GET['kd_barang'];
	$query_mysql = mysqli_query($conn,"SELECT * FROM barang WHERE kd_barang='$id'")or die(mysql_error());
	while($data = mysqli_fetch_array($query_mysql)){
	?>
    <form action="edit-brg.php" method="post">
    <div class="form-group">
        <label>KODE BARANG:</label>
        <input type="text" name="kd_barang" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['kd_barang']?>" readonly>
    </div>
    <div class="form-group">
        <label>NAMA BARANG:</label>
        <input type="text" name="nm" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['namabrg']?>">
    </div>
    <div class="form-group">
        <label>HARGA BARANG:</label>
        <input type="text" name="hg" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['hargabrg']?>">
    </div>
    <div class="form-group">
        <label>STOK BARANG:</label>
        <input type="text" name="stok" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['stokbrg']?>">
    </div>
    <button type="submit" name="submit" class="btn" value="simpan">Save</button>
    </form>
    <?php } ?>
    </main>
    <footer>

    </footer>
</body>
</html>