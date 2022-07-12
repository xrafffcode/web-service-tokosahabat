<?php
require("koneksiproduk.php");

$perintah = "SELECT * FROM tbl_order";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0){
    $response["kode"] = 1;
    $response["pesan"] = "Data Tersedia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id_transaksi"] = $ambil->id_transaksi;
        $F["nama_user"] = $ambil->nama_user;
        $F['waktu_order'] = $ambil->waktu_order;
        $F["delivered"] = $ambil->delivered;

        array_push($response["data"], $F);
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Produk";
}

echo json_encode($response);
mysqli_close($konek);