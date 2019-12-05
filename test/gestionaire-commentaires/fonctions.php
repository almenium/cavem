<?php
require_once 'db/requetes.php';

function my_comments_moderation() {
    add_menu_page( 'Gestionnaires commentaires', 'Commentaires', 'manage_options', 'gestionaire-commentaires/commentaires-admin-page.php', 'my_comments_moderation', 'dashicons-testimonial', 3  );
    echo 
	'<div class="wrap">
		<h1>Commentaires</h1>
	</div>';
}




function create_commentaire(){
	require_once 'db/requetes.php';
	?>
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
				require_once 'db/requetes.php';
				$showMC = $db->prepare('SELECT MOTCLE_ID,MOTCLE_LIB FROM motcle');
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
				require_once 'db/requetes.php';
				$showThem = $db->prepare('SELECT THEM_ID,THEM_LIB FROM theme;');
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
	</div>
<?php
	require_once 'db/requetes.php';
	try{
		if(isset($_POST["submit"])){
		  $auteur = strtoupper($_POST['pays'].' '.$_POST['nom'].' '.$_POST['prenom']);
		  $cmtr = $_POST['cmtr'];
		  $nameCmtr = time();
		  $listeTheme = $_POST["themes"];
		  $listeMC = $_POST["motcle"];
		  var_dump($listeMC);
		  var_dump($listeTheme);
		  array_unshift($listeTheme, "1");
		  $idInt = 3;
			$transac -> beginTransaction();
			$createCMTR = $transac->prepare($addCmtr);
			$createCMTR -> execute(array(1,$nameCmtr,$nameCmtr.'.txt',$auteur));
			$idCmtr = $transac->lastInsertId();
			  foreach($listeMC as $mc => $MCid){
				var_dump($listeMC[$mc]);
				$linkCmtrMc = $transac->prepare($addLMC);
				$linkCmtrMc -> execute(array($MCid,$idCmtr));
			  }
			  foreach($listeTheme as $th => $THid){
				var_dump($listeTheme[$th]);
				$linkCmtrThem = $transac->prepare($addLthemCmtr);
				$linkCmtrThem -> execute(array($idCmtr,$THid,$idInt));
			  }
			  print_r($_FILES);
				foreach($_FILES["attach"]["name"] as $i => $value){
				//foreach($attach[$i] as $key=>$value){
				  if($_FILES["attach"]["error"][$i] == 0){
					  var_dump(["attach"]["error"][$i]);
					  var_dump($_FILES["attach"]["name"]);
					  echo '<br>';
				  $fileName = $_FILES["attach"]["name"][$i];
				  //$fileName = $attach[$i]["nom"];
					print_r('nom du fichier +ext : '.$fileName);
					echo '<br>'; 
				  $fileExten = substr($fileName,(strripos($fileName,'.')+1));
					print_r('nom de l\'extention : '.$fileExten);
					echo '<br>';
				  $verifExten->execute(array($fileExten));
				  $idExt = $verifExten->fetch(PDO::FETCH_NUM);
				  $uploadFile = $directory[0].$fileName;
					print_r('nom du chemin : '.$uploadFile);
					echo '<br>'; 
				  move_uploaded_file($_FILES["attach"]["tmp_name"][$i],$uploadFile);
				  //move_uploaded_file($attach[$i]["temp"],$uploadFile);
				  $fileTitl = substr($fileName,0,(strripos($fileName,'.')));
					print_r('titre du fichier : '.$fileTitl);
					echo '<br>'; 
					  $createPj = $transac->prepare($addCmtr);
					  $createPj -> execute(array($idExt[0],$fileTitl,$uploadFile,$auteur));
					  $idPj = $transac->lastInsertId();
					  var_dump($idPj);
					  $linkCmtrPj = $transac->prepare($addLPj);
					  $linkCmtrPj -> execute(array($idCmtr,$idPj));
					  foreach($listeMC as $mc => $MCid){
						var_dump($listeMC[$mc]);
						$linkCmtrMc = $transac->prepare($addLMC);
						$linkCmtrMc -> execute(array($MCid,$idPj));}
					  foreach($listeTheme as $th => $THid){
						var_dump($listeTheme[$th]);
						$linkCmtrThem = $transac->prepare($addLthemCmtr);
						$linkCmtrThem -> execute(array($idPj,$THid,$idInt));}
					}
				}
			$transac -> commit();
			file_put_contents($directory[0].$nameCmtr.'.txt',$cmtr);
			echo "Votre commentaire a bien &eacutet&eacute ajout&eacute.";
		}
		}
		catch(Exception $e) {
		  echo 'erreur : '.$e->getMessage();
		}
}

function display_commentaire(){

}

function my_comments_moderation_admin_page(){
    echo 
	'<div class="wrap">
		<h1>Commentaires</h1>
	</div>';
?>


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
require_once 'db/requetes.php';

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
<?php
}