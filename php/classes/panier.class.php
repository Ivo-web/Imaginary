<?php
    //Classe permettant de gérer un panier
class panier{

    private $DB;
              
         //Initialisation de la variable $DB dans le constructeur pour l'utilisation des fonctions SQL de la class DB
    public function __construct($DB){

        //Si la variable super globale $_SESSION n'existe pas on l'initialise
        if(!isset($_SESSION)){
            session_start();
        }
        //Si la clef $_SESSION['panier] n'existe pas, on la crée
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        $this->DB = $DB;

        //Si la variable $_GET['delpanier'] existe alors on active la fonction del()
        if(isset($_GET['delPanier'])){
             $this->del($_GET['delPanier']);
        }
    }



    //Fonction qui retourne le nombre total de produits dans la panier
    public function count(){
        return array_sum($_SESSION['panier']);
    }
    

    //Fonction qui retourn la somme totale du panier d'achat
    public function total(){
        $total = 0; 
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
            $products = array();
        }else{
                $products = $this->DB->query('SELECT id, price FROM products WHERE id IN ('.implode(',',$ids).')');
             }
        foreach($products as $product){
            $total += $product->price * $_SESSION['panier'][$product->id];
        }
        return $total;
    }


    //Fonction qui rajoute un produit au panier d'achat. Elle prend en paramètre l'ID du produit a ajouter.
    public function add($product_id){
        if(isset($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        }else{
            $_SESSION['panier'][$product_id] = 1;
        }
   
    }


    //Fonction qui retire un produit du panier. Elle prend en paramètre l'ID du produit a effacer.
    public function del($product_id){
        unset($_SESSION['panier'][$product_id]);
    }
}
?>