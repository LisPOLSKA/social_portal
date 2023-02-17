<?php
    if(isset($_COOKIE['zalog'])){
        header('Location:index.php');
        exit();
    }
    session_start();
    if(isset($_POST['email']))
    {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        $wal = TRUE;

        //walidacja login
        if(strlen($login) < 3||strlen($login) > 20){
            $wal = false;
            $_SESSION['e_login']='Login musi mieć od 3 do 20 znaków';
        }
        if(ctype_alnum($login)==false){
            $wal = false;
            $_SESSION['e_login']='Login musi się składać z liter i cyfr bez polskich znaków';
        }
        if($login==""){
            $wal = false;
            $_SESSION['e_login']='Podaj login';
        }

        //walidacja email
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($emailB,FILTER_VALIDATE_EMAIL)==false||$emailB!=$email){
            $wal = false;
            $_SESSION['e_email']='Podaj poprawny adres email';
        }
        if($email==""){
            $wal = false;
            $_SESSION['e_email']='Podaj adres email';
        }

        //walidacja password
        if(strlen($pass1)<5||strlen($pass1)>50){
            $wal = false;
            $_SESSION['e_pass']='Hasło musi mieć od 5 do 50 znaków';
        }
        if($pass1!=$pass2){
            $wal = false;
            $_SESSION['e_pass']='Podane hasła nie są identyczne';
        }
        if($pass1 == ""){
            $wal = false;
            $_SESSION['e_pass']='Podaj hasło';
        }

        //hashowanie hasła
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

        //sprawdzanie checkbox
        if(!isset($_POST['check'])){
            $wal = false;
            $_SESSION['e_check']='Zakceptuj regulamin aby kontynuować';
        }

        //zapamiętanie wprowadzonych danych
            $_SESSION['fr_login']=$login;
            $_SESSION['fr_email']=$email;
            $_SESSION['fr_pass1']=$pass1;
            $_SESSION['fr_pass2']=$pass2;
            if(isset($_POST['check'])) $_SESSION['fr_check']=true;

        //update do bazy danych

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try{
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else{
                //Czy email istnieje
                $rezultat = $polaczenie->query("SELECT id FROM user WHERE email='$email'");

                if(!$rezultat)throw new Exception($polaczenie->error);

                $ile_mail = $rezultat->num_rows;
                if($ile_mail>0){
                    $wal = false;
                    $_SESSION['e_email']='Istnieje już konto przypisane do tego maila';
                }

                //Czy login istnieje
                $rezultat = $polaczenie->query("SELECT id FROM user WHERE login='$login'");

                if(!$rezultat)throw new Exception($polaczenie->error);

                $ile_login = $rezultat->num_rows;
                if($ile_login>0){
                    $wal = false;
                    $_SESSION['e_login']='Istnieje użytkownik o takim loginie. Wybierz inny';
                }
                
                //Czy udana walidacja
                if($wal==true){
                    $rand = substr(sha1(time()), 0, 20);
                    if($polaczenie->query("INSERT INTO user VALUES(NULL, '$login', '$email', '$pass_hash', current_timestamp(), '$rand')")){
                        $_SESSION['udana_reg']=true;
                        header('Location:witamy.php');
                    }
                    else{
                        throw new Exception($polaczenie->error);
                    }
                }


                $polaczenie->close();
            }
        }
        catch(Exception $e) { 
            $_SESSION['blade'] = '<span style="color:red;" id="blade">Błąd Serwera! Przepraszamy</span>';
           // echo('Informacja developerska:'.$e);
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body{
            display: flex;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .form-singup{
            margin: 0 auto;
            max-width: 400px;
            background-color: #0dcaf0;
            padding: 15px;
            border-radius: 5px;
        }
        .form-singup h2{
            text-align: center;
        }
        input{
            margin: 5px 0;
        }
        input#check{
            scale: 1.5;
        }
        .error {
            color:red;
        }
        #blade{
            font-size: 50px;
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container">
            <?php
            if(isset($_SESSION['blade'])){
                echo($_SESSION['blade']);
                unset($_SESSION['blade']);
            }
            ?>
    <form action="" class="form-singup text-center" method="POST">
        <h2>Rejestracja</h2>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <input type="text" name="login" id="login" value="<?php
                        if(isset($_SESSION['fr_login'])){
                            echo($_SESSION['fr_login']);
                            unset($_SESSION['fr_login']);
                        }
                    ?>" class="form-control" placeholder="Nick/Login" required>
                    <?php
                    if(isset($_SESSION['e_login'])){
                        echo('<div class="error">'.$_SESSION['e_login'].'</div>');
                        unset($_SESSION['e_login']);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" value="<?php
                        if(isset($_SESSION['fr_email'])){
                            echo($_SESSION['fr_email']);
                            unset($_SESSION['fr_email']);
                        }
                    ?>" class="form-control" placeholder="E-Mail" required>
                <?php
                    if(isset($_SESSION['e_email'])){
                        echo('<div class="error">'.$_SESSION['e_email'].'</div>');
                        unset($_SESSION['e_email']);
                    }
                ?>
        </div>
        <div class="form-group">
            <input type="password" name="pass1" id="pass1" value="<?php
                        if(isset($_SESSION['fr_pass1'])){
                            echo($_SESSION['fr_pass1']);
                            unset($_SESSION['fr_pass1']);
                        }
                    ?>" class="form-control" placeholder="Hasło" required>
                <?php
                    if(isset($_SESSION['e_pass'])){
                        echo('<div class="error">'.$_SESSION['e_pass'].'</div>');
                        unset($_SESSION['e_pass']);
                    }
                ?>
        </div>
        <div class="form-group">
            <input type="password" name="pass2" id="pass2" value="<?php
                        if(isset($_SESSION['fr_pass2'])){
                            echo($_SESSION['fr_pass2']);
                            unset($_SESSION['fr_pass2']);
                        }
                    ?>" class="form-control" placeholder="Powtórz Hasło" required>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="check" id="check"<?php
                    if(isset($_SESSION['fr_check'])){
                        echo("checked");
                        unset($_SESSION['fr_check']);
                    }
                ?> required>
                Akceptuję <a target="_blank" href="regulamin.html">Regulamin</a>
            </label>
                <?php
                    if(isset($_SESSION['e_check'])){
                        echo('<div class="error">'.$_SESSION['e_check'].'</div>');
                        unset($_SESSION['e_check']);
                    }
                ?>
        </div>
        <div class="d-grid gap-2">
            <input type="submit" value="Potwierdź" class="btn btn-success">
        </div>
    </form>
    </div>
</body>
</html>