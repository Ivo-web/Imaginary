<?php
    //class qui permet une connexion rapide et automatique à la base de donné
class DB{


    //Paramètres de connexion à la base de donnée
    private $host = 'localhost';
    private $database = 'test';
    private $password = '';
    private $username = 'root';
    private $db;
     
    public function __construct($host = null, $username = null, $password = null, $database = null){
         if($host != null){
             $this->host = $host;
             $this->$username = $username;
             $this->password = $password;
             $this->database = $database;
         }
           
         $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password,
               array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
               $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
    }
    
     /*Fonction similaire à un requete query, qui prends en paramètre la requete SQL
     ainsi qu'un array qui associe une entrée de la table à la variable passée lors de son execution (renvoie le resultat sous forme d'objet avec un fetchAll)*/  
    public function query($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
      
    }


    //Fonction identique à la fonction "query" mais qui renvoi le résultat sous forme de tableau classique
    public function PDO_FetchAll($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll();
    }


    /*Fonction similaire à un requete preparée, qui prends en paramètre la requete SQL
     ainsi qu'un array qui associe une entrée de la table à la variable passée lors de son execution et renvoie le resultat avec un fetch*/ 
    public function PDO($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetch();
    }
 

    /*Fonction similaire à un requete preparée.Elle prends en paramètre la requete SQL
     ainsi qu'un array qui associe une entrée de la table à la variable passée en parametre lors de son execution et retourne un rowCount*/ 
    public function count($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->rowCount();
    
    }

    /*Fonction servant à accomplir des requetes preparées de différents type(INSERT, UPDATE ou DELETE). Elle prend en paramètre la requete SQL
     ainsi qu'un array qui associe une entrée de la table à la variable passée lors de son execution et l'envoie à la base de donnée*/ 
     public function data_Helper($sql, $data = array()){
         $req = $this->db->prepare($sql);
         $req->execute($data);
     }

}

?>