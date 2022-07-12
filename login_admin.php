<?php

include "koneksi.php";

if($_POST){
    
    //Data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $response = []; //Data Response
    
    //Cek data didalam database
    $userQuery = $konek->prepare("SELECT * FROM adminuser WHERE username = ?");
    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if($userQuery->rowCount() == 0){
        $response["status"] = false;
        $response["message"] = "Username tidak terdaftar";
    }
    else{
      $passwordDB = $query['password'];

      if(strcmp(($password), $passwordDB) == 0){
        $response["status"] = true;
        $response["message"] = "Login berhasil";
        $response["data"] = [
            "id" => $query['id'],
            "username" => $query['username'],
            "password" => $query['password'],
            "nama" => $query['nama'],
            "type_id" => $query['type_id'],
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