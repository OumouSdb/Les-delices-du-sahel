<?php
   require 'config.php';
  $email = $name = $password =  $confirm_password =  $email_err =  $password_err =  $confirm_password_err =  $name_err = "";
  
  
  if (isset($_POST['submit'])){
      if (empty(trim($_POST['name'])))
      {
          $name_err = "Entrez un prénom.";
      }
      else
      {
          $name = trim($_POST['name']);
          if (empty(trim($_POST["email"])))
          {
              $email_err = "Entrez un email.";
          }
          else
          {
              $email = trim($_POST["email"]);
              if (!filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                  $email_err = "le format d'email est invalid";
              }
              else
              {
          
          
              if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*W)#', $password) && strlen(trim($_POST["password"])) < 9 ) {
          
                  $password_err = "le mot de passe doit contenir au moin 9 caractère.";
  
              }
              
              else {
                  echo 'Mot de passe non conforme';
              }
                  if (empty(trim($_POST["password"])))
                  {
                      $password_err = "entrez un mot de passe.";
                  }
                  // elseif (strlen(trim($_POST["password"])) < 9)
                  // {
                  //     $password_err = "le mot de passe doit contenir au moin 9 caractère.";
                  // }
                  else
                  {
                      $password = trim($_POST["password"]);
                  }
                  if (empty(trim($_POST["confirm_password"])))
                  {
                      $confirm_password_err = "Ce champ ne peux pas être vide";
                  }else{
                      $confirm_password = trim($_POST["confirm_password"]);
                  }
                
  
                  if($password != $confirm_password){
                      $password_err = 'Les mots de passe ne sont pas identique';
                  }
                  
                
                      $db = Database::connect();
                      $sql = "SELECT * FROM users WHERE email = :email";
                      if ($stmt = $db->prepare($sql))
                      {
                      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                      $param_email = trim($_POST["email"]);
                      if ($stmt->execute())
                      {
                          if ($stmt->rowCount() > 0)
                          {
                              $email_err = "vous avez déja un compte.";
                          }
                      }
                      else
                      {
                          echo "Quelque chose s'est mal passé revenez plus tard.";
                      }
                      unset($stmt);
                  }
                  if (empty($email_err) && empty($password_err) && empty($name_err))
                  {
                      $sql = "INSERT INTO users (email,name, password) VALUES (:email, :name, :password)";
                      if ($stmt = $db->prepare($sql))
                      {
                          $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                          $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
                          $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                          $param_email = $email;
                          $param_name = $name;
                          $param_password = password_hash($password, PASSWORD_DEFAULT);
                          if ($stmt->execute())
                          {
                              header("location: index.php");
                          }
                          else
                          {
                              echo "Quelque chose s'est mal passé revenez plus tard.";
                          }
                          unset($stmt);
                      }
                  }
                  unset($db);
              }
          }
      }
  }
  ?>
<!DOCTYPE html>
<html>
   <head>
      <!DOCTYPE html>
      <html>
         <head>
            <title>Inscription</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   </head>
   <body>
   <h1 class="text-center py-4">Inscription</h1>
   <div class="container col-4 col-lg-4">
   <div id="form">
   <form class="form" role="inscription.php" action="inscription.php" method="post">
   <div class="form-group text-center">
   <label for="name">Nom: </label>
   <input type="text" class="form-control text-center" id="name" name="name" placeholder="Entrez votre nom" value="<?php echo $name; ?>">
   <span class="help-inline"><?php echo $name_err; ?></span>
   </div>
   <div class="form-group text-center">
   <label for="email">Email: </label>
   <input type="email" class="form-control text-center" id="email" name="email" placeholder="Entrez votre adresse email" value="<?php echo $email; ?>">
   <span class="help-inline"><?php echo $email_err; ?></span>
   </div>
   <div class="form-group text-center">
   <label for="password">Mot de passe: </label>
   <input type="password" class="form-control text-center" id="password" name="password" placeholder="*****" value="<?php echo $password; ?>">
   <span class="help-inline"><?php echo $password_err; ?></span>
   </div>
   <div class="form-group text-center">
   <label for="confirm_password">Confirmer le mot de passe: </label>
   <input type="password" class="form-control text-center" id="confirm_password" name="confirm_password" placeholder="*****" value="<?php echo $confirm_password; ?>">
   <span class="help-inline"><?php echo $confirm_password_err; ?></span>
   </div>
   <br>
   <div class="form-actions text-center">
   <div id="button">
   <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
   <div class="py-2"></div>
   <p id="info"><a href="login.php">Se connecter</a></p>
   </div>
   </form>
   </div>
   </div>
   </body>
   </html>