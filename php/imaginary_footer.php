

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
</head>
    <body>
       <footer>
              <?php
                 if (isset($_SESSION['id'])){
                ?>
                   <div class="footer-nav">
                      <a href="imaginary_tv.php"><?php if(!isset($tv)){ echo 'TV|';}else{ echo '☻';} ?></a>
                      <a href="imaginary_profil.php?id=<?= $_SESSION['id'];?>"><?php if(!isset($menu)){ echo 'Retour au menu|';}else{ echo '☻';} ?></a>
                      <a href="imaginary_weather.php"><?php if(!isset($meteo)){echo 'Meteo';}else{ echo '☀';} ?></a>
                   </div>
                <?php
                 }
              ?>
              <?php 
                   if(isset($index))
                   {
                ?>
                     <div class="legal">
                     <p>Copyright |<span class="legal-notice">Mentions légales</span> | 2020</p>
                  </div>

                  <?php
                   }
                  ?>
       </footer>
   </body>
</html>