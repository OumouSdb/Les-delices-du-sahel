<?php
  session_start();
  
  if (!isset($_SESSION['id']))
  {
      header("location: login.php");
  }
  require 'config.php';
  
  if (!empty($_GET['id']))
  {
      $id = checkInput($_GET['id']);
  }
  if (!empty($_POST))
  {
      $id = checkInput($_POST['id_delete']);
      $db = Database::connect();
      $statement = $db->prepare("DELETE FROM articles WHERE id= ?");
      $statement->execute(array(
          $id
      ));
      Database::disconnect();
      header('location: index.php');
  }
  
  function checkInput($data)
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
  
  ?>
  
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <title>Supprimer</title>
   </head>
   <body>
      <div class="container admin">
         <div class="row">
            <h1><strong>Supprimer une recette</strong></h1>
         </div>
         <form class="form" role="form" method="post"   action="delete.php">
            <input type="hidden" name="id_delete" value="<?php echo $id; ?>">
            <p class="alert alert-warning">Êtes vous sure de vouloir supprimer ?</p>
            <div class="form-actions">
               <button type="submit" class="btn btn-warning">Oui</button>  
               <a class="btn btn-default" href="index.php">Non</a>
            </div>
         </form>
      </div>
   </body>
</html>