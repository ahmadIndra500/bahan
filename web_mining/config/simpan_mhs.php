<?php
include "connect.php";

$id=$_POST['id_mhs'];
$nama=$_POST['nama'];
$asal_skl=$_POST['asal-skl'];
$tmp=$_POST['tempat-lahir'];
$tgl=$_POST['tanggal-lahir'];
$jk=$_POST['jk'];
$almt=$_POST['alamat'];
$nm_ayah=$_POST['nama_ayh'];
$pkj_ayah= $_POST['pkj_ayh'];
$pha_ayah= $_POST['pha_ayh'];
$nm_ibu=$_POST['nama_ibu'];
$pkj_ibu= $_POST['pkj_ibu'];
$pha_ibu= $_POST['pha_ibu'];
$kondisi= $_POST['knd'];
$jml= $_POST['jml_tgg'];
$pres= $_POST['pres'];
$nilai_akd= $_POST['nilai_akd'];
$nilai_wwc=$_POST['nilai_wwc'];

      if (empty($_POST['id_mhs'])||empty($_POST['nama'])||empty($_POST['asal-skl'])||empty($_POST['tempat-lahir'])
      ||empty($_POST['tanggal-lahir'])||empty($_POST['jk'])||empty($_POST['alamat'])
      ||empty($_POST['nama_ayh'])||empty($_POST['pkj_ayh'])||empty($_POST['pha_ayh'])
      ||empty($_POST['nama_ibu'])||empty($_POST['pkj_ibu'])||empty($_POST['pha_ibu'])
      ||empty($_POST['knd'])||empty($_POST['jml_tgg'])||empty($_POST['pres'])||empty($_POST['nilai_akd'])||empty($_POST['nilai_wwc'])) {
?>
    <script language="JavaScript">
      alert('Data Harap Dilengkapi!');
      document.location='input_mhs.php';
    </script>
<?php
}else{
  $jml_tgg_orang = $jml_tgg ." Orang"; 
  $sql="INSERT INTO pendaftar (NISN,nama,asal_skl,tmp_lahir,tgl_lahir,jkl,alamat,nama_ayah,pekerjaan_ayah,penghasilan_ayah,nama_ibu,Pekerjaan_ibu,penghasilan_ibu,kondisi_siswa,jml_tanggungan,prestasi_siswa,test_akademik,test_wawancara) VALUES
  ('$id','$nama','$asal_skl','$tmp','$tgl','$jk','$almt','$nm_ayah','$pkj_ayah','$pha_ayah','$nm_ibu','$pkj_ibu','$pha_ibu','$kondisi','$jml_tgg_orang','$pres','$nilai_akd','$nilai_wwc')";
  $hasil=mysqli_query($koneksi,$sql);

  if ($hasil) {
    $message="Berhasil Memasukan Data";
    echo "<script>alert('$message');
    window.location.href='input_mhs.php';</script>";
}
else {
	echo "Gagal insert data";
	exit;
}  
}
?>