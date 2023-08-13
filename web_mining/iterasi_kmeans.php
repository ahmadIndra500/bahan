<?php
include('./config/connect.php');
?>

<?php
function hitungJarak($x1, $y1, $z1, $w1, $t1, $r1, $x2, $y2, $z2, $w2, $t2, $r2) {
    return sqrt(pow(($x2 - $x1), 2) + pow(($y2 - $y1), 2) + pow(($z2 - $z1), 2) + pow(($w2 - $w1), 2) + pow(($t2 - $t1), 2) + pow(($r2 - $r1), 2));
}

function cariCentroidTerdekat($data, $centroids) {
    $jarakTerdekat = PHP_FLOAT_MAX;
    $centroidTerdekat = -1;

    foreach ($centroids as $index => $centroid) {
        $jarak = hitungJarak(
            $data['pkj_ayah'] + $data['pkj_ibu'],
            $data['pha_ayah'] + $data['pha_ibu'],
            $data['kondisi'],
            $data['jml'],
            $data['prestasi'],
            $data['test_akd'] + $data['test_wwc'],
            $centroid['x'],
            $centroid['y'],
            $centroid['z'],
            $centroid['w'],
            $centroid['t'],
            $centroid['r']
        );
        if ($jarak < $jarakTerdekat) {
            $jarakTerdekat = $jarak;
            $centroidTerdekat = $index;
        }
    }

    return $centroidTerdekat;
}

$data = [];
$select = mysqli_query($koneksi, "SELECT * FROM tranformasi");
while ($row = mysqli_fetch_assoc($select)) {
    $row['jarak'] = 100;
    $data[] = $row;
}

$centroids = [
    ['x' => 14, 'y' => 14, 'z' => 0, 'w' => 1, 't' => 2, 'r' => 6],
    ['x' => 12, 'y' => 11, 'z' => 2, 'w' => 1, 't' => 2, 'r' => 4],
    ['x' => 8, 'y' => 9, 'z' => 0, 'w' => 1, 't' => 2, 'r' => 6],
];

