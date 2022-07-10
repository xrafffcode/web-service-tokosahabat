<?php

$konek = null;

try{
    //Config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbsahabat";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $konek = new PDO($database, $username, $password);
    $konek->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($connection){
    //     echo "Koneksi Berhasil";
    // } else {
    //     echo "Gagal gan";
    // }


} catch (PDOException $e){
    echo "Error ! " . $e->getMessage();
    die;
}

?>