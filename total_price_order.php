

<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST['id_user'];
  
    $perintah = "SELECT SUM(harga_pokok) AS total_harga FROM tbl_keranjang WHERE id_user = '$id_user' and chekout = 'true' and approved = 'false'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";

        $response["data"] = array();
        
        while($ambil = mysqli_fetch_object($eksekusi)){

          
            $F["total_harga"] = $ambil->total_harga;


            array_push($response["data"], $F);
        }
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Keranjang Kosong";
    }
  
}else{
    $response["kode"] = "404";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);