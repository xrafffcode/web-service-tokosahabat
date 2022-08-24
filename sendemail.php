<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    //Mengaktifkan SMTP debugging
    // 0 = off (digunakan untuk production)
    // 1 = pesan client
    // 2 = pesan client dan server
    $mail->SMTPDebug = 2;
    //HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //hostname dari mail server
    $mail->Host = 'smtp.gmail.com';
    // gunakan
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // jika jaringan Anda tidak mendukung SMTP melalui IPv6
    //Atur SMTP port - 587 untuk dikonfirmasi TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set sistem enkripsi untuk menggunakan - ssl (deprecated) atau tls
    $mail->SMTPSecure = 'tls';
    //SMTP authentication
    $mail->SMTPAuth = true;
    //Username yang digunakan untuk SMTP authentication - gunakan email gmail
    $mail->Username = "tokosahabatnew@gmail.com";
    //Password yang digunakan untuk SMTP authentication
    $mail->Password = "tnrhdwtstlblajyu";


    //Recipients
    $mail->setFrom('tokosahabatnew@gmail.com', 'Toko Sahabat');
    $mail->addAddress('Atya_4242@yahoo.com', 'tokosahabat');     // Add a recipient


    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pesanan Baru Toko Sahabat';
    $mail->Body    = '<h1>Halo, Admin.</h1> <p>Ada pesanan baru silahkan konfirmasi pada aplikasi </p> ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
