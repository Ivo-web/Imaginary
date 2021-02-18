<?php
/*Class administration permettant de gérer la base de donné */


class Admin
{

    private $DB;

    public function __construct($DB)
    {
        $this->DB = $DB;

        if (isset($_GET['delete'])) {
            $this->delete_Data($_GET['delete']);
        }
    }




    //Fonction qui efface une ligne dans une table de données. Elle prend en paramètre l'ID de la ligne a effacer
    public function delete_Data(int $registered_Id)
    {
        $this->DB->data_Helper('DELETE FROM inscriptions WHERE id = :id', array('id' => $registered_Id));
    }





    //Fonction qui efface plusieurs lignes dans une table de données. Elle prend en parmamètre une liste contenant les ID a effacer
    public function delete_Several_Data($data_id)
    {
        $this->DB->data_Helper('DELETE FROM inscriptions WHERE id IN (' . $data_id . ')');
    }




    /*Fonction permettant d'envoyer les modification du formulaire à la base de données. */
    public function send_Modification_Data($nom, $prenom, $mail, $password, $compte, $id)
    {

        $updateData = $this->DB->data_Helper(
            "UPDATE inscriptions 
             SET nom=:nom, prenom=:prenom, mail=:mail, password=:password, compte=:compte WHERE id=:id",

            array(
                'nom' => $nom,
                'prenom' => $prenom,
                'mail' => $mail,
                'compte' => $compte,
                'password' => $password, 'id' => $id
            )
        );
    }





    /*Fonction permettant d'ajouter une nouvelle entrée dans la table. */
    public function send_New_Data($nom, $prenom, $mail, $password, $compte)
    {

        $insertData = $this->$DB->data_Helper(
            "INSERT INTO inscriptions(nom, prenom, mail, password, compte) VALUES(?,?,?,?,?)",
            array($nom, $prenom, $mail, $password, $compte)
        );
    }





    /*Fonction permettant de verifier la validité des données et de les envoyer dans la table*/
    public function handling_Data($handling, $id = null)
    {

        if (isset($_POST['send'])) {
            if (
                !empty($_POST['nom'])
                and !empty($_POST['prenom'])
                and !empty($_POST['mail'])
                and !empty($_POST['password'])
                and !empty($_POST['password-2'])
                and !empty($_POST['count'])
            ) {
                if ($_POST['password'] == $_POST['password-2']) {
                    $mail = $_POST['mail'];
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $nom = htmlspecialchars($_POST['nom']);
                        $prenom = htmlspecialchars($_POST['prenom']);

                        $nomstring = strlen($nom);
                        $prenomstring = strlen($prenom);
                        $mailstring = strlen($mail);
                        $passwordstring = strlen($_POST['password']);


                        if (
                            $nomstring <= 255
                            and $prenomstring <= 255
                            and $mailstring <= 255
                            and $passwordstring <= 255
                        ) {

                            $verifymail = $this->DB->count("SELECT * FROM inscriptions WHERE mail=:mail", array('mail' => $mail));


                            if ($verifymail == 0) {
                                $verifynom = $this->DB->count("SELECT * FROM inscriptions WHERE nom =:nom", array('nom' => $mail));


                                if ($verifynom == 0) {
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                                    $compte = (float)$_POST['count'];

                                    if ($handling === "update") {
                                        $update = $this->send_Modification_Data($nom, $prenom, $mail, $password, $compte, $id);
                                        header('Location: imaginary_admin.php');
                                        
                                    } else if ($handling === "add") {

                                        $add = $this->send_New_Data($nom, $prenom, $mail, $password, $compte);
                                           header('Location: imaginary_admin.php');

                                    } else {
                                        echo 'Il y a un GROS BUG';
                                    }
                                } else {
                                    $erreur = "Ce nom de famille existe deja";
                                }
                            } else {
                                $erreur = "Cette adresse mail axiste dejà.";
                            }
                        } else {
                            $erreur = 'Chaque entré ne doit pas contenir plus de 255 caractères';
                        }
                    } else {
                        $erreur = 'Vous vous êtes trompé quelque part.';
                    }
                } else {
                    $erreur = "Vous avez mal rentrées les information demandées";
                }
            } else
                $erreur = 'Vous n\'avez pas renseigné tout les champs.';
        }
    }


    /*Fonction permettant de générer un formulaire */
    public function form()
    {

        echo <<<HTML

        <section>
               <form action="" method="POST" class="block-inscription" >
                    <label>Entrez votre nom de famille</label>
                   <input type="text" name="nom"  id="inscription-input" >

                    <label>Entrez votre prénom</label>
                    <input type="text" name="prenom" id="inscription-input" >

                   <label>Entrez votre mail</label>
                   <input type="text" name="mail" id="inscription-input">

                  <label>Choisir un mot de passe</label>
                  <input type="password" name="password" id="inscription-input">

                  <label>Confirmez votre mot de passe</label>
                  <input type="password" name="password-2" id="inscription-input">
              
                  <label>Compte</label>
                  <input type="text" name="count" id="inscription-input">

                  <input class="inscription-submit" type="submit" name="send">
                 <label>Importer les modifications ☠</label>
           </form>
       </section>

HTML;
    }
}
