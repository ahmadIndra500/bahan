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
    ['x' => 14, 'y' => 14, 'z' => 0, 'w' => 1, 't' => 1, 'r' => 6],
    ['x' => 12, 'y' => 11, 'z' => 2, 'w' => 1, 't' => 1, 'r' => 4],
    ['x' => 8, 'y' => 9, 'z' => 0, 'w' => 1, 't' => 1, 'r' => 6],
];


$jumlahIterasi = 5;
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
            $dataPoint['pkj_ayah'] + $dataPoint['pkj_ibu'],
            $dataPoint['pha_ayah'] + $dataPoint['pha_ibu'],
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
            <form method="post" enctype="multipart/form-data" action="./config/import.php">
            </form>
            <?php
            foreach ($iterasiData as $iterasi => $dataIterasi) {
                echo "<h2>Hasil Iterasi " . ($iterasi + 1) . "</h2>";
            ?>
            <div class="table-container">
                <table class="tabel data" id="myTable-<?php echo $iterasi + 1; ?>">
                    <thead>
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jarak ke Centroid</th>
                            <th scope="col">Cluster</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataIterasi as $dataPoint) {
                            echo "<tr>";
                            echo "<td>" . $dataPoint['Data'] . "</td>";
                            echo "<td>" . $data[$dataPoint['Data'] - 1]['nama'] . "</td>";
                            echo "<td>" . $dataPoint['Jarak ke Centroid'] . "</td>";
                            echo "<td>" . $dataPoint['Cluster'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
    </main>
    <footer>

    </footer>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                scrollX: true,
                scrollY: '800px',
                scrollCollapse: true,
                responsive: true
            });

            $('#iterasiTable').DataTable({
                scrollX: true,
                scrollY: '800px',
                scrollCollapse: true,
                responsive: true
            });
        });
    </script>
</body>
</html>
