<?php

include "koneksi.php";

if($_POST){
    
    //Data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $response = []; //Data Response
    
    //Cek data didalam database
    $userQuery = $konek->prepare("SELECT * FROM tbl_user WHERE email = ?");
    $userQuery->execute(array($email));
    $query = $userQuery->fetch();

    if($userQuery->rowCount() == 0){
        $response["status"] = false;
        $response["message"] = "Email tidak terdaftar";
    }
    else{
      $passwordDB = $query['password'];

      if(strcmp(md5($password), $passwordDB) == 0){
        $response["status"] = true;
        $response["message"] = "Login berhasil";
        $response["data"] = [
            "id_user" => $query['id'],
            "username" => $query['username'],
            "email" => $query['email'],
            "password" => $query['password'],
            "nama" => $query['nama'],
            "telepon" => $query['telepon']
        ];
      }
      else{
        $response["status"] = false;
        $response["message"] = "Password salah";
      }
    }

    $json = json_encode($response, JSON_PRETTY_PRINT);

    echo $json;
}