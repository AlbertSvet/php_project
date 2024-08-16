<?php
// для того чтобы из формы данные попадали в файл с логикой отрпавки письма  у самой формы мы должны указать
// метод POST и action="путь до файла с логикой" и кнопку с типом submit
// но такой способ не подходит так как если перезагружать страницу то будет происходить отправка письма. 
// Поэтому нужно использовать AJAX отрпавку, логика прописывается в js файле, данные отправляются на файл mailer.php 
// а уже из mailer.php отправляются на почту
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alber.svetlov@yandex.ru';                     //SMTP username
    $mail->Password   = 'mufehlmdluppujmd';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('alber.svetlov@yandex.ru', 'Mailer'); // от кого 
    $mail->addAddress('albert.svetlov.1993@mail.ru'); // кому

    //Content
    $mail->isHTML(true);   
    $mail->CharSet = 'UTF-8'; // Устанавливаем кодировку UTF-8                               //Set email format to HTML
    $mail->Subject = 'Новое сообщение';
    $mail->Body    = "<h1>Новое сообщение</h1>
    <p><strong>Имя:</strong> {$_POST['name']}</p>
    <p><strong>Email:</strong> {$_POST['email']}</p>
    <p><strong>Сообщение:</strong><br>{$_POST['message']}</p>";


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}