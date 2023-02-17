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
                        header('Location:index.php');
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
                    header('Location:index.php');
                }
            }
            else{
                throw new Exception($polaczenie->error);
            }
            $polaczenie->close();
        }
    }
    catch(Exception $e){
        echo '<span style="color:red">Błąd serwera! Przepraszamy</span>';
        //echo '<br/>Informacja developerska; '.$e;
    }
 }
 else{
    //usuń ciasteczka
 }
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Społecznościowy by LisekPOLSKA">
    <title>Lisko.ct8.pl</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <!--<script src="js/main.js"></script>-->
    <style>

    </style>
</head>

<body>

    <header class="sticky-top">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <a class="navbar-brand" href="index.php" style="margin-left:10px;"><img class="d-inline-block navbar-logo"
                    src="img/lisek.png" alt="Logo przedtsawiające zestaw słuchawkowy"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu"
                aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav" style="align-items:center">
                    <li class="nav-item h5">
                        <a class="nav-link text-light" href="wyr.php" title="seksualność">Lelum Polelum</a>
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
            <section class="row" id="opis-str">
                <article id="spis">
                    <div class="card text-center bg-secondary border-dark">
                        <div class="card-header h2">
                            Spis Podstron
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="card mx-auto mt-2 mb-2 col-sm-12" style="max-width: 100%;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item colortable"><a href="wyr.php" class="nav-link">Lelum
                                                Polelum</a></li>
                                        <li class="list-group-item colortable"><a href="geo.php" class="nav-link">AI</a>
                                        </li>
                                        <li class="list-group-item colortable"><a href="censor.php" class="nav-link">Not
                                                Censored</a></li>
                                        <li class="list-group-item colortable"><a href="photo.php"
                                                class="nav-link">Zdjęcia</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article id="o-pro">
                    <div class="card text-center bg-secondary border-dark">
                        <div class="card-header h2">
                            O projekcie
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                Wpadłem na pomysł stworzenia strony ala bloga. Żeby artykuły można było umieścić ale
                                wstawiać je w html czysto w kodzie ale w taki inny fajny sposób poprzez oprogramowanie
                                specjalistyczne, które stworzyłem i mogę wstawiać artykuły i jest fajnie.
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-sm-12 mt-2 mb-2" id="contact">
                    <div class="card text-center bg-secondary border-dark">
                        <div class="card-header h4">
                            Kontakt <span style="color:red;">Na razie nie działa</span>
                        </div>
                        <div class="card-body fs-4">
                            <form method="POST" action="sendmail.php">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="1name">Podaj imię</label>
                                            <input type="text" id="1name" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="1tar">Cel Kontaktu</label>
                                            <select name="tar" id="1tar" class="form-select">
                                                <option value="Zgłoś błąd" class="text-center">Zgłoś błąd</option>
                                                <option value="Kontakt" class="text-center">Kontakt</option>
                                                <option value="Inne" class="text-center">Inne</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="1email">Twój email</label>
                                            <input type="email" name="email" id="1email" class="form-control" required>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="1mess">Wiadomość</label>
                                            <textarea type="text" name="mess" id="1mess" class="form-control"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-check" style="width: auto;">
                                        <input type="checkbox" id="1check" name="check" class="form-check-input"
                                            required>
                                        <label for="1check" class="form-check-label"><a href="regulamin.html"
                                                target="_blank">Akceptuje regulamin</a></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary btn-lg" type="submit">Wyślij formularz</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <div id="s"></div>


    <script type="text/javascript" src="js/main.min.js"></script>
    <script src="js/js.bunde.min.js"></script>
</body>

</html>