<?php
include 'koneksi.php';
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        th,td{
         border: 1px solid #000;
        }
        .dataTables_filter{
            display: none;
        }
        .dataTables_length{
            display: none;
        }
        .btn-1{
            border: 1px solid #000;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <header>
        <h1>TOKO</h1>
        <h1>SINAR JAYA</h1>
    </header>
    <main>
    <div class="button">
        <a href="tambah.php" class="btn-1">Tambah Data</a>
    </div>
    <br>
    <br>
    <table id="brg" style="width:100%">
        <thead>
            <tr>
            <th scope="col">kode barang</th>
            <th>kode barang</th>
            <th>kode barang</th>
            <th>kode barang</th>
            <th>kode barang</th>
            </tr>
       </thead>
       <tbody>
        <?php
            $select = mysqli_query($conn, "SELECT * FROM barang");
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
            <td><?php echo $data['kd_barang'] ?></td>
            <td><?php echo $data['namabrg'] ?></td>
            <td><?php echo rupiah($data['hargabrg']) ?></td>
            <td><?php echo $data['stokbrg'] ?></td>
            <td class="text-center">
            <a  href="hapus.php?kd_barang=<?php echo $data['kd_barang']?>" class="btn-2">Hapus</a> ||
            <a href="edit.php?kd_barang=<?php echo $data['kd_barang'] ?>" class="btn-2">Edit</a>
            </td>
            </tr> 
            <?php } ?>
        </tbody>
      
    </table>
    </main>
    <footer>

    </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#brg').DataTable({
            searchable: false,
            scrollCollapse: true,
            scrollY: '200px'
          });
      });
    </script>
</body>
</html>