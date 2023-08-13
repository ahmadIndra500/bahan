<?php 

include 'connect.php';
 
// menangkap data yang di kirim dari form
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
 
// update data ke database
mysqli_query($koneksi,"update pendaftar set NISN='$id',nama='$nama',asal_skl='$asal_skl',tmp_lahir='$tmp',tgl_lahir='$tgl',jkl='$jk',alamat='$almt',
nama_ayah='$nm_ayah',pekerjaan_ayah='$pkj_ayah',penghasilan_ayah='$pha_ayah',nama_ibu='$nm_ibu',Pekerjaan_ibu='$pkj_ibu',penghasilan_ibu='$pha_ibu',kondisi_siswa='$kondisi',jml_tanggungan='$jml',prestasi_siswa='$pres',
test_akademik='$nilai_akd',test_wawancara='$nilai_wwc'");

header("location:../dashboard-admin.php");
 
?>