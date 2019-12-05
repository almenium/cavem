<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Ecrire un commentaire</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<form method="POST">
    <div class ="input-group">
        <input type="text" class="form-control" name="search" placeholder="Rechercher">
    <div class="input-group-btn">
   <button type="submit" class="btn btn-default" name="submit_search" id="submit_search">
       <i class="glyphicon glyphicon-search"></i>
   </button>
</div>
</div>
</form>
</div>

<div class="container">
        <div class="table-responsive">
        <table class="table table-light table-striped">
        <thead>
      <tr>
          <th>Commentaires</th>
      </tr>
    </thead>
    <tbody>
        <tr>

<?php
require '../db/requetes.php';

$getCmtrWImg->execute();
$listeCmtr = $getCmtrWImg->fetchAll(PDO::FETCH_NUM);

foreach($listeCmtr as list($txtNomfic, $piecJoin, $exten)){
    $comtr=(file_get_contents($directory[0].$txtNomfic));

    echo'<tr><td>'.$comtr.'<img src="'.$directory[0].$piecJoin.'" alt="'.$piecJoin.'" ></td></tr>';

}

?>

</tbody>
  </table>
</div>
    </div> 
</body>
</html>