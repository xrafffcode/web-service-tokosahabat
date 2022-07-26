<?php

include "koneksi.php";

if ($_POST) {

    //POST DATA
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $response = [];

    //Cek username didalam databse
    $userQuery = $konek->prepare("SELECT * FROM tbl_user where email = ?");
    $userQuery->execute(array($email));

    // Cek username apakah ada tau tidak
    if ($userQuery->rowCount() != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = 'Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO tbl_user (email,username, password, nama, telepon, alamat) values (:email, :username, :password, :nama, :telepon, :alamat)';
        $statement = $konek->prepare($insertAccount);

        try {
            //Eksekusi statement db
            $statement->execute([
                ':email' => $email,
                ':username' => $username,
                ':password' => md5($password),
                ':nama' => $nama,
                ':telepon' => $telepon,
                ':alamat' => $alamat
            ]);

            //Beri response
            $response['status'] = true;
            $response['message'] = 'Akun berhasil didaftar';
            $response['data'] = [
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'telepon' => $telepon,
                'alamat' => $alamat
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print JSON
    echo $json;
}
