<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
     integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
     crossorigin="anonymous"/>

    <title>navigation</title>
</head>
<body>
       <header>
            <?php include("imaginary_header.php") ?>
        </header>
          
    <nav>
        <div class="block-bars">
             <h2 class="title-menu">menu</h2>
            <label for="menu-checkbox"><i class="fas fa-bars" id="bars"></i></label>
        </div>  
            
         <input id="menu-checkbox" type="checkbox" class="menu-checkbox">

         <ul class="menu">
             <li><a href="imaginary_connexion.php" id="connexion-link">Connexion</a></li>
             <li><a href="imaginary_inscription.php" id="inscription-link">Inscription</a></li>
             <li><a href="imaginary_admin.php" id="administrator-link">"Adminstrateur"</a></li>
         </ul>
      
        
         <div id="navigation">
                <p>Connexion</p>
                <p>Inscription</p>
                <p>Administrateur</p>
           </div>
         <ul class="symbols-pc">
             <li><a href="imaginary_connexion.php" title="Connexion"><i class="fas fa-power-off" id="connexion-submit"></i></a></li>
             <li><a href="imaginary_inscription.php" title="Inscription"> <i class="fas fa-male" id="inscription-symbol"></i></a></li>
             <li><a href="imaginary_admin.php" title="Administrator"><i class="fas fa-database" id="database-symbol"></i></a></li>
        </ul> 
  
     </nav>
</body>
</html>