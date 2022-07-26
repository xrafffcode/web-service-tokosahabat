

<?php
require("koneksiproduk.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_user = $_POST['id_user'];

    $perintah = "SELECT * FROM tbl_keranjang, tbl_user WHERE tbl_keranjang.id_user = '$id_user' and tbl_keranjang.chekout = 'true' and tbl_keranjang.approved = 'false' and tbl_user.id = '$id_user'";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if ($cek > 0) {
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";

        $response["data"] = array();

        while ($ambil = mysqli_fetch_object($eksekusi)) {
            $F["id_item"] = $ambil->id_item;
            $F["nama_item"] = $ambil->nama_item;
            $F["gambar_item"] = $ambil->gambar_item;
            $F["alamat"] = $ambil->alamat;
            $F["harga_pokok"] = $ambil->harga_pokok;


            array_push($response["data"], $F);
        }
    } else {
        $response["kode"] = 0;
        $response["pesan"] = "Data Sudah Di Approve";
    }
} else {
    $response["kode"] = "404";
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);
