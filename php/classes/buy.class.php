<?php
   /*Classe permettant de finaliser proprement un achat sur la page imaginary_panier.php */
class buy{
              
      private $DB;
      private $panier;   
  
      
            /*Initialisation de la class DB */
      public function __construct($DB, $panier) {
          $this->DB = $DB;
          $this->panier = $panier;

      }
       

     
       /*Fonction vérifiant avant l'achat que la quantité autorisée pour chaque produit n'est pas dépassée,
         elle prend en paramètres: l'id du produit, ainsi que la quantité qui lui est associée. */
  
      public function maxQuantity($quantity, $product_id)
      {
        $products = $this->DB->query("SELECT * FROM products WHERE id =:id", array('id' => $product_id));
        
        foreach($products as $product):

                return $quantity <= $product->authorized_quantity; 

        endforeach;
      }


      /*Fonction vérifiant si le produit à déja été acheté dans sa quantité maximale. Elle prend en paramètre, le panier, ainsi que l'id du produit */
      public function alreadyBought($panier, $product_id)
      {
        $products = $this->DB->query("SELECT * FROM collection WHERE product_id=:product_id", array('product_id' => $product_id));
         
        foreach($products as $product):  
               return $panier += $product->quantity > $product->limit_quantity; 

         endforeach;

      }
      public function transaction()
      {
         $transaction = $this->DB->PDO('SELECT compte FROM inscriptions WHERE id=:id', array('id' => $_SESSION['id']));
         $count = (int)$transaction['compte'];
         var_dump($count);        

      }

         /*Fonction finalisant l'achat. Elle prend en paramètre la requete SQL, un array,  ainsi que l'ID du produits*/
      public function buy($sql, $data = array(), $product_id)
      {
        if (isset($_POST['submit'])) {
            if(!empty($_POST['password'])){
                     $password = $_POST['password'];
                
                    $verify = $this->DB->PDO('SELECT * FROM inscriptions WHERE id=:id', array('id' => $_SESSION['id']));

                     $samepassword = password_verify($password, $verify['password']);
      
                   if($samepassword){  

                           $insert = $this->DB->data_Helper($sql, $data);

                               $this->panier->del($product_id);

                             header('Location:imaginary_profil.php?id='.$_SESSION['id']); 

                   }else {
                       $error = "Mot de passe incorrecte.";
                   }
           }
        }
      }

}


  