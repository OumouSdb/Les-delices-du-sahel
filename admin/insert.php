<?php
  
  session_start();
  
  if (!isset($_SESSION['id']))
  {
      header("location: login.php");
  }
  
  require ('config.php');
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
      $isUploadSuccess = false;
  
      if (empty($titre))
      {
          $titreError = "Ce champs ne peut pas être vide";
          $isSuccess = false;
      }
      if (empty($contenu))
      {
          $contenuError = "Ce champs ne peut pas être vide";
          $isSuccess = false;
      }
  
      if (empty($categorie))
      {
          $categorieError = "Ce champs ne peut pas être vide";
          $isSuccess = false;
      }
      if (empty($image))
      {
          $imageError = "Ce champs ne peut pas être vide";
          $isSuccess = false;
      }
      else
      {
          $isUploadSuccess = true;
  
          if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
          {
              $imageError = "Les fichiers autorisés sont: .jpg. .jpeg. .png. .gif.";
              $isUploadSuccess = false;
          }
  
          if ($_FILES['image']['size'] > 500000)
          {
              $imageError = "Le fichier ne doit pas depasser 500KB";
              $isUploadSuccess = false;
          }
          if ($isUploadSuccess)
          {
              if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath))
              {
                  $imageError = "Il y a une erreur lors de l'upload";
                  $isUploadSuccess = false;
              }
          }
  
      }
      if ($isSuccess && $isUploadSuccess)
      {
          $db = Database::connect();
          $statement = $db->prepare('INSERT INTO  articles (titre,contenu,categorie,image) values(?,?,?,?)');
          $statement->execute(array(
              $titre,
              $contenu,
              $categorie,
              $image
          ));
          
          Database::disconnect();
          header('location: index.php');
      }
  
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
<html>
   <head>
      <title>Insert</title>
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
            <h1><strong>Ajouter un item </strong></h1>
            <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="titre">Nom: </label>
                  <input type="text" class="form-control" id="titre" name="titre" placeholder="entrez le nom" value="<?php echo $titre; ?>">
                  <span class="help-inline"><?php echo $titreError; ?></span>
               </div>
               <div class="form-group">
                  <label for="contenu">contenu: </label>
                  <textarea class="form-control" id="contenu" rows="10" name="contenu" placeholder="entrez la contenu" value="<?php echo nl2br($contenu); ?>"></textarea>
                  <span class="help-inline"><?php echo $contenuError; ?></span>
               </div>
               <div class="form-group">
                  <label for="categorie">Categorie: </label>
                  <select class="form-control" id="categorie" name="categorie">
                  <?php
                     $db = Database::connect();
                     foreach ($db->query('SELECT * FROM categories ') as $row)
                     {
                     
                         echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                     
                     }
                     Database::disconnect();
                     ?>
                  </select>
                  <span class="help-inline"><?php echo $categorieError; ?></span>
               </div>
               <div class="form-group">
                  <label for="image">Selectionner une image: </label>
                  <input type="file" id="image" name="image">
                  <span class="help-inline"><?php echo $imageError; ?></span>
               </div>
               <br>
               <div class="form-actions">
                  <button type="submit" class="btn btn-success">Ajouter</button>
                  <a class="btn btn-primary" href="index.php"> Retour</a>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>