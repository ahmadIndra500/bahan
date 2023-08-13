<?php 
    include "koneksi.php";
    $id= $_GET['id_transaksi'];
    $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang on transaksi.kd_barang=barang.kd_barang WHERE id_transaksi='$id'");
    $data = mysqli_fetch_array($select);
    function rupiah($angka){
        $hasil_rp= "Rp " . number_format($angka,2,',','.');
        return $hasil_rp;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group{
            margin:10px;
        }
        label{
            margin-right:1px;
        }
        thead,th,td{
            border: 1px solid #000;
            width: 300px;
        }
        table{
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
      <section class="content">
        <div class="row">
            <div>
                <div class="header-print">
                    <h2><strong>No Tagihan </strong><?php echo $data['id_transaksi']; ?> </h2>
                </div>
            </div>
        </div>
          <div class="main-print">
            <div class="from-print">
              From
              <address>
                <strong>Admin Sahretech</strong><br>
                Jl. Sudirman No.3012, Palembang<br>
                Kec. Palembang Raya, Palembang,<br>
                Sumatera selatan 30961<br>
                Phone: (804) 123-5432<br>
                Email: info@sahretech.com
              </address>
            </div>
            <div class="to-print">
              To
              <address>
                Ahmad Indra Maulana <br>
                Jl. Sudirman No. 3012, Palembang<br>
                Kec. Palembang Raya, Palembang,<br>
                Sumatera selatan 30961<br>
                Phone: (555) 539-1037<br>
                Email: nbelputra437@gmail.com
              </address>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>No Tagihan</th>
                  <th>Tgl Tagihan</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Total Bayar</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data['id_transaksi']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($data['tgltransaksi'])); ?></td>
                        <td><?php echo $data['namabrg']; ?></td>
                        <td><?php echo $data['jmlbeli']; ?></td>
                        <td><?php echo rupiah($data['totalbayar']) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><b>Total Biaya</b></td>
                        <td><b><?php echo rupiah($data['totalbayar']) ?></b></td>
                    </tr>
                </tbody>
            </table>
          </div>
      </section>
    </div>
  </body>
   <script>
      window.print(
  </script>