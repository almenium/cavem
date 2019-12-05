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
	try{
		if(isset($_POST["submit"])){
		  $auteur = strtoupper($_POST['pays'].' '.$_POST['nom'].' '.$_POST['prenom']);
		  $cmtr = $_POST['cmtr'];
		  $nameCmtr = time();
		  $listeTheme = $_POST["themes"];
		  $listeMC = $_POST["motcle"];
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
}