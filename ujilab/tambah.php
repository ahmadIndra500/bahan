<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
    <form action="tambah-brg.php" method="post">
    <div class="form-group">
        <label>KODE BARANG:</label>
        <input type="text" name="kd_barang" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
        <label>NAMA BARANG:</label>
        <input type="text" name="nm" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
        <label>HARGA BARANG:</label>
        <input type="text" name="hg" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
        <label>STOK BARANG:</label>
        <input type="text" name="stok" class="form-control" placeholder="" autocomplete="off">
    </div>
    <button type="submit" name="submit" class="btn">Submit</button>
    </form>
    </main>
    <footer>

    </footer>
</body>
</html>