<?php
if(isset($_GET['data'])){
    $data = $_GET['data'];
}
if(isset($_GET['art'])){
    $artt = $_GET['art'];
    $tn;
    $kn;
    $pn;
    if($artt=="geo"){
        $tn="art_geo";
        $kn="kom";
        $pn="wyr";
    }
    if($artt=="akcja"){
        $tn="art_akcja";
        $kn="kom_geo";
        $pn="geo";
    }
    if($artt=="censor"){
        $tn="art_censor";
        $kn="kom_censor";
        $pn="censor";
    }
}
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
    <title>Lisko.ct8.pl</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <!--<script src="js/main.js"></script>-->
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
            <div class="row">
                <div class="row">
                    <div class="col">
                        <div class="sexownie mt-2">
                            <a href="<?php
                        echo($pn.'.php#'.$data)
                        ?>" class="btn btn-primary">Wróć</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_STRICT);
            try{
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else{
                if($rezultat = $polaczenie->query(sprintf("SELECT * FROM $tn WHERE id='$data' ORDER BY add_time DESC"))){
                    $l_od = $rezultat->num_rows;
                    $l_odp;
                    while($row = mysqli_fetch_array($rezultat)){
                        $id = $row['id'];
                        $nag = $row['nag'];
                        $zaw = $row['zaw'];
                        $aut = $row['aut'];
                        if($rezu = $polaczenie->query(sprintf("SELECT id, aut, zaw FROM $kn WHERE id_art='$id' ORDER BY add_date DESC"))){
                            $l_odp = $rezu->num_rows;
                        }
                        else{
                            throw new Exception($polaczenie->error);
                        }
                        $add_time = $row['add_time'];
                        echo('<section class="row" id="'.$id.'">
                        <article id="">
                        <div class="card text-center bg-secondary border-dark">
                        <div class="card-header h2">'.$nag.'
                        </div>
                        <div class="card-body">
                        <div class="card-text">'.$zaw.'<br>
                        Autor: '.$aut.'<br>
                        Data dodania: '.$add_time.'
                        </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">');
                        if(isset($_COOKIE['zalog'])){
                        echo('<form action="sex1.php" method="post" class="text-center">
                                <div class="row mb-3">
                        
                                    <div class="col-xl-10 col-sm-9 col-md" id="sex1">
                                        <textarea class="form-control" name="kom" id="kom" required placeholder="Napisz komentarz" aria-label="Napisz komentarz" rows="1"></textarea>
                                    </div>
                                    <div class="col-xl-2 col-sm-3" id="sex2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success" type="submit" id="button-addon2" style="padding-right: 6px;padding-left: 6px;">Dodaj komentarz</button>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <input type="text" readonly name="idart" id="idart" value="'.$id.'">
                                        <input type="text" readonly name="art" id="art" value="'.$artt.'">
                                    </div>
                                </div>
                            </form>');
                        }
                        echo('
                            </div>
                            <div class="row">
                            <div class="col">');
                            if($l_odp>0){
                            while($row2 = mysqli_fetch_array($rezu)){
                                $id_kom = $row2['id'];
                                $aut_art = $row2['aut'];
                                $zaw_kom = $row2['zaw'];
                                echo('<div class="row sex" style="border:1px solid black; margin:10px 0; border-radius:5px;">
                                <div class="aut row"><div class="col" style="font-size:20px;text-align:left;">'.$aut_art.'</div></div><br>
                                <div class="zaw row"><div class="col" style="font-size:30px;text-align:left;">'.$zaw_kom.'</div></div>
                                </div>');
                            }
                            }
                            else{
                                echo('
                                <div class="row sex" style="border:1px solid black; margin:10px 0; border-radius:5px;">
                                <div class="zaw row"><div class="col" style="font-size:30px;">Brak Komentarzy</div></div>
                                </div>');
                            }
                        echo('</div></div>');
                        echo('
                        </div>
                        </article>
                        </section>');
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
                echo '<br/>Informacja developerska; '.$e;
            }
            ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="s"></div>


    <script type="text/javascript" src="js/main.min.js"></script>
    <script src="js/js.bunde.min.js"></script>
</body>

</html>