<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" href="../asset/logo.png">
    <title>Kemahasiswaan ITBAD</title>
    
    <style>
        input:hover {
            cursor: default;
            border: none;
        }
        input{
          border:none;
        }
    </style>
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
                    <li class=""><a href="../dashboard-admin.php"> Data Calon Mahasiswa</a></li>
                    <li class=""><a href="trans_data.php"> Tranformasi data</a></li>
                    <li class=""><a href="proses_data.php"> Proses Data</a></li>
                    <li class=""><a href="hasil_cluster.php"> Hasil Cluster</a></li>
                    <li class=""><a href="logout.php?logout=true"> Log Out</a></li>
                </ul>
            </nav>
        </aside>

        <div class="container-main">
            <form method="post" enctype="multipart/form-data" action="simpan_data.php">
            <table class="tabel data" id="myTable">
                <thead>
                  <tr>
                    <th scope="col" >NISN</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Pekerjaan Ayah</th>
                    <th scope="col">Penghasilan Ayah</th>
                    <th scope="col">Pekerjaan Ibu</th>
                    <th scope="col">Penghasilan Ibu</th>
                    <th scope="col" >Kondisi Siswa</th>
                    <th scope="col">Jumlah Tanggungan</th>
                    <th scope="col">Prestasi Siswa</th>
                    <th scope="col">Test Akademik</th>
                    <th scope="col">Test Wawancara</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $pha1=["Rp. 5.250.001 - Rp. 5.500.000","Rp. 4.750.001 - Rp. 5.000.000","Rp. 5.000.001 - Rp. 5.250.000","Rp. 5.500.001 - Rp. 5.550.000","Rp. 7.000.001 - Rp. 7.250.000","Rp. 8.250.001 - Rp. 8.500.000"];
                        $pha2=["Rp. 4.000.001 - Rp. 4.250.000","Rp. 4.250.001 - Rp. 4.500.000","Rp. 4.000.001 - Rp. 4.250.000","Rp. 4.500.001 - Rp. 4.750.000"];
                        $pha3=["Rp. 3.000.001 - Rp. 3.250.000","Rp. 3.250.001 - Rp. 3.500.000","Rp. 3.500.001 - Rp. 3.550.000","Rp. 3.550.001 - Rp. 3.750.000","Rp. 3.750.001 - Rp. 4.000.000"];
                        $pha4=["Rp. 2.000.001 - Rp. 2.250.000","Rp. 2.250.001 - Rp. 2.500.000","Rp. 2.500.001 - Rp. 2.550.000","Rp. 2.500.001 - Rp. 2.750.000","Rp. 2.550.001 - Rp. 2.750.000","Rp. 2.750.001 - Rp. 3.000.000"];
                        $pha5=["Rp. 1.000.001 - Rp. 1.250.000","Rp. 1.250.001 - Rp. 1.500.000","Rp. 1.500.001 - Rp. 1.750.000","Rp. 1.500.001 - Rp. 1.550.000","Rp. 1.550.001 - Rp. 1.750.000","Rp. 1.750.001 - Rp. 2.000.000"];
                        $pha6=["Rp. 250.001 - Rp. 500.000","Rp. 500.001 - Rp. 750.000","Rp. 750.001 - Rp. 1.000.000"];
                        $jmltg1=["1 Orang","2 Orang"];
                        $jmltg2=["4 Orang","5 Orang","3 Orang"];
                        $jmltg3=["6 Orang","7 Orang"];
                        $pkj6=["Pekerjaan Tidak Tetap","Lainnya"];
                        $pkj5=["Petani","Nelayan","Supir"];
                        $sta=["Lengkap","Bercerai"];
                        $select= mysqli_query($koneksi, "SELECT * FROM pendaftar");
                        while($data= mysqli_fetch_array($select)){
                    ?>
                    <tr>
                    <td><input style="border: none;" name="NISN[]" value="00<?php echo $data['NISN'] ?>" readonly disable></td>
                    <td><input name="nama[]" value="<?php echo $data['nama']?>" readonly disable></td>
                    <td><input name="jkl[]" value="<?php echo $data['jkl'] ?>" readonly disable></td>                      
                    <td><input name="pkj_ayah[]" value="<?php if($data['pekerjaan_ayah'] == "TNI / POLRI"){
                        echo 1;
                      }elseif($data['pekerjaan_ayah'] == "PNS"){
                        echo 2;
                      }elseif($data['pekerjaan_ayah'] == "Peg. Swasta"){
                        echo 3;
                      }elseif($data['pekerjaan_ayah'] == "Wirausaha"){
                        echo 4;
                      }elseif(in_array($data['pekerjaan_ayah'], $pkj5)){
                        echo 5;
                      }elseif(in_array($data['pekerjaan_ayah'], $pkj6)){
                        echo 6;
                      }elseif($data['pekerjaan_ayah'] == "TIDAK BEKERJA"){
                        echo 7;
                      }?>" readonly disable></td>
                    <td><input name="pha_ayah[]" value="<?php if(in_array($data['penghasilan_ayah'], $pha1)) {
                        echo 1;
                      }elseif(in_array($data['penghasilan_ayah'], $pha2)){
                        echo 2;
                      }elseif (in_array($data['penghasilan_ayah'], $pha3)) {
                        echo 3;
                      }elseif(in_array($data['penghasilan_ayah'], $pha4)){
                        echo 4;
                      }elseif(in_array($data['penghasilan_ayah'], $pha5)){
                        echo 5;
                      }elseif(in_array($data['penghasilan_ayah'], $pha6)){
                        echo 6;
                      }elseif($data['penghasilan_ayah'] == "< Rp. 250.000"){
                        echo 7;
                      }elseif($data['penghasilan_ayah'] == "Tidak Berpenghasilan"){
                        echo 8;
                      }?>" readonly disable></td>
                    <td><input name="pkj_ibu[]" value="<?php if($data['pekerjaan_ibu'] == "TNI / POLRI"){
                        echo 1;
                      }elseif($data['pekerjaan_ibu'] == "PNS"){
                        echo 2;
                      }elseif($data['pekerjaan_ibu'] == "Peg. Swasta"){
                        echo 3;
                      }elseif($data['pekerjaan_ibu'] == "Wirausaha"){
                        echo 4;
                      }elseif(in_array($data['pekerjaan_ibu'], $pkj5)){
                        echo 5;
                      }elseif(in_array($data['pekerjaan_ibu'], $pkj6)){
                        echo 6;
                      }elseif($data['pekerjaan_ibu'] == "TIDAK BEKERJA"){
                        echo 7;
                      } ?>" readonly disable></td>
                    <td><input name="pha_ibu[]" value="<?php if(in_array($data['penghasilan_ibu'], $pha1)) {
                        echo 1;
                      }elseif(in_array($data['penghasilan_ibu'], $pha2)){
                        echo 2;
                      }elseif (in_array($data['penghasilan_ibu'], $pha3)) {
                        echo 3;
                      }elseif(in_array($data['penghasilan_ibu'], $pha4)){
                        echo 4;
                      }elseif(in_array($data['penghasilan_ibu'], $pha5)){
                        echo 5;
                      }elseif(in_array($data['penghasilan_ibu'], $pha6)){
                        echo 6;
                      }elseif($data['penghasilan_ibu'] == "< Rp. 250.000"){
                        echo 7;
                      }elseif($data['penghasilan_ibu'] == "Tidak Berpenghasilan"){
                        echo 8;
                      } ?>" readonly disable></td>
                    <td><input name="knd[]" value="<?php if(in_array($data['kondisi_siswa'], $sta)){
                        echo 0;
                      }elseif($data['kondisi_siswa'] == "Piatu"){
                        echo 1;
                      }elseif($data['kondisi_siswa'] == "Yatim"){
                        echo 2;
                      }elseif($data['kondisi_siswa'] == "Yatim/Piatu"){
                        echo 3;
                      } ?>" readonly disable></td>
                    <td><input name="jml[]" value="<?php if(in_array($data['jml_tanggungan'], $jmltg1 )){
                        echo 1;
                      }elseif (in_array($data['jml_tanggungan'], $jmltg2 )) {
                        echo 2;
                      }elseif (in_array($data['jml_tanggungan'], $jmltg3 )) {
                        echo 3;
                      } else{
                        echo 4;
                      }  ?>" readonly disable></td>
                    <td><input name="pres[]" value="<?php if($data['prestasi_siswa' ] == "Tidak Ada"){
                        echo 1;
                      }else{
                        echo 2;
                      } ?>" readonly disable></td>
                    <td><input name="test_akademik[]" value="<?php if($data['test_akademik'] <= 51){
                        echo 1;
                      }elseif($data['test_akademik'] > 51 && $data['test_akademik'] <= 69){
                        echo 2;
                      }elseif($data['test_akademik'] > 69 && $data['test_akademik'] <= 89){
                        echo 3;
                      }elseif($data['test_akademik'] > 89){
                        echo 4;
                      } ?>" readonly disable></td>
                    <td><input name="test_wwc[]" value="<?php if($data['test_wawancara'] <= 51){
                        echo 1;
                      }elseif($data['test_wawancara'] > 51 && $data['test_wawancara'] <= 69){
                        echo 2;
                      }elseif($data['test_wawancara'] > 69 && $data['test_wawancara'] <= 89){
                        echo 3;
                      }elseif($data['test_wawancara'] > 89){
                        echo 4;
                      }?>" readonly disable></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>
              <input type="submit" value="Simpan">
            </form>
         </div>
    </main>
    <footer>
          <div class="copy">@copyright</div>
    </footer>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable({
        scrollX: true,
        scrollY: '800px',
        scrollCollapse: true,
        pageLength: 50,
          });
      });
    </script>
    <script>
      var input = document.getElementById("myInput");
      input.setAttribute("readonly", "readonly");
    </script>
</body>
</html>