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
    <title>Kemahasiswaan ITBAD</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
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
            <i class="fa-solid fa-user" style="color: #000000;"></i>
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
            <hr >
            <br>
            <table id="myTable">
                <thead>
                  <tr>
                    <th scope="col" >NISN</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Layak</th>
                    <th scope="col">Dipertimbangkan</th>
                    <th scope="col">Tidak Layak</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $select = mysqli_query($koneksi, "SELECT * FROM hasil_cluster");
                        while($data = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                      <td>00<?php echo $data['NISN'] ?></td>
                      <td><?php echo ucfirst($data['nama'])?></td>
                      <td style="text-align: center"><?php if($data['hasil_cluster'] == "Cluster 0"){
                        echo 'Layak';
                      }elseif($data['hasil_cluster'] !== "Cluster 1"){
                       echo '';
                      } ?></td>                                                               
                      <td style="text-align: center"><?php if($data['hasil_cluster'] == "Cluster 1"){
                        echo 'Dipertimbangkan';
                      }elseif($data['hasil_cluster'] !== "Cluster 2"){
                        echo '';
                      } ?></td>                                                               
                      <td style="text-align: center"><?php if($data['hasil_cluster'] == "Cluster 2"){
                        echo 'Tidak Layak';
                      }elseif($data['hasil_cluster'] !== "Cluster 2"){
                        echo '';
                      } ?></td>                                                               
                  </tr>
                    <?php } ?>
                </tbody>
            </table>
            
         </div>
    </main>
    <footer >
        <div class="footer-main">
            <div class="left">lorem</div>
            <div class="center">sdf</div>
            <div class="right">fsdfsf</div>
        </div>
        <div class="copy">@copyright</div>
    </footer>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
        scrollX: true,
        scrollY: '800px',
        scrollCollapse: true,
        pageLength: 182,
        lengthChange: false,
        autoWidth: false,
        dom: 'Bfrtip', 
        buttons: [
            {
                extend: 'csv',
                action: function (e, dt, node, config) {
                        if (confirm('Apakah Anda Ingin Mengexport dalam bentuk CSV?')) {
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
                        }
                    }
            }, 
            {
                extend: 'print',
                text: 'Export to PDF',
                action: function (e, dt, node, config) {
                        if (confirm('Apakah Anda Ingin Mengexport dalam bentuk pdf?')) {
                           $.fn.dataTable.ext.buttons.print.action(e, dt, node, config);
                        }
                    }
            },
        ]
        });
    });
    </script>
</body>
</html>
