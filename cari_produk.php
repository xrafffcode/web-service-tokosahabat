

<?php
require("koneksiproduk.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nama_item = $_POST['nama_item'];
  
    $perintah = "SELECT * FROM tbl_produk WHERE nama_item LIKE '%$nama_item%'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";

        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_item"] = $ambil->id_item;
            $F["kode_item"] = $ambil->kode_item;
            $F["barcode"] = $ambil->barcode;
            $F["nama_item"] = $ambil->nama_item;
            $F["gambar_item"] = $ambil->gambar_item;
            $F["stok_item"] = $ambil->stok_item;
            $F["jenis_item"] = $ambil->jenis_item;
            $F["konversi"] = $ambil->konversi;
            $F["tipe_item"] = $ambil->tipe_item;
            $F["satuan"] = $ambil->satuan;
            $F["harga_pokok"] = $ambil->harga_pokok;
            $F["harga_level"] = $ambil->harga_level;
                

            array_push($response["data"], $F);
        }
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Tidak Ada Produk";
    }
  
}else{
    $response["kode"] = "404";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);