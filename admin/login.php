<?php
  include ("config.php");
  session_start();
  if (isset($_SESSION["id"]))
  {
      header("location: index.php");
      exit;
  }
    $email = $password = "";
    $email_err = $password_err = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
      if (empty(trim($_POST["email"])))
      {
          $email_err = "veuillez saisir un email .";
      }
      else
      {
          $email = trim($_POST["email"]);
      }
      if (empty(trim($_POST["password"])))
      {
          $password_err = "veuillez saisir un mot de passe.";
      }
      else
      {
          $password = trim($_POST["password"]);
      }
      if (empty($email_err) && empty($password_err))
      {
          $db = Database::connect();
          $sql = "SELECT id, email, password FROM users WHERE email = :email";
          if ($stmt = $db->prepare($sql))
          {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute())
              {
            if ($stmt->rowCount() == 1)
            {
            if ($row = $stmt->fetch())
            {
            $id = $row["id"];
            $email = $row["email"];
            $hashed_password = $row["password"];
            if (password_verify($password, $hashed_password))
            {
                session_start();
                $_SESSION["id"] = $id;
                header("location: index.php");
            }
            else
            {
                $password_err = "Votre email ou mot de passe est invalide";
            }
            }
            }
            else
                {
                $email_err = "Vous n'avez pas de compte veuillez vous en creer un";
                header("Refresh:5; url=inscription.php");
                 }
            }
            else
              {
                  echo "quelque chose s'est mal passer veillez revenir plus tard.";
              }
              unset($stmt);
          }
      }
      unset($db);
  }
  ?>

<!DOCTYPE html>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   </head>
   <body>
      <h1 class=" text-center py-3">Connexion</h1>
      <div class="container col-4 col-lg-2">
      <div class="row">
      <div class="text-center">
         <form class="form" role="login.php" action="login.php" method="post">
            <div class="form-group">
               <label for="email">Email: </label>
               <input type="email" class="form-control text-center" id="email" name="email" placeholder="entrez l'Email" value="<?php echo $email; ?>">
               <span class="help-inline"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
               <label for="password">Password: </label>
               <input type="password" class="form-control text-center" id="password" name="password" placeholder="*****" value="<?php echo $password; ?>">
               <span class="help-inline"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-actions text-center">
               <div id="button">
                  <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
                  <p id="info"><a href="inscription.php" >S'inscrire</a></p>
               </div>
         </form>
         </div>
      </div>
   </body>
</html>