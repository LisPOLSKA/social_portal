<?php
if(isset($_COOKIE['zalog'])){
    header('Location:index.php');
    exit();
}
if(isset($_POST['login'])){
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $wal = true;
    
    //walidacja login
    if(ctype_alnum($login)==false){
        $wal = false;
        $_SESSION['e_login']='Login musi się składać z liter i cyfr bez polskich znaków';
    }
    if($login==""){
        $wal = false;
        $_SESSION['e_login']='Podaj login';
    }

    //walidacja hasło
    if($pass==""){
        $wal = false;
        $_SESSION['e_pass']='Podaj hasło';
    }

    //zapytanie do bazy danych
    if($wal==true){

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else{
                $rezultat = $polaczenie->query("SELECT * FROM user WHERE login='$login'");

                if(!$rezultat)throw new Exception($polaczenie->error);

                $ile_odp = $rezultat->num_rows;

                if($ile_odp==0){
                    $wal = false;
                    $_SESSION['e_login']='Nieprawidłowy login';
                }

                //czy walidacja udana
                    if($wal==true){
                        $wiersz = $rezultat->fetch_assoc();
                        if(password_verify($pass, $wiersz['password'])){
                            setcookie('id',$wiersz['id'],time()+3600*24*30);
                            setcookie('login',$wiersz['login'],time()+3600*24*30);
                            setcookie('email',$wiersz['email'],time()+3600*24*30);
                            setcookie('reg_date',$wiersz['reg_date'],time()+3600*24*30);
                            setcookie('czwxy',$wiersz['rand'],time()+3600*24*30);
                            setcookie('zalog','TRUE',time()+3600*24*30);
                            header('Location:index.php');
                        }
                        else{
                            $wal = false;
                            $_SESSION['e_pass']='Nieprawidłowe hasło';
                        }
                    }
            }
        }
        catch(Exception $e) { 
            $_SESSION['blade'] = '<span style="color:red;" id="blade">Błąd Serwera! Przepraszamy</span>';
            //echo('Informacja developerska:'.$e);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body {
            display: flex;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .form-login {
            margin: 0 auto;
            max-width: 400px;
            background-color: #0dcaf0;
            padding: 15px;
            border-radius: 5px;
        }
        input {
            margin: 5px 0;
        }
        .error {
            color:red;
        }
        #blade{
            font-size: xx-large;
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="" method="post" class="text-center form-login">
                    <h2>Logowanie</h2>
                    <?php
                        if(isset($_SESSION['blade'])){
                            echo('<div class="error">'.$_SESSION['blade'].'</div>');
                            unset($_SESSION['blade']);
                        }
                    ?>
                    <div class="form-group">
                        <input type="text" name="login" id="login" value="" class="form-control" placeholder="Login" required>
                        <?php
                        if(isset($_SESSION['e_login'])){
                            echo('<div class="error">'.$_SESSION['e_login'].'</div>');
                            unset($_SESSION['e_login']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" id="pass" value="" class="form-control" placeholder="Hasło" required>
                        <?php
                        if(isset($_SESSION['e_pass'])){
                            echo('<div class="error">'.$_SESSION['e_pass'].'</div>');
                            unset($_SESSION['e_pass']);
                        }
                        ?>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" value="Potwierdź" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>