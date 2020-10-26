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
  
  $titreError = $contenuError = $categorieError = $imageError = $titre = $contenu = $categorie = $image = "";
  
  if (!empty($_POST))
  {
      $titre = checkinput($_POST['titre']);
      $contenu = checkinput($_POST['contenu']);
      $categorie = checkinput($_POST['categorie']);
      $image = checkinput($_FILES['image']['name']);
      $imagePath = '../upload/' . basename($image);
      $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
      $isSuccess = true;
  
      if (empty($titre))
      {
          $titreError = 'Ce champs ne peut pas etre vide.';
          $isSuccess = false;
      }
  
      if (empty($contenu))
      {
          $contenuError = 'Ce champs ne peut pas etre vide.';
          $isSuccess = false;
      }
  
      if (empty($categorie))
      {
          $categorieError = 'Ce champs ne peut pas etre vide.';
          $isSuccess = false;
      }
  
      if (empty($image))
      {
          $isImageUpdated = false;
      }
      else
      {
          $isImageUpdated = true;
          $isUploadSuccess = true;
  
          if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" && $imageExtension)
          {
              $imageError = "Les fichiers autorises sont : .jpg, .png, .jpeg, .gif";
              $isUploadSuccess = false;
          }
  
          if ($_FILES["image"]["size"] > 500000)
          {
              $imageError = "Le fichier ne doit pas depasser 500KB";
              $isUploadSuccess = false;
          }
  
          if ($isUploadSuccess)
          {
              if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
              {
                  $imageError = "Il y a eu une erreur lors du upload";
                  $isUploadSuccess = false;
              }
          }
      }
      if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
      {
          $db = Database::connect();
  
          if ($isImageUpdated)
          {
              $statement = $db->prepare("UPDATE articles set titre = ?, contenu = ?,  categorie = ?, image = ? WHERE id = ?");
              $statement->execute(array(
                  $titre,
                  $contenu,
                  $categorie,
                  $image,
                  $id
              ));
          }
          else
          {
              $statement = $db->prepare("UPDATE articles set titre = ?, contenu = ?,  categorie = ? WHERE id = ?");
              $statement->execute(array(
                  $titre,
                  $contenu,
                  $categorie,
                  $id
              ));
          }
  
          Database::disconnect();
          header("location: index.php");
      }
      else if ($isImageUpdated && !$isUploadSuccess)
      {
          $db = Database::connect();
          $statement = $db->prepare("SELECT image FROM articles WHERE id = ?");
          $statement->execute(array(
              $id
          ));
          $item = $statement->fetch();
          $image = $item['image'];
          Database::disconnect();
      }
  
  }
  else
  {
      $db = Database::connect();
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      $statement = $db->prepare("SELECT * FROM articles WHERE id = ?");
      $statement->execute(array(
          $id
      ));
      $item = $statement->fetch();
      $titre = $item['titre'];
      $contenu = $item['contenu'];
      $categorie = $item['categorie'];
      $image = $item['image'];
  
      Database::disconnect();
  }
  
  function checkinput($data)
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
      <title>Update</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
   </head>
   <body>
      <h1 class="text-logo"></span></h1>
      <div class="container admin">
         <div class="row">
            <div class="col-sm-6">
               <h1><strong>Modifier une recette </strong></h1>
               <br>
               <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="titre">Nom: </label>
                     <input type="text" class="form-control" id="titre" name="titre" placeholder="entrez le nom" value="<?php echo $titre; ?>">
                     <span class="help-inline"><?php echo $titreError; ?></span>
                  </div>
                  <div class="form-group">
                     <label for="contenu">contenu: </label>
                     <textarea class="form-control" id="contenu" rows="10" name="contenu" placeholder="entrez la contenu" ><?php echo $contenu; ?></textarea>
                     <span class="help-inline"><?php echo $contenuError; ?></span>
                  </div>
                  <div class="form-group">
                     <label for="categorie">Categorie: </label>
                     <select class="form-control" id="categorie" name="categorie">
                     <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT * FROM categories ') as $row)
                        {
                            if ($row['id'] == $categorie) echo '<option selected = "selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        
                            echo '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        
                        }
                        Database::disconnect();
                        ?>
                     </select>
                     <span class="help-inline"><?php echo $categorieError; ?></span>
                  </div>
                  <div class="form-group">
                     <label>Image: </label>
                     <p><?php echo $image; ?></p>
                     <label for="image">Selectionner une image: </label>
                     <input type="file" id="image" name="image">
                     <span class="help-inline"><?php echo $imageError; ?></span>
                  </div>
                  <br>
                  <div class="form-actions">
                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Modifier</button>
                     <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"> Retour</a>
                  </div>
               </form>
            </div>
            <div class="col-sm-6 site">
               <div class="thumbnail">
                  <img src="<?php echo '../upload/' . $image; ?>"class="card-img-top" alt="..">
                  <div class="caption">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>