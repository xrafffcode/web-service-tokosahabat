<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_transaksi = $_POST['id_transaksi'];
    
  
    $perintah = "UPDATE tbl_order SET delivered='Delivered' WHERE id_transaksi='$id_transaksi'";
    $eksekusi = mysqli_query($konek, $perintah);

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