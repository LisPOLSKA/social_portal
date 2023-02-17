<?php
session_start();
if(!isset($_SESSION['logow'])){
    header('Location:admin.php');
}
else{

}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie artykułu</title>
    <link rel="stylesheet" href="css/cssad.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container my-5">
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
                if($rezultat = $polaczenie->query(sprintf("SELECT * FROM art_sprawdz"))){
                    $l_od = $rezultat->num_rows;
                    while($row = mysqli_fetch_array($rezultat)){
                        $id = $row['id'];
                        $nag = $row['nag'];
                        $zaw = $row['zaw'];
                        $aut = $row['aut'];
                        $id_user = $row['id_user'];
                        $kat = $row['kat-doc'];
                        echo('<section class="row my-2" id="'.$id.'">
                        <article id="">
                        <div class="card text-center bg-info border-dark">
                        <div class="card-header h2">'.$nag.'
                        </div>
                        <div class="card-body">
                        <div class="card-text">'.$zaw.'
                        </div>
                        </div>
                        <div class="card-footer">Autor '.$aut.'<br>Kategoria docelowa '.$kat.'
                        <form action="dodane.php" method="POST">
                            <input type="submit" name="id" value="'.$id.'"><br>
                            <input type="text" name="nag" value="'.$nag.'" ><br>
                            <input type="text" name="kat" value="'.$kat.'" ><br>
                            <input type="text" name="aut" value="'.$aut.'" ><br>
                            <input type="text" name="sex" value="'.$id_user.'" ><br>
                        </form>
                        </div>
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
                //echo '<br/>Informacja developerska; '.$e;
            }
            ?>
    </div>
</body>
</html>