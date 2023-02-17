<?php
session_start();

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
        $id = $_POST['id'];
        $haslo = $_POST['password'];
        $sql = "SELECT * FROM admini WHERE id = '$id' AND haslo = '$haslo'";

        if($rezultat = $polaczenie->query(sprintf("SELECT * FROM admini WHERE id = '$id' AND haslo = '$haslo'"))){

            $ilu_user = $rezultat->num_rows;
            if($ilu_user>0)
            {
                echo("zalog");
                $_SESSION['logow'] = true;
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



    

?>