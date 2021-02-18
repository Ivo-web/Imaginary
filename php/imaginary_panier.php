<?php
session_start();

 include("_header.php");




?>

<?= $_SESSION['id']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">
    <title>Panier</title>
</head>
   <body>
        <header>
            <?php include("imaginary_header.php"); ?>
       </header>

<?php  ?>
<?php
   $ids = array_keys($_SESSION['panier']);
   if(empty($ids)){
       $products = array();
   }else{
    $products = $DB->query('SELECT * FROM products WHERE id IN ('.implode(',',$ids).')');
   }
   ?>  

         <section class="section-panier">
              <a href="imaginary_store.php" id="back-to-store">Back to the Store</a>
                 <div class="panier">
                  <p>Panier <?= $panier->count(); ?></p>
                  <p>PRIX TOTAL <?= number_format($panier->total(),2,',',' '); ?>$</p>
                  <p>TOTAL avec TVA <?= number_format($panier->total() * 1.196,2,',',' '); ?>$</p>
                </div> 
         </section>

                           

   <?php
       foreach($products as $product):
     ?>
        <section class="section-products">
                  <div class="product">
                         <p class="product_name"><?= $product->name; ?></p>
                         <img src="../image/<?= $product->id;?>.png" class="image_product" alt="">
                        <p><?= number_format($product->price ,2,',',' ');?>$</p>
                        <p class="TVA">Prix avec TVA <?= number_format($product->price *1.196,2,',',' ');?>$</p>
                        <p class="quantite">Quantité <?= $_SESSION['panier'][$product->id]; ?></p>
                       <a href="imaginary_panier.php?delPanier=<?= $product->id ?>" class="delet-product">❌</a>
                    </div>
              </section>
                       
                       <?php 

                         $testing = $buy->transaction();                      
  
                       $test  = $buy->alreadyBought($_SESSION['panier'][$product->id], $product->id);

                        if($test)
                        { 
                          $error = "Vous ne pouvez pas posséder plus de ".$product->name;;
                        }
                        else{
                                   $verifyQuantity = $buy->maxQuantity($_SESSION['panier'][$product->id], $product->id);
                                  if($verifyQuantity)
                                  { 
                                           $achats = $buy->buy("INSERT INTO collection(name, product_id, user_id, quantity, limit_quantity)
                                              VALUES(?,?,?,?,?)", array($product->name, $product->id, $_SESSION['id'],$_SESSION['panier'][$product->id], $product->authorized_quantity), $product->id);

                                             
                                  }else{ 
                                        $error = "Vous ne pouvez pas posséder plus de ". $product->name;
                                        }  
                            }
                            ?>                      
<?php endforeach; ?>
                   
                    <section>
                           <article class="buying-error">
                              <p><?php if(isset($error)){ echo $error;} ?></p>
                           </article>
                     
                         <form id="form-panier" action="imaginary_panier.php" method="post">
                             <label id="label-forme-panier">Entrez votre mot de passe</br> pour finaliser votre achat</label>
                             <input type="password" name="password" id="panier-password">
                             <input type="submit" name="submit" id="panier-submit">
                         </form>
                    </section>
            
             
                <footer>
                      <?php include("imaginary_footer.php"); ?>
               </footer>
       </body>
</html>