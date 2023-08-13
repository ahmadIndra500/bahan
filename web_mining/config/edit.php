<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemahasiswaan ITBAD</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../asset/logo.png">
</head>
<body>
    <header>
        <div class="container">
            <div class="container-logo">
                <img src="../asset/logo.png" alt="">
            </div>
            <div class="container-nm">
            <h1>Institut Teknologi Dan Bisnis Ahmad Dahlan</h1>
            </div>
            <div class="acc">
                
            </div>
        </div>
    </header>
    <main>
        <aside class="left-sidebar">
            <nav class="sidebar-nav">
                <ul class="side">
                    <li class=""><a href="../dashboard-admin.php"> Data Calon Mahasiswa</a></li>
                    <li class=""><a href="trans_data.php"> Tranformasi data</a></li>
                    <li class=""><a href="proses_data.php"> Proses Data</a></li>
                    <li class=""><a href="hasil_cluster.php"> Hasil Cluster</a></li>
                    <li class=""><a href="logout.php?logout=true"> Log Out</a></li>
                </ul>
            </nav>
        </aside>

        <div class="cont-tmb">
        <H1>Silakan Mengisi Data Mahasiswa</H1>
          <div class="cont">
            <?php
            $id = $_GET['NISN'];
	        $d = mysqli_query($koneksi,"select * from pendaftar where NISN='$id'");
	        while($data = mysqli_fetch_array($d)){
                ?>
            <form id="tambah" action="update.php" method="post">
                <div class="form-group" id="only-number">
                    <label>NISN:</label>
                    <input type="number" name="id_mhs" class="form-control" placeholder="<?php echo $data['NISN']?>" autocomplete="off" value="value=<?php echo $data['NISN']?>">
                </div>
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" placeholder="<?php echo $data['nama']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Asal Sekolah:</label>
                    <input type="text" name="asal-skl" class="form-control" placeholder="<?php echo $data['asal_skl']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Tempat Lahir:</label>
                    <input type="text" name="tempat-lahir" class="form-control" placeholder="<?php echo $data['tmp_lahir']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir:</label>
                    <input type="date" name="tanggal-lahir" class="form-control" placeholder="<?php echo $data['tgl_lahir']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <input type="text" name="jk" class="form-control" placeholder="<?php echo $data['jkl']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Alamat:</label>
                    <input type="text" name="alamat" class="form-control" placeholder="<?php echo $data['alamat']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Nama Ayah:</label>
                    <input type="text" name="nama_ayh" class="form-control" placeholder="nama_ayah" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ayah:</label>
                    <br>
                    <br>
                    <select name="pkj_ayh" id="">
                        <option value="PNS">Pegawai Negeri Sipil/TNI/POLRI</option>
                        <option value="Peg. Swasta">pegawai Swasta</option>
                        <option value="Petani">petani</option>
                        <option value="Supir">Supir</option>
                        <option value="Pekerjaan Tidak Tetap">Pekerjaan Tidak Tetap</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pengasilan Ayah:</label>
                    <br>
                    <br>
                    <select name="pha_ayh" id="">
                        <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                        <option value="< Rp. 250.000">< Rp. 250.000</option>
                        <option value="Rp. 250.001 - Rp. 500.000">Rp. 250.001 - Rp. 500.000</option>
                        <option value="Rp. 500.001 - Rp. 750.000">Rp. 500.001 - Rp. 750.000</option>
                        <option value="Rp. 750.001 - Rp. 1.000.000">Rp. 750.001 - Rp. 1.000.000</option>
                        <option value="Rp. 1.000.001 - Rp. 1.250.000">Rp. 1.000.001 - Rp. 1.250.000</option>
                        <option value="Rp. 1.250.001 - Rp. 1.500.000">Rp. 1.250.001 - Rp. 1.500.000</option>
                        <option value="Rp. 1.500.001 - Rp. 1.550.000">Rp. 1.500.001 - Rp. 1.550.000</option>
                        <option value="Rp. 1.500.001 - Rp. 1.750.000">Rp. 1.500.001 - Rp. 1.750.000</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Ibu:</label>
                    <input type="text" name="nama_ibu" class="form-control" placeholder="<?php echo $data['nama_ibu']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ibu:</label>
                    <br>
                    <br>
                    <select name="pkj_ibu" id="">
                        <option value="PNS">Pegawai Negeri Sipil/TNI/POLRI</option>
                        <option value="Peg. Swasta">pegawai Swasta</option>
                        <option value="Petani">petani</option>
                        <option value="Supir">Supir</option>
                        <option value="Pekerjaan Tidak Tetap">Pekerjaan Tidak Tetap</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pengasilan Ibu:</label>
                    <br>
                    <br>
                    <select name="pha_ibu" id="">
                    <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                        <option value="< Rp. 250.000">< Rp. 250.000</option>
                        <option value="Rp. 250.001 - Rp. 500.000">Rp. 250.001 - Rp. 500.000</option>
                        <option value="Rp. 500.001 - Rp. 750.000">Rp. 500.001 - Rp. 750.000</option>
                        <option value="Rp. 750.001 - Rp. 1.000.000">Rp. 750.001 - Rp. 1.000.000</option>
                        <option value="Rp. 1.000.001 - Rp. 1.250.000">Rp. 1.000.001 - Rp. 1.250.000</option>
                        <option value="Rp. 1.250.001 - Rp. 1.500.000">Rp. 1.250.001 - Rp. 1.500.000</option>
                        <option value="Rp. 1.500.001 - Rp. 1.550.000">Rp. 1.500.001 - Rp. 1.550.000</option>
                        <option value="Rp. 1.500.001 - Rp. 1.750.000">Rp. 1.500.001 - Rp. 1.750.000</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kondisi Siswa:</label>
                    <br>
                    <br>
                    <select name="knd" id="">
                        <option value="Yatim">Yatim</option>
                        <option value="Piatu">Piatu</option>
                        <option value="Yatim/Piatu">Yatim/Piatu</option>
                        <option value="Lengkap">Lengkap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Tanggungan:</label>
                    <input type="text" name="jml_tgg" class="form-control" placeholder="<?php echo $data['jml_tanggungan']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Prestasi Siswa:</label>
                    <input type="text" name="pres" class="form-control" placeholder="<?php echo $data['prestasi_siswa']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Test Internal Akademik:</label>
                    <input type="number" name="nilai_akd" class="form-control" placeholder="<?php echo $data['test_akademik']?>" autocomplate="off">
                </div>
                <div class="form-group">
                    <label>Test Internal Wawancara:</label>
                    <input type="number" name="nilai_wwc" class="form-control" placeholder="<?php echo $data['test_wawancara']?>" autocomplate="off">
                </div>
                <button type="submit" name="simpan" class="btn">Simpan</button>
            </form>
            <?php
            };
            ?>
          </div>  
        </div>
    </main>
    <footer>
            <div class="copy">@copyright</div>
    </footer>
    <script>
    $(function() {
      $('#only-number').on('keydown', '#number', function(e){
          -1!==$
          .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
          .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
          || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
          && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
      });
    })
</script>
</body>
</html>