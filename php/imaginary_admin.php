<?php
require '_header.php';
require './classes/number_helper.php';

define('PER_PAGE', 10);

$query = "SELECT * FROM inscriptions";
$queryCount = "SELECT COUNT(id) as count FROM inscriptions";
$params = [];

//Recherche pas ville
if (!empty($_GET['q'])) {
     $query .= " WHERE nom LIKE :nom";
     $params['nom'] = '%' . $_GET['q'] . '%';
}


//Pagination
$page = (int)($_GET['p'] ?? 1);
$offset = ($page - 1) * PER_PAGE;

$query .= " LIMIT " . PER_PAGE . " OFFSET $offset";

$inscrits = $DB->PDO_FetchAll($query, $params);

$count = (int)$DB->PDO($queryCount)['count'];
$pages = ceil($count / PER_PAGE);
var_dump($count);

$sigle = "$";
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/imaginary.css">
     <title>Document</title>
</head>

<body>
     <header>
          <h1>Admin</h1>
     </header>

     <form action="">
          <input type="text" name="q" value="<?= htmlentities($_GET['q'] ?? null); ?>">
          <input type="button" value="">
     </form>

     <div id="database-block">
          <table id="data-table">
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>Prenom</th>
                         <th>Nom</th>
                         <th>Adresse</th>
                         <th>solde</th>
                    </tr>
               </thead>
               <tbody>
                    <form action="imaginary_admin.php" method="post">

                         <?php foreach ($inscrits as $inscrit) : ?>
                              <?php $inscrit['id'] = (int)$inscrit['id']; ?>
                              <tr>
                                   <td class="array-data">#<?= $inscrit['id']; ?></td>
                                   <td class="array-data"><?= $inscrit['prenom']; ?></td>
                                   <td class="array-data"><?= $inscrit['nom']; ?></td>
                                   <td class="array-data"><?= $inscrit['mail']; ?></td>
                                   <td class="array-data"><?= NumberHelper::money_Format($inscrit['compte'], $sigle); ?></td>

                                   <td><input type="checkbox" name="check-data[]" value="<?= $inscrit['id']; ?>"></td>

                                   <td><a href="?update-data=<?= $inscrit['id']; ?>">Modifier</a></td>

                                   <td><a href="?delete=<?= $inscrit['id']; ?>" class="admin-database-link">❌</a></td>
                              </tr>
                         <?php endforeach ?>
               </tbody>
          </table>

          <div id="block-footer">
               <input type="submit" name="delete-button" value="Effacer la selection">
               <input type="submit" name="add-button" value="Ajouter une entrée dans la table">
          </div>
          </form>


          <?php

          if (isset($_POST['delete-button'])) {
               if (isset($_POST['check-data'])) {
                    $data =  implode(',', $_POST['check-data']);
                    $deleteData = $admin->delete_Several_Data($data);
                    header('Location: imaginary_admin.php');
               }
          }
          if (isset($_GET['update-data'])) {

               $handling = "update";
               $updateId = $_GET['update-data'];

               $form = $admin->form();
               $update = $admin->handling_Data($handling, $updateId);
            
          }
          if (isset($_POST['add-button'])) {
          
               $handling = "add";
               
               $form = $admin->form();
               $add = $admin->handling_Data($handling);
        
          }

          ?>

          <div id="block-pagination-link">
               <?php if ($pages > 1 and $page > 1) : ?>
                    <a href="?p=<?= $page - 1; ?>" class="admin-pagination-link">PAGE PRECEDENTE</a>
               <?php endif; ?>
               <?php if ($pages > 1 and $page < $pages) : ?>
                    <a href="?p=<?= $page + 1; ?>" class="admin-pagination-link">PAGE SUIVANTE</a>
               <?php endif; ?>
          </div>
     </div>
</body>

</html>