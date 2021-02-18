<?php
session_start();  

require '_header.php';


if (isset($_POST['valider'])) {
   
     if(!empty($_POST['nom']) 
     AND !empty($_POST['prenom']) 
     AND !empty($_POST['mail']) 
     AND !empty($_POST['password'])
     AND !empty($_POST['password-2']))
     {
            if($_POST['password'] == $_POST['password-2']) {
                $mail = $_POST['mail'];
                   if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                   {
                      $nom = htmlspecialchars($_POST['nom']);
                      $prenom = htmlspecialchars($_POST['prenom']);
              
                            $nomstring = strlen($nom);
                            $prenomstring = strlen($prenom);
                            $mailstring = strlen($mail);
                            $passwordstring = strlen($_POST['password']);
                        

                                              if($nomstring <= 255
                                              AND $prenomstring <= 255
                                              AND $mailstring <= 255
                                               AND $passwordstring <= 255)
                                         {

                                            $verifymail = $DB->count("SELECT * FROM inscriptions WHERE mail=:mail", array('mail' => $mail));
                          
                                          
                                            if($verifymail == 0){


                                              $verifynom = $DB->count("SELECT * FROM inscriptions WHERE nom =:nom", array('nom' => $mail));
                             
                 
                                                 if($verifynom == 0){                                                   
                                                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                                                        $insertinscription = $DB->data_Helper("INSERT INTO inscriptions(nom, prenom, mail, password) VALUES(?,?,?,?)",
                                                        array($nom, $prenom, $mail, $password));
                                                              
                                                          
                                                          $_SESSION['nom'] = $nom;
                                                          $_SESSION['prenom'] = $prenom;
                                                          $_SESSION['mail'] = $mail;
                                                         
                                                          $idexist = $DB->PDO('SELECT id, compte FROM inscriptions WHERE mail =:mail', array('mail' => $mail));
                                                                                                    
                                                             $_SESSION['id'] = $idexist['id'];
                                                             $_SESSION['compte'] = $idexist['compte'];

                                                          header("Location:imaginary_profil.php?test=firstconnect&id=".$_SESSION['id']);
                                                                                                                                                                     
                                                 }else {
                                                     $erreur = "Ce nom de famille existe deja";
                                                 }  

                                            }else{
                                                $erreur = "Cette adresse mail axiste dejà.";
                                            }
                                
                              }else {
                                $erreur = 'Chaque entré ne doit pas contenir plus de 255 caractères';
                              }          

                   }else{
                         $erreur = 'Vous vous êtes trompé quelque part.';
                   }
               
            }else {
                  $erreur = "Vous avez mal rentrées les information demandées";
            }
             
     }else
     $erreur = 'Vous n\'avez pas renseigné tout les champs.';
}
 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">

    <title>S'incrire</title>
</head>
     <body>
    
         <header>
            <?php include("imaginary_header.php"); ?>
             <h1 class="title-inscription">Inscription</h1>
         </header>

         <?php 
         if(isset($erreur)) {
         ?>
            <p id="inscription-error"><?= $erreur; ?></p>
         <?php
         } 
         ?>

           <section>
                 <form action="" method="POST" class="block-inscription" >
                      <label>Entrez votre nom de famille</label>
                     <input type="text" name="nom"  id="inscription-input">

                      <label>Entrez votre prénom</label>
                     <input type="text" name="prenom" id="inscription-input" >

                      <label>Entrez votre mail</label>
                     <input type="text" name="mail" id="inscription-input">

                      <label>Choisir un mot de passe</label>
                     <input type="password" name="password" id="inscription-input">

                       <label>Confirmez votre mot de passe</label>
                     <input type="password" name="password-2" id="inscription-input">

                      <input class="inscription-submit" type="submit" name="valider" value="$">
                      <label>VALIDER ☠</label>
                 </form>
           </section>

        <?php include("imaginary_footer.php") ?>
    </body>
</html>