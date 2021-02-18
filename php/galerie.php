<?php
session_start();

require '_header.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>piece personnelle</title>
</head>

<body>
     <header><?php include("imaginary_header.php"); ?></header>

     <?php
     $page = (int)($_GET['p'] ?? 0);

     $products = $DB->query('SELECT * FROM collection WHERE user_id=:user_id LIMIT 1 OFFSET ' . $page . '', array('user_id' => $_SESSION['id']));
     ?>
     <?php


     $count = $DB->PDO('SELECT COUNT(id) as count FROM collection');
     $count = (int)$count['count'];

     $pages = ceil($count);


     ?>

     <?php foreach ($products as $product) : ?>

          <section class="block-product">
               <div class="product">
                    <img src="../image/<?= $product->product_id; ?>.png" class="image-collection-product" alt="">
               </div>
          </section>

     <?php endforeach ?>

     <section class="galerie-nav">
          <?php if ($pages >= 1 and $page > 0) : ?>
               <a href="?p=<?= $page - 1; ?>" class="balise">
                   <</a> <?php endif ?> <?php if ($pages >= 1 and $page < $pages - 1) : ?> <a href="?p=<?= $page + 1; ?>" class="balise">/>
               </a>
          <?php endif ?>
     </section>




     <footer><?php include("imaginary_footer.php"); ?></footer>
</body>

</html>