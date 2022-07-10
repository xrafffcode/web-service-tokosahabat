<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_item = $_POST['id_item'];
    $kode_item = $_POST['kode_item'];
    $barcode = $_POST['barcode'];
    $nama_item = $_POST['nama_item'];
    $gambar_item = $_POST['gambar_item'];
    $stok_item = $_POST['stok_item'];
    $jenis_item = $_POST['jenis_item'];
    $konversi = $_POST['konversi'];
    $tipe_item = $_POST['tipe_item'];
    $satuan = $_POST['satuan'];
    $harga_pokok = $_POST['harga_pokok'];
    $harga_level = $_POST['harga_level'];
  
    $perintah = "UPDATE tbl_produk SET kode_item='$kode_item', barcode='$barcode', nama_item='$nama_item', gambar_item='$gambar_item', stok_item='$stok_item', jenis_item='$jenis_item', konversi='$konversi', tipe_item='$tipe_item', satuan='$satuan', harga_pokok='$harga_pokok', harga_level='$harga_level' WHERE id_item='$id_item'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Diubah";

    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Diubah";
    }
  
}else{
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);