$jumlahIterasi = 4;
$iterasiData = [];
for ($i = 0; $i < $jumlahIterasi; $i++) {
    $clusters = [];
    foreach ($centroids as $index => $centroid) {
        $clusters[$index] = [];
    }
    foreach ($data as $dataPointIndex => $dataPoint) {
        $centroidIndex = cariCentroidTerdekat($dataPoint, $centroids);
        $clusters[$centroidIndex][] = $dataPointIndex;
        $jarak = hitungJarak(
            $dataPoint['pkj_ayah'],
            $dataPoint['pkj_ibu'],
            $dataPoint['pha_ayah'],
            $dataPoint['pha_ibu'],
            $dataPoint['kondisi'],
            $dataPoint['jml'],
            $dataPoint['prestasi'],
            $dataPoint['test_akd'] + $dataPoint['test_wwc'],
            $centroids[$centroidIndex]['x'],
            $centroids[$centroidIndex]['y'],
            $centroids[$centroidIndex]['z'],
            $centroids[$centroidIndex]['w'],
            $centroids[$centroidIndex]['t'],
            $centroids[$centroidIndex]['r']
        );
        $data[$dataPointIndex]['jarak'] = $jarak; 
        $iterasiData[$i][] = [
            'Data' => $dataPointIndex + 1,
            'Jarak ke Centroid' => $jarak,
            'Cluster' => 'Cluster ' . $centroidIndex
        ];
    }
    foreach ($clusters as $index => $cluster) {
        $jumlahData = count($cluster);
        $sumX = 0;
        $sumY = 0;
        $sumZ = 0;
        $sumW = 0;
        $sumT = 0;
        $sumR = 0;

        foreach ($cluster as $dataPointIndex) {
            $dataPoint = $data[$dataPointIndex];
            $sumX += $dataPoint['pkj_ayah'] + $dataPoint['pkj_ibu'];
            $sumY += $dataPoint['pha_ayah'] + $dataPoint['pha_ibu'];
            $sumZ += $dataPoint['kondisi'];
            $sumW += $dataPoint['jml'];
            $sumT += $dataPoint['prestasi'];
            $sumR += $dataPoint['test_akd'] + $dataPoint['test_wwc'];
        }

        if ($jumlahData > 0) {
            $centroids[$index]['x'] = $sumX / $jumlahData;
            $centroids[$index]['y'] = $sumY / $jumlahData;
            $centroids[$index]['z'] = $sumZ / $jumlahData;
            $centroids[$index]['w'] = $sumW / $jumlahData;
            $centroids[$index]['t'] = $sumT / $jumlahData;
            $centroids[$index]['r'] = $sumR / $jumlahData;
        }
    }
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
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="container-logo">
                <img src="./asset/Logoitb.png" alt="">
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
                    <li class=""><a href="index.php"> Data Calon Mahasiswa</a></li>
                    <li class=""><a href="trans_data.php"> Tranformasi data</a></li>
                    <li class=""><a href=""> Proses Data</a></li>
                </ul>
            </nav>
        </aside>

        <div class="container-main">
        <form id="exportForm" method="post">
                <input type="hidden" name="export" value="1">
            </form>
            <table class="tabel data" id="myTable">
                <thead>
                <tr>
                    <th scope="col">NISN</th>
                    <th scope="col">NAma</th>
                    <th scope="col">Pekerjaan orangtua/wali</th>
                    <th scope="col">Penghasilan orangtua/wali</th>
                    <th scope="col">Kondisi pendaftar</th>
                    <th scope="col">Jumlah Tanggungan</th>
                    <th scope="col">Prestasi Pendaftar</th>
                    <th scope="col">Test Internal</th>
                    <th scope="col">Jarak ke Centroid</th>
                    <th scope="col">Cluster</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $lastIterationJarak = array_fill(0, count($data), 0);
                    foreach ($data as $dataPointIndex => $dataPoint) {
                        $centroidIndex = cariCentroidTerdekat($dataPoint, $centroids);
                        $clusterLabel = 'Cluster ' . ($centroidIndex + 1);
                        $jarakKeCentroid = $lastIterationJarak[$dataPointIndex];
                        echo "<tr>";
                        echo "<td>" . $dataPoint['NISN'] . "</td>";
                        echo "<td>" . $dataPoint['nama'] . "</td>";
                        echo "<td>" . ($dataPoint['pkj_ayah'] + $dataPoint['pkj_ibu']) . "</td>";
                        echo "<td>" . ($dataPoint['pha_ayah'] + $dataPoint['pha_ibu']) . "</td>";
                        echo "<td>" . $dataPoint['kondisi'] . "</td>";
                        echo "<td>" . $dataPoint['jml'] . "</td>";
                        echo "<td>" . $dataPoint['prestasi'] . "</td>";
                        echo "<td>" . ($dataPoint['test_akd'] + $dataPoint['test_wwc']) . "</td>";
                        echo "<td>" . $jarakKeCentroid . "</td>";
                        echo "<td>" . $clusterLabel . "</td>";
                        echo "</tr>";
                        $nisn = $dataPoint['NISN'];
                        $nama = $dataPoint['nama'];
                        $centroidIndex = cariCentroidTerdekat($dataPoint, $centroids);
                        $clusterLabel = 'Cluster ' . ($centroidIndex + 1);
                        $jarakKeCentroid = $lastIterationJarak[$dataPointIndex];
                        mysqli_query($koneksi, "INSERT INTO hasil_cluster (NISN, nama, hasil_cluster) VALUES ('$nisn', '$nama', '$clusterLabel')");
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            
            <table class="tabel data" id="iterasiTable">
                <thead>
                <tr>
                    <th scope="col">Iterasi</th>
                    <th scope="col">Jumlah Data</th>
                    <th scope="col">Data</th>
                    <th scope="col">Jarak ke Centroid</th>
                    <th scope="col">Cluster</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($iterasiData as $iterasiIndex => $iterasi) {
                    echo "<tr>";
                    echo "<td rowspan='" . count($iterasi) . "'>Iterasi " . ($iterasiIndex + 1) . "</td>";
                    echo "<td rowspan='" . count($iterasi) . "'>" . count($data) . "</td>";
                    foreach ($iterasi as $dataPoint) {
                        echo "<td>" . $dataPoint['Data'] . "</td>";
                        echo "<td>" . $dataPoint['Jarak ke Centroid'] . "</td>";
                        echo "<td>" . $dataPoint['Cluster'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="export-buttons">
                <button id="exportExcel">Export to Excel</button>
                <button id="exportCSV">Export to CSV</button>
                <button id="exportPDF">Export to PDF</button>
            </div>
        </div>
    </main>
    <footer>
        <div class="copy">@copyright</div>
    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                scrollX: true,
                scrollY: '800px',
                scrollCollapse: true,
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip', 
                buttons: [
                    'excel', 'csv', 'pdf', 'print', 
                ]
            });

            // Mengaktifkan tombol ekspor saat tabel sudah selesai diinisialisasi
            table.buttons().container().appendTo('.export-buttons');

            // Tambahkan kode untuk tombol ekspor ke Excel
            $('#exportExcel').on('click', function () {
                table.button('.exportExcel').trigger();
            });

            // Tambahkan kode untuk tombol ekspor ke CSV
            $('#exportCSV').on('click', function () {
                table.button('.buttons-csv').trigger();
            });

            // Tambahkan kode untuk tombol ekspor ke PDF
            $('#exportPDF').on('click', function () {
                table.button('.exportPDF').trigger();
            });
            $('#iterasiTable').DataTable({
                scrollX: true,
                scrollY: '200px',
                scrollCollapse: true,
                responsive: true,
            });
        });
    </script>
</body>
</html>
