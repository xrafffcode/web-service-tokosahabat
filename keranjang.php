<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST['id_user'];
    $id_item = $_POST['id_item'];
    $gambar_item = $_POST['gambar_item'];
    $nama_item = $_POST['nama_item'];
    $harga_pokok = $_POST['harga_pokok'];


    $perintah = "INSERT INTO tbl_keranjang (id_user, id_item, gambar_item, nama_item, harga_pokok) VALUES ('$id_user', '$id_item', '$gambar_item', '$nama_item', '$harga_pokok')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Berhasil Ditambahkan ke Keranjang";
        $response['data'] = [
            'id_user' => $id_user,
            'id_item' => $id_item,
            'gambar_item' => $gambar_item,
            'nama_item' => $nama_item,
            'harga_pokok' => $harga_pokok
        ];
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal Ditambahkan ke Keranjang";
    }
  
}else{
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);