<?php
include 'connect.php';
include 'excel_reader2.php';
?>
<?php
$target = basename($_FILES['file']['name']) ;
move_uploaded_file($_FILES['file']['tmp_name'], $target);
chmod($_FILES['file']['name'],0777);
$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
$jumlah_baris = $data->rowcount($sheet_index=0);
 
$berhasil = 1;
for ($i=2; $i<=$jumlah_baris; $i++){
    $NISN = $data->val($i, 1);
    $nama = $data->val($i, 2);
    $asal_skl = $data->val($i, 3);
    $tmp_lahir = $data->val($i, 4);
    $tgl_lahir = $data->val($i, 5);
    $jkl = $data->val($i, 6);
    $alamat = $data->val($i, 7);
    $nama_ayh = $data->val($i, 8);
    $pkj_ayh = $data->val($i, 9);
    $pha_ayh = $data->val($i, 10);
    $nama_ibu = $data->val($i, 11);
    $pkj_ibu = $data->val($i, 12);
    $pha_ibu = $data->val($i, 13);
    $kds = $data->val($i, 14);
    $jml_tanggungan = $data->val($i, 15);
    $pres = $data->val($i, 16);
    $test_tps = $data->val($i, 17);
    $test_wwc = $data->val($i, 18);

    if($NISN != "" && $nama != ""){  
        mysqli_query($koneksi,"INSERT into pendaftar values('$NISN','$nama','$asal_skl', '$tmp_lahir', '$tgl_lahir', 
        '$jkl', '$alamat', '$nama_ayh', '$pkj_ayh', '$pha_ayh' 
        ,'$nama_ibu', '$pkj_ibu', '$pha_ibu', '$kds', '$jml_tanggungan', '$pres', '$test_tps', '$test_wwc')");
    }
}
unlink($_FILES['file']['name']); 
header("location:../dashboard-admin.php");
?>
