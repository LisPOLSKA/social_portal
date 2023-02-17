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
                   else{
                    if(isset($_POST['kom'])){
                        $kom = $_POST['kom'];
                        $idart = $_POST['idart'];
                        $loginuzy = $_COOKIE['login'];
                        $art1 = $_POST['art'];
                        $art2 = "art_".$art1;
    
    
                        //walidacja
                        $wali = true;
                        if($kom==""){
                            $wali == false;
                            if($art1=="geo"){
                                header('Location:wyr.php');
                            }
                            if($art1=="akcja"){
                                header('Location:geo.php');
                            }
                            if($art1=="cen"){
                                header('Location:censor.php');
                            }
                        }
                        
                        if($wali==true){
                            require_once "connect.php";
                                mysqli_report(MYSQLI_REPORT_STRICT);
                                try{
                                    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                                    if($polaczenie->connect_errno!=0){
                                        throw new Exception(mysqli_connect_errno());
                                    }
                                    else{
                                        if($art1=="geo"){
                                        if($polaczenie->query("INSERT INTO kom VALUE(NULL, '$loginuzy', '$idart', '$kom', CURRENT_TIMESTAMP())")){
                                            header('Location:wyr.php');
                                        }
                                        else {
                                            throw new Exception($polaczenie->error);
                                        }
                                        }
                                        if($art1=="akcja"){
                                            if($polaczenie->query("INSERT INTO kom_geo VALUE(NULL, '$loginuzy', '$idart', '$kom', CURRENT_TIMESTAMP())")){
                                                header('Location:geo.php');
                                            }
                                            else {
                                                throw new Exception($polaczenie->error);
                                            }
                                        }
                                        if($art1=="cen"){
                                            if($polaczenie->query("INSERT INTO kom_censor VALUE(NULL, '$loginuzy', '$idart', '$kom', CURRENT_TIMESTAMP())")){
                                                header('Location:censor.php');
                                            }
                                            else {
                                                throw new Exception($polaczenie->error);
                                            }
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