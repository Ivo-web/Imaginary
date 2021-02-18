<?php
require '_header.php';
if(isset($_GET['id'])){
   $product = $DB->query('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
   if(empty($product)){
       die("Ce produit n'existe pas.");
   }
   $panier->add($product[0]->id);
        header("Location:imaginary_panier.php");
}else{
    die("Vous n'avez pas selectionné de produit à ajouter dans le panier.");
}
?>