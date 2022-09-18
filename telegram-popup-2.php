<?php

/* https://api.telegram.org/bot5286166688:AAHB2aAfBBohXNBxiFgbraduCRp7E0xaifc/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

// поля из формы
$title = '';
$name = $_POST['user_name'];
$phone = $_POST['user_phone'];
// $email = $_POST['user_email'];
// токен нашего бота из botFather
$token = "5286166688:AAHB2aAfBBohXNBxiFgbraduCRp7E0xaifc";
// $chat_id = "https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXXXX/getUpdates";
$chat_id = "-797179115";
$arr = array(
  'Заказ на звонок! ' => $title,
  'Имя: ' => $name,
  'Телефон: ' => $phone,
  // 'Email: ' => $email
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  header('Location: thank-you.html');
} else {
  echo "Error";
}
?>
