<?php
if(isset($_POST['sex'])){
require_once "connect.php";
try
{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    if($polaczenie->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {
    $kat = $_POST['kat'];
    $nag = $_POST['nag'];
    $aut = $_POST['aut'];
    $id = $_POST['id'];
    $rezultat = $polaczenie->query("SELECT zaw,id FROM art_sprawdz WHERE id='$id'");
    if(!$rezultat)throw new Exception($polaczenie->error);
    $wiersz = $rezultat->fetch_assoc();
    $zaw = $wiersz['zaw'];
    if($polaczenie->query("INSERT INTO $kat VALUES (NULL, '$nag', '$zaw', '$aut', CURRENT_TIMESTAMP)")){
        if($polaczenie->query("DELETE FROM art_sprawdz WHERE id='$id'")){
            header('Location:doda.php');
        }
    }
    else {
        throw new Exception($polaczenie->error);
    }
    $polaczenie->close();
    }
}
catch(Exception $e)
{
echo '<span style="color:red">Błąd serwera! Przepraszamy</span>';
//echo '<br/>Informacja developerska; '.$e;
}
}
?>