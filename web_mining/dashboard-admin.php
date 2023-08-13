<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include('./config/connect.php');
if (isset($_GET['hapus_semua'])) {
    $deleteAllQuery1 = "DELETE FROM pendaftar";
    $deleteAllQuery2 = "DELETE FROM tranformasi";
    $deleteAllQuery3 = "DELETE FROM hasil_cluster";
    mysqli_query($koneksi, $deleteAllQuery1);
    mysqli_query($koneksi, $deleteAllQuery2);
    mysqli_query($koneksi, $deleteAllQuery3);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemahasiswaan ITBAD</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" href="./asset/logo.png">
</head>
<body>
    <header>
        <div class="container">
            <div class="container-logo">
                <img src="./asset/logo.png" alt="">
            </div>
            <div class="container-nm">
            <h2>SISTEM PENERIMAAN BEASISWA</h2>
            <h2>INSTITUT TEKNOLOGI DAN BISNIS AHMAD DAHLAN</h2>
            </div>
            <div class="acc">
                <div class="scc">
                <i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i>
                </div>            
                <h3><?php echo $_SESSION['username']?></h3>
            </div>
        </div>
    </header>
    <main>
        <aside class="left-sidebar">
            <nav class="sidebar-nav">
                <ul class="side">
                    <li class=""><a href="#"> Data Pendaftar</a></li>
                    <li class=""><a href="./config/trans_data.php"> Tranformasi data</a></li>
                    <li class=""><a href="./config/proses_data.php"> Proses Data</a></li>
                    <li class=""><a href="./config/hasil_cluster.php"> Hasil Cluster</a></li>
                </ul>
            </nav>
        </aside>

        <div class="container-main">
            <h2>DATA PENDAFTAR</h2>
            <hr>
            <form method="post" enctype="multipart/form-data" action="./config/import.php">
	            <input name="file" type="file" required="required"> 
	            <input name="upload" type="submit" value="Import">
            </form>
            <div class="button">
                <a href="./config/input_mhs.php" class="btn-1">Tambah Data</a>
                <a href="?hapus_semua=1" class="btn-2">Hapus Semua</a>
            </div>            
            <hr >
            <br>
            <table class="tabel data" id="myTable">
                <thead>
                  <tr>
                    <th scope="col" >NISN</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Asal Sekolah</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nama Ayah</th>
                    <th scope="col">Pekerjaan Ayah</th>
                    <th scope="col">Penghasilan Ayah</th>
                    <th scope="col">Nama Ibu</th>
                    <th scope="col">Pekerjaan Ibu</th>
                    <th scope="col">Penghasilan Ibu</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Jumlah Tanggungan</th>
                    <th scope="col">Prestasi</th>
                    <th scope="col">Nilai Akademik</th>
                    <th scope="col">Nilai Wawancara</th>
                    <th scope="col">Tombol</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $select = mysqli_query($koneksi, "SELECT * FROM pendaftar");
                        while($data = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                      <td>00<?php echo $data['NISN'] ?></td>
                      <td><?php echo ucfirst($data['nama'])?></td>
                      <td><?php echo $data['asal_skl'] ?></td>                      
                      <td><?php echo $data['tmp_lahir'] ?></td>                      
                      <td><?php echo $data['tgl_lahir'] ?></td>                      
                      <td><?php echo $data['jkl'] ?></td>                      
                      <td><?php echo $data['alamat'];?></td>
                      <td><?php echo $data['nama_ayah'] ?></td>
                      <td><?php echo $data['pekerjaan_ayah'] ?></td>
                      <td><?php echo $data['penghasilan_ayah'] ?></td>
                      <td><?php echo $data['nama_ibu'] ?></td>
                      <td><?php echo $data['pekerjaan_ibu'] ?></td>
                      <td><?php echo $data['penghasilan_ibu'] ?></td>
                      <td><?php echo $data['kondisi_siswa'] ?></td>
                      <td><?php echo $data['jml_tanggungan'] ?></td>
                      <td><?php echo $data['prestasi_siswa'] ?></td>
                      <td><?php echo $data['test_akademik'] ?></td>
                      <td><?php echo $data['test_wawancara'] ?></td>
                      <td class="text-center">
                        <a name="hapus" href="./config/hapus.php?NISN=<?php echo $data['NISN']?>" class="btn-2">Hapus</a>
                        <a href="./config/edit.php?NISN=<?php echo $data['NISN'] ?>" class="btn-2">BELI</a>
                      </td>
                  </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
    </main>
    <footer >
        <div class="copy">@copyright</div>
    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable({
        scrollX: true,
        scrollY: '800px',
        scrollCollapse: true,
        pageLength: 182,
        lengthChange: false,
          });
      });
    </script>
</body>
</html>
