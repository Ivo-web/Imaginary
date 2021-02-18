<?php
session_start();  


if (isset($_GET['id']) AND $_GET['id'] > 0){

$menu = 'menu';

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet"> 

    <title>Espace membre</title>
</head>

     <body> 
         <header>      
               <?php include("imaginary_header.php"); ?>     
         </header>


         <label for="checkbox-profil" class="label-profil">Menu</label>
         <input  class="checkbox-profil" type="checkbox" id="checkbox-profil">
              
         
                  <ul class="menu-profil">
                      <li><a class="galerie" href="galerie.php" title="Galerie">Galerie ☻</a></li>
                      <li><a class="store" href="imaginary_store.php" title="outique" >Boutique $</a></li>
                      <li><a href="imaginary_weather.php">Météo ☀</a></li>
                      <li><a href="imaginary_tv.php">TV</a></li>
                      <li><a href="index.php">Deconnexion</a></li>
                  </ul>

                 <?php if(isset($_GET['test']))
                 
                 {
                 ?>
                  <p class="offre-10000">Bravo, vous avez reçu 10000$ pour vôtre inscription.</p> 
                     
                <?php
                }
                ?>
        
           
            <section>
               <h4 class="solde">Solde<?php echo $_SESSION['compte'];?>$</h4>
            </section>


          <footer>
               <?php include('imaginary_footer.php'); ?>
          </footer>       
          
        <script type="text/javascript" src="../javascript/imaginary_profil.js"></script>
    </body>
</html>

<?php } ?>

