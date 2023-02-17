<?php
session_start();
if(!isset($_SESSION['udana_reg'])){
    header('Location:index.php');
    exit();
}
else{
    unset($_SESSION['udana_reg']);
}
//usuwanie niepotrzebnych zmiennych
if(isset($_SESSION['fr_login']))unset($_SESSION['fr_login']);
if(isset($_SESSION['fr_email']))unset($_SESSION['fr_email']);
if(isset($_SESSION['fr_pass1']))unset($_SESSION['fr_pass1']);
if(isset($_SESSION['fr_pass2']))unset($_SESSION['fr_pass2']);
if(isset($_SESSION['fr_check']))unset($_SESSION['fr_check']);

if(isset($_SESSION['e_login']))unset($_SESSION['e_login']);
if(isset($_SESSION['e_email']))unset($_SESSION['e_email']);
if(isset($_SESSION['e_pass']))unset($_SESSION['e_pass']);
if(isset($_SESSION['e_check']))unset($_SESSION['e_check']);

if(isset($_SESSION['e_blade']))unset($_SESSION['e_blade']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dziękujemy za rejestrację!</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body{
            display: flex;
            align-items: center;
            height: 100vh;
            text-align: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container">
    <div class="text-center justify-content-center">
        <div class="row">
            <div class="h1 col">
            Dziękujemy za rejestrację!
            </div>
        </div>
        <div  class="bt row">
            <div class="col">
                <a type="button" href="index.php" class="btn btn-success btn-lg" style="max-width:400px;">
                    Wróć do strony głównej
                </a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>