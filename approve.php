<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_transaksi = $_POST['id_transaksi'];
    $id_user = $_POST['id_user'];
  
    $perintah = "UPDATE tbl_order SET delivered='Delivered' WHERE id_transaksi='$id_transaksi'";
    $perintah2 = "UPDATE tbl_keranjang SET approved='true' WHERE id_user='$id_user' and chekout='true'";
    $eksekusi = mysqli_query($konek, $perintah);
    $eksekusi2 = mysqli_query($konek, $perintah2);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Approve Sukses";

    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Approve Gagal";
    }
  
}else{
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);