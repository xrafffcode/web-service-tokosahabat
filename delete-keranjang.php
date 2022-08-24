<?php
require("koneksiproduk.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_keranjang = $_POST['id_keranjang'];

    $perintah = "DELETE FROM tbl_keranjang WHERE id_keranjang = '$id_keranjang'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Keranjang Berhasil Dihapus";
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Keranjang Gagal Dihapus";
    }
} else {
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);
