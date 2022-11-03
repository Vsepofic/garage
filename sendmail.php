<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

// require_once('phpmailer/PHPMailerAutoload.php');    //..подключается папка, которая отправляет нашу форму по почте
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

// переменные из нашей формы
$name = $_POST['user_name'];
$email = $_POST['user_email'];
$phone = $_POST['user_phone'];
// $file = $_POST['userFile'];
// $sex = $_POST['user_sex'];
// $login = $_POST['user_login'];
// $pass = $_POST['user_pass'];
// $agreement = $_POST['userAgree'];
// $agreement = $_POST['userAgree'];      //* 2 вариант

// настройка почтового ящика
$mail->isSMTP();                                // Настраиваем почту для SMTP
$mail->Host = 'smtp.gmail.com';  				// Основной SMTP сервер
$mail->SMTPAuth = true;                         // Включить аутентификацию SMTP
$mail->Username = 'vitalinashop2010@gmail.com';    // логин от почты с которой будут отправляться письма
$mail->Password = 'edanadom';            // пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                      // Включить шифрование ssl
$mail->Port = 465;                              // TCP порт для подключения / этот порт может отличаться у других провайдеров

$mail->setFrom('vitalinashop2010@gmail.com');      // от кого будет уходить письмо для пользователя
$mail->addAddress('vsepofic@gmail.com');         // Кому будет приходить заявка  ********  ( почта заказчика ) *******
//$mail->addAddress('ellen@example.com');           // Имя не обязательно
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');                   // копии, ответы и т.д.
//$mail->addBCC('bcc@example.com');
// $mail->isHTML(true);                                  // Установить формат электронной почты в HTML

$mail->Subject = 'Форма с тестового сaйта';

$body = '<h2>встречайте супер письмо!</h2>';
$body .= '' . '<strong>' . $name . '</strong>' . ' оставил заявку на оценку проекта ';

// если поле не пустое
if (trim(!empty($_POST['user_name']))) {
  $body .= '<p><strong>Имя: </strong> ' . $name . '</p>';
}

if (trim(!empty($_POST['user_phone']))) {
  $body .= '<p><strong>Телефон: </strong> ' . $phone . '</p>';
}

if (trim(!empty($_POST['user_email']))) {
  $body .= '<p><strong>E-mail: </strong> ' . $email . '</p>';
}

// if (trim(!empty($_POST['userFile']))) {
//   $body .= '<p><strong>Файл: </strong> ' . $file . '</p>';
// }

// // прикрепляем файл
// if (!empty($_FILES['userFile']['tmp_name'])) {
//   // путь загрузки файла
//   $filePath = __DIR__ . "/files/" . $_FILES['userFile']['name'];
//   // грузим файл
//   if (copy($_FILES['userFile']['tmp_name'], $filePath)) {
//     $fileAttach = $filePath;
//     $body .= '<p><strong>Фото в приложении</strong></p>'; 
//     $mail->addAttachment($fileAttach); 
//   }
// }

$mail->Body = $body;

$mail->AltBody = '';

// if(!$mail->send()) {
//     echo 'Error';
// } else {
//     header('location: thank-you.html');
// }

if(!$mail->send()) {
    $message = 'Ошибка';
} else {
    $message = 'Данные отправлены!';
}

$response = ['message' => $message];
header('Content-type: application/json');
echo json_encode($response);

?>
