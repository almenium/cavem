<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Activités</title>
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

<?php
require '../db/requetes.php';

if(isset($_POST['submit_search'])) {
$search=htmlspecialchars($_POST['search']);

$getTxt->execute();
$listeCmtr = $getTxt -> fetchALL(PDO::FETCH_NUM);

?>
<div class="container">
 <div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
          <th>Liste des commentaires</th>
      </tr>
    </thead>
    <tbody>
        <tr>
    <?php
    $pasCmtr = TRUE;
foreach($listeCmtr as list($a, $b)){
    $comtr=(file_get_contents($directory[0].$a));
    $posExtrait = stripos($comtr,$search);
    if($posExtrait!== FALSE){
        $pasCmtr = FALSE;
        if($posExtrait <= 75){
            /*si position début extrait est <= 75 je met la position à 0*/
            $posExtrait = 0;
        } else {
            /*sinon j'enleve 20 à la position pour afficher les 75 charactères avant*/
            $posExtrait -= 75;
        }

        if(strlen($comtr)<=(strlen($search)+150)){
            /*sinon si la longueur du commentaire est inferieur ou égale à la longueur de l'extrait on affiche le commentaire*/
            echo '<tr><td><a href="#" data-toggle="popover" data-trigger="hover" data-content="'.$comtr.'">'.$b.'</a></td></tr>';
        }else{
            /* sinon on ajoute 150 à la longueur du mot recherché et on affiche l'extrait*/
            $lenExtrait = strlen($search)+150;
            $extrait = substr($comtr,$posExtrait,$lenExtrait);
            $posSpaceStart = stripos($extrait," ");
            $posSpaceEnd = strripos($extrait," ");
            $extrait = substr($extrait,$posSpaceStart,($posSpaceEnd-$posSpaceStart));
            echo '<tr><td><a href="#" data-toggle="popover" data-trigger="hover" data-content="...'.$extrait.'...">'.$b.'</a></td></tr>';
        }
    }  
}
    if($pasCmtr == TRUE){
        echo 'Il n\'y a pas de commentaire qui correspond à votre recherche' ;
    }
}
    ?>
    </tbody>
  </table>
</div>
    </div> 

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
</body>
</html>