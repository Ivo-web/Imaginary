<?php
session_start();

$tv = 'tv';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">
    <title>TV</title>
</head>
      <body>
    
         <header>
             <h1 id="header-tv">Imaginary tv</h1>
        </header>
  
             <section id="section-tv">
                <div id="TV" class="chain-tv">
                    <p class="enregistrement">REC <span id="time" class="time-color"></span></p>
                 </div>
                  <a href="" id="bouton-zap">Zap</a>
              </section>

        <div id="block-time">
            <input type="submit" value="Arrêtez le temps au bon moment sinon..." id="submit-time" class="press-time">
          </div>
             
           <footer>
                <?php include("imaginary_footer.php") ?>
           </footer>
       <script src="../javascript/imaginary_tv.js"></script>
    </body>
</html>