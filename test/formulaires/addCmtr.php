<!DOCTYPE html>
<html>

<head>
  <title>Ecrire un commentaire</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
   <form action="create_commentaire.php" method="post" enctype="multipart/form-data" ><!--class="was-validated"-->
        <h2>Ecrire un commentaire</h2>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" placeholder="Votre Nom" id="nom" required>
        </div>
        <div class="form-group">
            <label for="nom">Prenom :</label>
            <input type="text" class="form-control" name="prenom" placeholder="Votre Prenom" id="prenom" required>
        </div>
        <div class="form-group">
            <label for="nom">Pays :</label>
            <input type="text" class="form-control" name="pays" placeholder="Votre Pays" id="pays" required>
        </div>
        <div class="form-group">
            <label for="nom">Commentaire :</label>
            <textarea name="cmtr" class="form-control" placeholder="Votre commentaire..." id="cmtr" ></textarea>
        </div>
        <div class="form-group">
            <label for="nom">Mots-cles :</label>
            <select name="motcle[]" class="form-control" id="motcle" multiple>
                <?php 
                require_once '../db/requetes.php';
                $showMC -> execute();
                $listeMC = $showMC -> fetchALL(PDO::FETCH_NUM);
                foreach($listeMC as list($id,$motcle)){
                    echo '<option value="'.$id.'">'.$motcle.'</option>';
                }
                ?>
               <!-- <option>
                <a href="#" data-toggle="popover" title="Creation d'un theme" data-content="../form_creation/AddMC.php">Ajouter un theme</a> 
                </option> -->
            </select>
        </div>
        <div class="form-group">
            <label for="nom">Selectionnez un a plusieurs themes:</label>
            <select name="themes[]" class="form-control" id="themes" multiple required>
                <?php 
                require_once '../db/requetes.php';
                $showThem -> execute();
                $listeThemes = $showThem -> fetchALL(PDO::FETCH_NUM);
                $themeDefaut = array_shift($listeThemes);
                foreach($listeThemes as list($id,$theme)){
                    echo '<option value="'.$id.'">'.$theme.'</option>';
                }
                ?>
               <!-- <option>
                <a href="#" data-toggle="popover" title="Creation d'un theme" data-content="../form_creation/AddTheme.php">Ajouter un theme</a>
                </option> -->
            </select>
        </div>
        <div class="form-group">
            <label for="nom" class="custom-file-label">Ajouter:</label>
            <input type="file" class="custom-file-input" name="attach[]" multiple>
        </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
    </form>
</body>
<script>

// nom du doc du dernier fichier select s'affiche, verifier pour +1
//$(".custom-file-input").on("change", function() {
//  var fileName = $(this).val().split("\\").pop();
//  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
//});

$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});

</script>
</html>

