<?php
require("koneksiproduk.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gambar_item = $_POST['gambar_item'];
    $kode_item = $_POST['kode_item'];
    $barcode = $_POST['barcode'];
    $nama_item = $_POST['nama_item'];
    $stok_item = $_POST['stok_item'];
    $jenis_item = $_POST['jenis_item'];
    $konversi = $_POST['konversi'];
    $tipe_item = $_POST['tipe_item'];
    $satuan = $_POST['satuan'];
    $harga_pokok = $_POST['harga_pokok'];
    $harga_level = $_POST['harga_level'];

    $perintah = "INSERT INTO tbl_produk (gambar_item, kode_item, barcode, nama_item, stok_item, jenis_item, konversi, tipe_item, satuan, harga_pokok, harga_level) VALUES ('$gambar_item', '$kode_item', '$barcode', '$nama_item', '$stok_item', '$jenis_item', '$konversi', '$tipe_item', '$satuan', '$harga_pokok', '$harga_level')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Ditambahkan";
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Ditambahkan";
    }
} else {
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);
