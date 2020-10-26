<?php
   session_start();
   
   if (!isset($_SESSION['id']))
   {
       header("location: login.php");
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Admin</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
   </head>
   <body>
      <h1 class="text-logo"></h1>
      <div class="container admin">
         <div class="row">
            <h1 class="mx-5"><strong>liste de recettes </strong></h1>
            <a href="insert.php" class="btn btn-success btn-lg">Ajouter </a>
            <a href="disconnection.php" class="btn btn-danger btn-lg">Deconnexion </a>
            <a href="../accueil.php" class="btn btn-info btn-lg">Accueil </a>
            <table class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th width="250px">Titre</th>
                     <th>Categorie</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     require 'config.php';
                     $db = Database::connect();
                     $statement = $db->query('SELECT articles.id, articles.titre, categories.name AS categorie FROM articles LEFT join categories
                     ON articles.categorie = categories.id ORDER BY articles.id DESC');
                     while ($item = $statement->fetch()):
                     ?>
                  <tr>
                     <td> <?php echo $item['titre'] ?></td>
                     <td><?php echo $item['categorie'] ?></td>
                     <td width="300">
                        <a class="btn btn-default" href="view.php?id= <?php echo $item['id'] ?>">Voir</a>
                        <a class="btn btn-primary" href="update.php?id= <?php echo $item['id'] ?>">Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">Supprimer</a>
                     </td>
                  </tr>
                  <?php endwhile; ?>
                  <?php
                     Database::disconnect();
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>