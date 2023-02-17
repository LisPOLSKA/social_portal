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
    <title>Lisko.ct8.pl</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <!--<script src="js/main.js"></script>-->
    <style>
    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        list-style-type: none;
    }

    .photo {
        margin: 32px;
        max-width: 300px;
        max-height: 200px;
        transform: scale(1);
        transition: transform 0.3s;
        cursor: pointer;
        border: solid 3px rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 48px 1px rgba(0, 0, 0, 0.5);
    }

    .photo img {
        object-fit: cover;
        height: 100% !important;
        width: 100% !important;
    }

    .photo:hover {
        transform: scale(1.1);
    }

    .modal img.img-popup {
        max-width: 80% !important;
        max-height: 80% !important;
    }

    .modal {
        backdrop-filter: blur(10px);
    }

    .popup_arrow {
        background: none;
        border: none;
        color: #ffffff;
        font-size: 70px;
    }
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
                    <li class="nav-item h5 active">
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
            <section>

                <article id="o-pro">
                    <div class="card text-center bg-secondary border-dark">
                        <div class="card-header h2">
                            Galeria Zdjęć
                        </div>
                        <div class="card-body">
                            <ul class="gallery">
                                <li class="photo"><img src="img/photo/1.png" alt=""></li>
                                <li class="photo"><img src="img/photo/2.png" alt=""></li>
                                <li class="photo"><img src="img/photo/3.png" alt=""></li>
                                <li class="photo"><img src="img/photo/4.png" alt=""></li>
                                <li class="photo"><img src="img/photo/5.png" alt=""></li>
                                <li class="photo"><img src="img/photo/6.png" alt=""></li>
                                <li class="photo"><img src="img/photo/7.png" alt=""></li>
                                <li class="photo"><img src="img/photo/9.jpg" alt=""></li>
                                <li class="photo"><img src="img/photo/10.png" alt=""></li>
                                <li class="photo"><img src="img/photo/11.jpg" alt="" title="Fanart od kolmipilota"></li>
                            </ul>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <div class="modal fade modal-xl" id="dupcia" tabindex="-1" aria-labelledby="dupcia" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:none;border:none;">
                <div class="modal-header" style="border:0;">
                    <button type="button" class="btn-close btn-close-white" style="scale:3;" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center d-flex">
                    <button class="popup_arrow" id="arr_left">
                        << /button>
                            <img src="" alt="" class="img-popup">
                            <button class="popup_arrow" id="arr_right">></button>
                </div>
            </div>
        </div>
    </div>
    <div id="s"></div>
    <script type="text/javascript" src="js/main.min.js"></script>
    <script src="js/js.bunde.min.js"></script>
    <script>
    const PHOTOS = document.querySelectorAll(".photo img");
    const popup_image = document.querySelector(".img-popup");
    const ARROWLEFT = document.getElementById("arr_left");
    const ARROWRIGHT = document.getElementById("arr_right");
    const ln = PHOTOS.length;
    const penis = ["Lisek pod drzewem", "Lis w lesie", "Skin LisekPOLSKA", "LisekPOLSKA z kurczakiem i drugim lisem",
        "LisekPOLSKA z kolmipilotem", "LisekPOLSKA z lisem", "Skin LisekPOLSKA", "Minifugurka Lisa z LEGO",
        "LisekPOLSKA z Oa_mAn", "Fanart od LisekPOLSKA"
    ];
    let imgindex;
    var myModal = new bootstrap.Modal(document.getElementById('dupcia'), {
        keyboard: false
    })

    function right() {
        if (imgindex === PHOTOS.length - 1) {
            imgindex = 0;
        } else {
            imgindex++;
        }
        popup_image.src = PHOTOS[imgindex].src;
    }

    function left() {
        if (imgindex === 0) {
            imgindex = PHOTOS.length - 1;
        } else {
            imgindex--;
        }
        popup_image.src = PHOTOS[imgindex].src;
    }

    PHOTOS.forEach((photo, index) => {
        photo.addEventListener("click", (e) => {
            popup_image.src = e.target.src;
            myModal.show();
            imgindex = index;
        })
    })

    ARROWRIGHT.addEventListener("click", right);

    ARROWLEFT.addEventListener("click", left);

    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight" || e.keyCode === 39) {
            right();
        }
        if (e.key === "ArrowLeft" || e.keyCode === 37) {
            left();
        }
        if (e.key === "Escape" || e.keyCode === 27) {
            myModal.hide();
        }
    })
    </script>
</body>

</html>