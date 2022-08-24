<?php
require("koneksiproduk.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $alamat = $_POST['alamat'];

    $perintah = "UPDATE tbl_user SET alamat='$alamat' WHERE id='$id'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Diubah";
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Diubah";
    }
} else {
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);
