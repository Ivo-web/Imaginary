<?php
require '_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/imaginary.css">
    <title>Imaginary store</title>
</head>

     <body id="imaginary-store-background">

 <header><?php include("imaginary_header.php"); ?></header>

  

<?php $products = $DB->query('SELECT * FROM products'); ?>

<?php foreach ($products as $product): ?>

    <section class="block-product">
         <div class="product">

             <p class="product-id"><?= $product->id;?></p>


             <p class="product_name"><?= $product->name; ?></p>
             <img src="../image/<?= $product->id;?>.png" class="image_product" alt="">
             <p class="product-price"><?= number_format($product->price ,2,',',' ');?>$</p>
             <a href="addpanier.php?id=<?= $product->id?>" class="acheter">Acheter</a>
       </div>
    </section> 

<?php endforeach ?>
  
<?php include("imaginary_footer.php");?>

     <script src="../javascript/imaginary.js"></script>
</body>
</html>