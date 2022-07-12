<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nama_user = $_POST['nama_user'];
    $waktu_order = date("Y/m/d");
    $delivered = 0;


    $perintah = "INSERT INTO tbl_order (nama_user, waktu_order, delivered) VALUES ('$nama_user', '$waktu_order', '$delivered')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Berhasil Order";
        $response['data'] = [
              'nama_user' => $nama_user,
                'waktu_order' => $waktu_order,
                    'delivered' => $delivered
        ];
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal Order";
    }
  
}else{
    $response["kode"] = "0";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);