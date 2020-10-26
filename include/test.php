<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">


    <title>Document</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
    <a class="navbar-brand" href="accueil.php">
        <div class="logoNav">
          <img src="../assets/img/logo.PNG" class="logo">
        </div>
      </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-item nav-link text-white" href="accueil.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-item nav-link text-white" href="plat.php" ><span id="plats">Plats</span> </a> 
            </li>
           
            <li class="nav-item">
            <a class="nav-item nav-link text-white" href="dessert.php"><span id="dessert"> Desserts</span></a>
              
            </li>
            <li class="nav-item">
            <a class="nav-item nav-link text-white" href="cocktail.php"><span id="cocktail">Cocktails</span></a>   
            </li>
          </ul>
          
        </div>
      </nav>
      </header>
      <main>
  
            <div class="hero">
            <img src="../assets/img/fond.jpeg" class="img">
            <h1 class="  animate__animated animate__bounce" id="presentation" > Les délices du sahel vous souhaite la bienvenue...</h1>
          </div>
           
          </main>
          
          <script src="delices.js"></script>

          <?php
include('include/footer.php');
?>
</body>
</html>