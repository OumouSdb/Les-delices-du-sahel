<?php
  session_start();
  
  if (!isset($_SESSION['id']))
  {
      header("location: login.php");
  }
  
  require 'config.php';
  
  if (!empty($_GET['id']))
  {
      $id = checkinput($_GET['id']);
  }
  $db = Database::connect();
  $statement = $db->prepare('SELECT articles.id, articles.titre, articles.contenu,articles.image, categories.name AS categorie FROM articles LEFT join categories ON articles.categorie = categories.id WHERE articles.id = ?');
  $statement->execute(array($id));
  $item = $statement->fetch();
  Database::disconnect();
  
  function checkInput($data)
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
  
  ?>
  
  <!DOCTYPE html>
  <html>
  <head>
   <title>View</title>
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
      <div class="col-sm-6">
      <h1><strong>Voir une recette</strong></h1>
  <br>
  <form>
  <div class="form-group">
  <label>Titre: </label><?php echo ' ' . $item['titre']; ?> </div>
  <div class="form-group">
  <label>contenu:</label><?php echo ' ' . nl2br($item['contenu']); ?> </div>
  <div class="form-group">
  <label>Categorie: </label><?php echo ' ' . $item['categorie']; ?> </div>
  <!-- <div class="form-group">
  <label>Image: </label><?php echo ' ' . $item['image']; ?> </div> -->
  </form>
  
  <div class="form-actions">
  <a class="btn btn-primary" href="index.php"> Retour</a>
  </div>
  </div>
  
  <div class="col-sm-6 site">
          <div class="thumbnail">
          <img src="<?php echo '../upload/' . $item['image']; ?>"class="card-img-top" alt="..">
          <div class="caption">
         
 </div>
 </div>
 </div>
  
  </div>
  </div>
  
  </body>
  </html>