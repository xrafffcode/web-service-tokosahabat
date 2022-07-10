<?php

include "koneksi.php";

if($_POST){

    //POST DATA
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_STRING);


    $response = [];

    //Cek username didalam databse
    $userQuery = $konek->prepare("SELECT * FROM tbl_user where email = ?");
    $userQuery->execute(array($email));

    // Cek username apakah ada tau tidak
    if($userQuery->rowCount() != 0){
        // Beri Response
        $response['status']= false;
        $response['message']='Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO tbl_user (email,username, password, nama, telepon) values (:email, :username, :password, :nama, :telepon)';
        $statement = $konek->prepare($insertAccount);

        try{
            //Eksekusi statement db
            $statement->execute([
                ':email' => $email,
                ':username' => $username,
                ':password' => md5($password),
                ':nama' => $nama,
                ':telepon' => $telepon
            ]);

            //Beri response
            $response['status']= true;
            $response['message']='Akun berhasil didaftar';
            $response['data'] = [
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'telepon' => $telepon
            ];
        } catch (Exception $e){
            die($e->getMessage());
        }

    }
    
    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print JSON
    echo $json;
}