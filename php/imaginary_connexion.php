<?php
session_start();  

require '_header.php';

 if(isset($_POST['valider-connexion'])){

      $mailconnect = htmlspecialchars($_POST['mailconnect']);
    

      if (!empty($mailconnect) AND !empty($_POST['passwordconnect'])){
            
           $userconnect = $DB->count('SELECT * FROM inscriptions WHERE mail =:mail', array('mail' => $mailconnect));

            if($userconnect == 1){
                   
               $result = $DB->PDO('SELECT * FROM inscriptions WHERE mail =:mail', array('mail' => $mailconnect));

                $samepassword = password_verify($_POST['passwordconnect'], $result['password']);

                    if($samepassword){
                          $_SESSION['id'] = $result['id'];
                          $_SESSION['nom'] = $result['nom'];
                          $_SESSION['prenom'] = $result['prenom'];
                          $_SESSION['mail'] = $result['mail'];
                          $_SESSION['compte'] = $result['compte'];
                         header("Location:imaginary_profil.php?id=".$_SESSION['id']);
                         exit();
                         
                    }else{
                         $error = 'Echec.';
                    }
 
            }else{
                $error ='Echec.';
            }
      }
      else{
           $error = 'Tout les champs doivent être complétés.';
      }
   
}  
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet"> 

    <title>Connexion</title>
</head>
     <body>
    
         <header class="header-connexion">
              <h1 class="imaginary-connexion">Imaginary</h1>
                 <?php if(isset($error)){echo $error;} ?>
         </header>
       

           <section>
                 <form action="" method="POST" class="block-connexion" >

                      <label class="label-connexion">connexion</label>
                     <input placeholder="mail" class="mail-connexion" type="text" name="mailconnect">
                     <input placeholder="password" class="password-connexion" type="password" name="passwordconnect">

                      <input class="bouton-connexion" type="submit" name="valider-connexion" value="Connexion">
                 </form>
           </section>

         <footer><?php include("imaginary_footer.php") ?></footer>
    </body>
</html>