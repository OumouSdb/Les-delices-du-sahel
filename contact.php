<?php
  
  require 'admin/config.php';
  
  function verifyInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  $nomError = $emailError =  $messageError = $nom = $email = $message  ="";
  $isSuccess      = false;
  
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $nom = verifyInput($_POST['nom']);
      $email = verifyInput($_POST['email']);
      $message = verifyInput($_POST['message']);
      $isSuccess      = true;
  
     
  
      
    try {
      $db = Database::connect();
      $statement = $db->prepare('INSERT INTO  formulaire (nom,email,message) values(?,?,?)');
      $statement->execute(array($nom, $email,$messagess));
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      Database::disconnect();
  } catch (PDOException $e) {
  
      
    $e->getMessage();
    $isSuccess = false;
    
  }
  
  
  if($isSuccess){
    header('location: contact.php?success=1');
    
  }else{ 
    header('location: contact.php?error=1');
  
  }
    }
   
  
    
      ?>
      <!DOCTYPE html>
  <html>
  <head>
   <title>header</title>
      <meta name="description" content="Blog de cuisine d'afrique, plats, desserts, cocktails, recette">
      <meta name="keywords" content="lesdelicesdusahel,cuisine africaine">
      <meta name="author" content="Oumou Niakate">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/footer.css">

  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c53d86a718.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="icon" type="image" href="assets/img/africa.png">
    <title>Contact</title>
  </head>
  
  <body>
    <header>
  <?php
  include('include/header.html');
  ?>
  </header>
  
   <main>  
    <h1>Me contacter</h1>
  <div class="container shadow">
    <form class="col-md-6 centre" action="" method="post">
        <div class="form-group">
        <label for="nom">Nom </label>
        <input type="text" class="form-control" id="nom" placeholder="Ex: John" name="nom"   required="">
        <span class="help-inline"><?php echo $nomError; ?></span>
    
      </div>
      <div class="form-group ">
        <label for="email col-md-6" >Email </label>
        <input type="email" class="form-control" id="email" placeholder="Ex:john@doe.fr" name="email"  required="" >
        <span class="help-inline"><?php echo $emailError; ?></span>
    
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" rows="3"
        name="message" required=""  ></textarea>
      </div>

      <div class="btn-centre">
      <button type="submit" class=" mx-auto  bouton" >Envoyer</button>

    </form>
  
  </main>

  <?php
  include('include/footer.php');
  ?>
  </body>
  </html>