<meta charset="utf-8">
<?php
require_once "../db/requetes.php" ;
function checkVIP(){
   /*verification des infos saisie pour eviter un hack*/
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $adresse = htmlspecialchars($_POST['adresse']);
   $pays = htmlspecialchars($_POST['pays']);
   $dNaiss = htmlspecialchars($_POST['dNaiss']);
   $enf =  htmlspecialchars($_POST['enf']); /*verifier si integer de 1 à 999*/
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
}

function password(){
   $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
   $mdp2 = password_hash($_POST['mdp2'],PASSWORD_DEFAULT);
}

function checkCmtr($bd){
   if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $getid = htmlspecialchars($_GET['id']);
   $page = $bd->prepare('SELECT * FROM pages WHERE id = ?');
   $page->execute(array($getid));
   $page = $page->fetch();
   if(isset($_POST['submit_commentaire'])) {
      if(isset($_POST['nom'],$_POST['prenom'],$_POST['pays'],$_POST['commentaire']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pays']) AND !empty($_POST['commentaire'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pays = htmlspecialchars($_POST['pays']);
         $commentaire = htmlspecialchars($_POST['commentaire']);
      } else {
         $c_msg = "Erreur: Tous les champs doivent être complétés";
      }
   }
}
}



   ?>