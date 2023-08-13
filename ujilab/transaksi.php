<?php
include 'koneksi.php';
$barang=mysqli_query($conn, "SELECT * FROM barang");
$jsArray = "var harga_barang = new Array();";
$jsArray1 = "var nama_barang = new Array();";  
$jsArray2 = "var stok_barang = new Array();";
function rupiah($angka){
    $hasil_rp= "Rp " . number_format($angka,2,',','.');
    return $hasil_rp;
}
?>
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
            margin-right:1px;
        }
        thead,th,td{
            border: 4px solid #000;
        }
        table{
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
   
        <h1>TOKO</h1>
        <h1>SINAR JAYA</h1>
     
    </header>
    <main>
    <form class="transaksi" method="POST" action="action-trans.php">
    <div class="form-group">
        <label class=""><b>Id Transaksi</b></label>
        <input type="text" style="width: auto;" class="" name="id" >
        
    </div>
    <div class="form-group">
        <label class=""><b>Tgl. Transaksi</b></label>
        <input type="text" style="width: auto;" class="" name="tgl_input" value="<?php echo  date("Y-m-j G:i:s");?>" readonly>
        
    </div>
    <div class="form-group">
        <label class=""><b>Kode Barang</b> </label>
        <input type="text" name="kode_barang" class="" list="datalist1" onchange="changeValue(this.value)"  aria-describedby="basic-addon2" required>
        <datalist id="datalist1">
        <?php 
            if(mysqli_num_rows($barang)) {
            while($row_brg= mysqli_fetch_array($barang)) {?>
            <option value="<?php echo $row_brg["kd_barang"]?>"> <?php echo $row_brg["kd_barang"]?>
            <?php 
                $jsArray .= "hargabrg['" . $row_brg['kd_barang'] . "'] = {hargabrg:'" . addslashes($row_brg['hargabrg']) . "'};";
                $jsArray1 .= "namabrg['" . $row_brg['kd_barang'] . "'] = {namabrg:'" . addslashes($row_brg['namabrg']) . "'};"; 
                $jsArray2 .= "stokbrg['" . $row_brg['kd_barang'] . "'] = {stokbrg:'" . addslashes($row_brg['stokbrg']) . "'};"; } ?>
            <?php } ?>
        </datalist>
       
    </div>
    <div class="form-group">
        <label class=""><b>Nama Barang</b></label>
        <input type="text" class="" name="namabrg" id="namabrg" readonly> 
        
    </div>
    <div class="form-group">
        <label class=""><b>Harga</b></label>
        <input type="number" class="" id="hargabrg" onchange="total()" value="<?php echo rupiah($row['hargabrg']);?>" name="hargabrg" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Stok Barang</b></label>
        <input type="number" class="" id="stokbrg"  value="<?php echo $row['stokbrg'];?>" name="stokbrg" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Quantity</b></label>
        <input type="number" class="" id="quantity" onchange="total()" name="quantity" placeholder="0" required>
    </div>    
    <div class="form-group">
        <label class=""><b>Sub-Total</b></label>
        <input type="text" class=""  id="subtotal" name="subtotal" onchange="total()" name="sub_total" readonly>
    </div>
    <div class="">
        <button class="" name="save" value="simpan" type="submit">Tambah</button>
    </div>
    </form>
    </main>
    <br>
    <br>
<footer>
<table id="brg" style="width:100%">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th>No Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>kode barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>stok barang</th>
            <th>Jumlah Beli</th>
            <th>Total Bayar</th>
            <th>Aksi</th>
            </tr>
       </thead>
       <tbody>
        <?php
            $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang on transaksi.kd_barang=barang.kd_barang");
            $no=1;
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['id_transaksi'] ?></td>
                <td><?php echo $data['tgltransaksi'] ?></td>
                <td><?php echo $data['kd_barang'] ?></td>
                <td><?php echo $data['namabrg'] ?></td>
                <td><?php echo rupiah($data['hargabrg']) ?></td>
                <td><?php echo $data['stokbrg'] ?></td>
                <td><?php echo $data['jmlbeli'] ?></td>
                <td><?php echo rupiah($data['totalbayar']) ?></td>
                <td class="text-center">
                <a  href="print.php?id_transaksi=<?php echo $data['id_transaksi']?>" class="btn-2">Cetak</a> ||
                <a href="hapus-trans.php?id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn-2">Delete</a>
                </td>
            </tr>   
            <?php } ?>
        </tbody>
    </table>

</footer>
   

<script type="text/javascript">
    <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>
    <?php echo $jsArray2; ?>

    function changeValue(kd_barang) {
        document.getElementById("namabrg").value = namabrg[kd_barang].namabrg;
        document.getElementById("hargabrg").value = hargabrg[kd_barang].hargabrg;
        document.getElementById("stokbrg").value = stokbrg[kd_barang].stokbrg;
    }

    function total() {
        var harga = parseInt(document.getElementById('hargabrg').value);
        var jumlah_beli = parseInt(document.getElementById('quantity').value);
        var jumlah_harga = harga * jumlah_beli;
        document.getElementById('subtotal').value = jumlah_harga;
    }

    function printContent(table) {
        var printWindow = window.open('', '_blank');
        var printContent = document.getElementById(table).innerHTML;
        printWindow.document.write('<html><head><title>Cetak</title></head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
</body>
</html>