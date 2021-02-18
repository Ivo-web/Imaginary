<?php
require './classes/db.class.php';
require './classes/panier.class.php';
require './classes/buy.class.php';
require './classes/admin.class.php';
$DB = new DB();
$panier = new panier($DB);
$buy = new buy($DB, $panier);
$admin = new Admin($DB);
?>