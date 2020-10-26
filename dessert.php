<!DOCTYPE html>
  <html>
  <head>

      <meta name="description" content="Blog de cuisine d'afrique, plats, desserts, cocktails, recette">
      <meta name="keywords" content="lesdelicesdusahel,cuisine africaine">
      <meta name="author" content="Oumou Niakate">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c53d86a718.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="icon" type="image" href="assets/img/africa.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/footer.css">

  
    
    <title>Desserts</title>
  </head>
  <body>
   <header>  
  <?php
  include 'include/header.html';
  ?>

  <body>
  <div class="wrapper">
  
    <?php
    require 'admin/config.php';
  
    ?>
  
    <h1>Nos Desserts</h1>
    
    <?php
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
           
            echo '</ul>
            </nav>';
    echo '<div class="tab-content container">';
  
    foreach ($categories as $categorie):
      if($categorie['id'] == '2')
  
    echo  '<div class="tab-pane show active" id = "a'.$categorie['id'].'" role = "tabpanel">';
      else
    echo  '<div class = "tab-pane" id = "a'.$categorie['id'].'" role = "tabpanel">';
      
      echo  '<div class="row">';
      $statement = $db->prepare('SELECT * FROM articles WHERE articles.categorie = ?');
      $statement->execute(array($categorie['id']));
  
      while($item = $statement->fetch()):
        $imgSrc = 'upload/'.$item['image'];
        $readMore = $item['contenu'];
  
        if (strlen($readMore) > 100) {
          $max = substr($readMore, 0, 100);
          } else {
          $max = $readMore;
          }
  
  ?>
       <div class="card col-sm-6 col-12 col-lg-4" style="width: 18rem;  margin-top: 20px;">
                <img src="<?php echo $imgSrc ?>" class="card-img-top" alt="...">
                  <h4 class="card-title"><?php echo $item['titre'] ?></h4>
                  <p class="card-text"><?php echo $max.'...' ?></p>                
      <a class="btn btn-danger" href="article.php?id=<?php echo $item['id'] ?>">Voir la recette</a>        
        </div>
  
        <?php endwhile; ?>
      </div>
      </div>
      
        <?php endforeach; ?>
        <?php
    Database::disconnect();
    ?>
  
      </div>
    </div>
    
    <!-- <div class="py-5"></div>
    <div class="push"></div>
        </div> -->
    <?php
  include('include/footer.php');
  ?>
  </body>
  </html>