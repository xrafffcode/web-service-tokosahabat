

<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST['id_user'];
  
    $perintah = "SELECT * FROM tbl_keranjang WHERE id_user = '$id_user' and chekout = 'false'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";

        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_item"] = $ambil->id_item;
            $F["nama_item"] = $ambil->nama_item;
            $F["gambar_item"] = $ambil->gambar_item;
          
            $F["harga_pokok"] = $ambil->harga_pokok;
            $F["chekout"] = $ambil->chekout;
            

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