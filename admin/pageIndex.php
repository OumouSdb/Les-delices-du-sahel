<?php
session_start();

if (!isset($_SESSION['email']))
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
<h1><strong>list item </strong></h1><a href="insert.php" class="btn btn-success btn-lg">Ajouter <br></a>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th width="150px">Titre</th>
<th>Contenu</th>
<th>Categorie</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
require 'config.php';
$db = Database::connect();
$statement = $db->query('SELECT articles.id, articles.titre, articles.contenu, categories.name AS categorie FROM articles LEFT join categories ON articles.categorie = categories.id ORDER BY articles.id DESC');
while ($item = $statement->fetch())
{

    echo '<tr>';
    echo '<td>' . $item['titre'] . '</td>';
    echo '<td>' . $item['contenu'] . '</td>';
    echo '<td>' . $item['categorie'] . '</td>'; //il ne s'agit pas de la colonne categorie
    echo '<td width="300">';
    echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class=""></span>Voir</a>';
    echo ' ';
    echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
    echo ' ';
    echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-remove"></span>Supprimer</a>';

    echo '</td>';
    echo '</tr>';
}
Database::disconnect();

?>

</tbody>
</table>
</div>
</div>

</body>
</html>
