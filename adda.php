<?php
 if(isset($_COOKIE['zalog'])){
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else{
            $id = $_COOKIE['id'];
            $login = $_COOKIE['login'];
            if($rezultat = $polaczenie->query(sprintf("SELECT rand FROM user WHERE id='$id' AND login='$login'"))){
                $ile_odp = $rezultat->num_rows;
                while($row=mysqli_fetch_array($rezultat)){
                if($ile_odp>0){
                    if($_COOKIE['czwxy'] != $row['rand']){
                        //usuń ciasteczka
                        echo("pedał");
                        if(isset($_COOKIE['id'])){
                            setcookie('id','',time());
                        }
                        if(isset($_COOKIE['login'])){
                            setcookie('login','',time());
                        }
                        if(isset($_COOKIE['email'])){
                            setcookie('email','',time());
                        }
                        if(isset($_COOKIE['reg_date'])){
                            setcookie('reg_date','',time());
                        }
                        if(isset($_COOKIE['czwxy'])){
                            setcookie('czwxy','',time());
                        }
                        if(isset($_COOKIE['zalog'])){
                            setcookie('zalog','',time());
                        }
                        header('Location:adda.php');
                    }
                    else{
                        if(isset($_POST['kat'])){
                            $kat = $_POST['kat'];
                            $nag = $_POST['nag'];
                            $zaw = $_POST['zaw'];

                            $wal = true;
                            //walidacja nagłówku
                            if($nag==""){
                                $wal = false;
                                $_SESSION['e_nag'] = "Podaj nagłówek artykułu";
                            }
                            
                            //walidacja artykułu
                            if($zaw==""){
                                $wal = false;
                                $_SESSION['e_zaw'] = "Podaj treść artykułu";
                            }

                            //walidacja checkbox
                            if(!isset($_POST['check'])){
                                $wal = false;
                                $_SESSION['e_check'] = "Zaakceptuj regulamin";
                            }
                            //czy walidacja udana
                            if($wal==true){
                                require_once "connect.php";
                                mysqli_report(MYSQLI_REPORT_STRICT);
                                try{
                                    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                                    if($polaczenie->connect_errno!=0){
                                        throw new Exception(mysqli_connect_errno());
                                    }
                                    else{
                                        if($polaczenie->query("INSERT INTO art_sprawdz VALUE(NULL, '$id', '$login', '$kat', '$zaw','$nag')")){
                                            header('Location:uddoda.html');
                                        }
                                        else {
                                            throw new Exception($polaczenie->error);
                                        }
                                    }
                                }
                                catch(Exception $e){
                                    $_SESSION['blade'] = '<span style="color:red;" id="blade">Błąd Serwera! Przepraszamy</span>';
                                    //echo('Informacja developerska:'.$e);
                                }
                            }
                        }
                    }
                }
                }
                if($ile_odp==0){
                    //usuń ciasteczka
                    if(isset($_COOKIE['id'])){
                        setcookie('id','',time());
                    }
                    if(isset($_COOKIE['login'])){
                        setcookie('login','',time());
                    }
                    if(isset($_COOKIE['email'])){
                        setcookie('email','',time());
                    }
                    if(isset($_COOKIE['reg_date'])){
                        setcookie('reg_date','',time());
                    }
                    if(isset($_COOKIE['czwxy'])){
                        setcookie('czwxy','',time());
                    }
                    if(isset($_COOKIE['zalog'])){
                        setcookie('zalog','',time());
                    }
                    header('Location:adda.php');
                }
            }
            else{
                throw new Exception($polaczenie->error);
            }
            $polaczenie->close();
        }
    }
    catch(Exception $e){
        $_SESSION['blade']='<span style="color:red" id="blade">Błąd serwera! Przepraszamy</span>';
        //echo '<br/>Informacja developerska; '.$e;
    }
 }
 else{
    header('Location:index.php');
 }
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <!--<script src="js/main.js"></script>-->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <style>
    .form-login {
        margin: 0 auto;
        max-width: 800px;
        background-color: #524B4B;
        padding: 15px;
        border-radius: 5px;
    }

    .form-group {
        margin: 5px 0;
    }

    .error {
        color: red;
        font-size: 20px;
    }

    input#check {
        scale: 1.5;
    }

    #blade {
        font-size: xx-large;
    }
    </style>
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <a class="navbar-brand" href="index.php" style="margin-left:10px;"><img class="d-inline-block navbar-logo"
                    src="img/fox1.png" alt="Logo przedtsawiające zestaw słuchawkowy"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu"
                aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav" style="align-items:center">
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="wyr.php">Lelum Polelum</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="geo.php">AI</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="censor.php">Not Censored</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="photo.php">Zdjęcia</a>
                    </li>
                </ul>
                <ul class="navbar-nav" id="za-ni" style="align-items:center;margin-left:auto;margin-right:5px;">
                    <!-- Dla niezalogowanych -->
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="logow.php"><img src="img/person-fill-check.svg"
                                alt="Ikonka logowania" style="width:25px;">Logowanie</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="regi.php"><img src="img/person-fill-add.svg"
                                alt="Ikonka rejestracji" style="width:25px;"> Rejestracja</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="row mx-0 fs-4">
        <div class="container col-sm-12">
            <section class="row">
                <div class="card text-center bg-secondary border-dark">
                    <div class="card-header h2">
                        Dodaj Artykuł
                        <?php
                        if(isset($_SESSION['blade'])){
                            echo('<div class="error">'.$_SESSION['blade'].'</div>');
                            unset($_SESSION['blade']);
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="text-center form-login">
                            <div class="form-group">
                                <label for="kat">Wybierz kategorię artykułu</label>
                                <select name="kat" id="kat" class="form-select text-center">
                                    <option value="art_geo">Lelum Polelum</option>
                                    <option value="art_akcja">AI</option>
                                    <option value="art_censor">Not Censor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nag">Nagłówek Artykułu</label>
                                <input type="text" name="nag" id="nag" class="form-control text-center"
                                    placeholder="Nagłówek Artykułu" required>
                                <?php
                                    if(isset($_SESSION['e_nag'])){
                                        echo('<div class="error">'.$_SESSION['e_nag'].'</div>');
                                        unset($_SESSION['e_nag']);
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="zaw">Treść artykułu</label>
                                <textarea class="form-control" name="zaw" id="zaw"></textarea>
                                <script>
                                CKEDITOR.replace('zaw');
                                </script>
                                <?php
                                    if(isset($_SESSION['e_zaw'])){
                                        echo('<div class="error">'.$_SESSION['e_zaw'].'</div>');
                                        unset($_SESSION['e_zaw']);
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="check" id="check" required>
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
                                <input type="submit" value="Dodaj artykuł" class="btn btn-success mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </main>

    <div id="s"></div>

    <script type="text/javascript" src="js/main.min.js"></script>
    <script src="js/js.bunde.min.js"></script>
</body>

</html>