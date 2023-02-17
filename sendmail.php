<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    if(!isset($_SESSION['mail'])){
        header('Location:dane.php');
        exit();
    }
    else 
    {
        try
        {
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = 's1.ct8.pl';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;

            $mail->Username = 'no-reply@lisko.ct8.pl';
            $mail->Password = 'Tajne1287';

            $mail->CharSet = 'UTF-8';
            $mail->setFrom('no-reply@lisekpl.ct8.pl', $_POST['name'].'z formularza kontaktowego');
            $mail->addAddress('lisko@lisko.ct8.pl');
            $mail->addReplyTo($_POST['email'], $_POST['name']);

            $mail->isHTML(true);
            $mail->Subject = 'Wiadomość z formularza kontaktowego na temat '.$_POST['tar'].' <'.$_POST['email'].'>';
            $mail->Body = $_POST['mess'];

            $mail->send();

        }
        catch(Exception $e)
        {
            echo "Błąd wysłania maila: {$mail->ErrorInfo}";
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail został wysłany</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="dane">
        <div>
            Dziękujemy za kontakt z nami!<br>
            W razie Problemów proszę kontaktowac się na adres: lisko@lisko.ct8.pl
        </div>
        <a href="index.php">
            <button class="btn2" id="btn2">
                Wróć do strony głównej
            </button>
        </a>
    </div>
</body>
</html>