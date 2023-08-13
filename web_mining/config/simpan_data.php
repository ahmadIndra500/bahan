<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NISN = $_POST['NISN'];
    $nama = $_POST['nama'];
    $jkl = $_POST['jkl'];
    $pkj_ayah = $_POST['pkj_ayah'];
    $pha_ayah = $_POST['pha_ayah'];
    $pkj_ibu = $_POST['pkj_ibu'];
    $pha_ibu = $_POST['pha_ibu'];
    $knd = $_POST['knd'];
    $jml = $_POST['jml'];
    $pres = $_POST['pres'];
    $test_akd = $_POST['test_akademik'];
    $test_wwc = $_POST['test_wwc'];

    for ($i = 0; $i < count($NISN); $i++) {
        $insert_query = "INSERT INTO tranformasi (NISN, Nama, jkl, pkj_ayah, pha_ayah, pkj_ibu, pha_ibu, kondisi, jml, prestasi, test_akd, test_wwc) 
        VALUES ('$NISN[$i]', '$nama[$i]', '$jkl[$i]', '$pkj_ayah[$i]', '$pha_ayah[$i]', '$pkj_ibu[$i]', '$pha_ibu[$i]', '$knd[$i]', '$jml[$i]', '$pres[$i]', '$test_akd[$i]', '$test_wwc[$i]')";

        $insert_result = mysqli_query($koneksi, $insert_query);

        if (!$insert_result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }
}
    header("Location: trans_data.php");
    exit();
} else {
    header("Location: ../trans_data.php");
    exit();
}
?>