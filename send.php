<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
// Переменные, которые отправляет пользователь
$organization = $_POST['organization'];
$fullName = $_POST['full-name'];
$phoneNumber = $_POST['phone-number'];
$email = $_POST['e-mail'];
$comment = $_POST['comment'];

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $msg = "ok";
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";                                          
    $mail->SMTPAuth   = true;
    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера GMAIL
    $mail->Username   = 'ecovtormasend'; // Логин на почте
    $mail->Password   = 'eco364732'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('ecovtormasend@gmail.com', 'ЭКО-Вторма'); // Адрес самой почты и имя отправителя
    // Получатель письма
    $mail->addAddress('trunovvitaly@gmail.com');  
    // $mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен
    // Прикрипление файлов к письму
if (!empty($_FILES['myfile']['name'][0])) {
    for ($ct = 0; $ct < count($_FILES['myfile']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['myfile']['name'][$ct]));
        $filename = $_FILES['myfile']['name'][$ct];
        if (move_uploaded_file($_FILES['myfile']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Неудалось прикрепить файл ' . $uploadfile;
        }
    }   
}
        // -----------------------
        // Само письмо
        // -----------------------
        $mail->isHTML(true);
    
        $mail->Subject = 'Новая заявка на сайте!';
        $mail->Body    = "<b>Наименование организации:</b> $organization<br><br>
        <b>ФИО:</b> $fullName<br><br>
        <b>Телефон:</b> $phoneNumber<br><br>
        <b>E-mail:</b> $email<br><br>
        <b>Комментарий:</b><br>$comment<br><br>";
// Проверяем отравленность сообщения
if ($mail->send()) {
    echo "$msg";
} else {
echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
}
} catch (Exception $e) {
    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}