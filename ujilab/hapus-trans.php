<?php
    include("koneksi.php");

    $id = $_GET['id_transaksi'];
    $query_get_transaksi = "SELECT * FROM transaksi WHERE id_transaksi = '$id'";
    $result_get_transaksi = mysqli_query($conn, $query_get_transaksi);

    if ($result_get_transaksi) {
        $data_transaksi = mysqli_fetch_array($result_get_transaksi);

        if ($data_transaksi) {
            // Mengembalikan stok barang
            $barang_id = $data_transaksi['kd_barang'];
            $jumlah_beli = $data_transaksi['jmlbeli'];

            $query_update_stok = "UPDATE barang SET stokbrg = stokbrg + $jumlah_beli WHERE kd_barang = '$barang_id'";
            $result_update_stok = mysqli_query($conn, $query_update_stok);

            if ($result_update_stok) {
                // Hapus transaksi dari database
                $query_delete_transaksi = "DELETE FROM transaksi WHERE id_transaksi = '$id'";
                $result_delete = mysqli_query($conn, $query_delete_transaksi);

                if ($result_delete) {
                    header("Location: index.php"); // Sesuaikan dengan halaman yang ingin Anda tuju setelah menghapus transaksi
                } else {
                    echo "Gagal menghapus transaksi.";
                }
            } else {
                echo "Gagal mengembalikan stok barang.";
            }
        } else {
            echo "Data transaksi tidak ditemukan.";
        }
    } else {
        echo "Gagal mengambil data transaksi.";
    }
?>
