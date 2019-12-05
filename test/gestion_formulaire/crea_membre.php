<?php
require 'db/requetes_crea.php';


$typIntId = 3;

if(isset($_POST['form_inscription'])) {
   /*verification des infos saisie pour eviter un hack*/
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $adresse = htmlspecialchars($_POST['adresse']);
   $pays = htmlspecialchars($_POST['pays']);
   $dNaiss = htmlspecialchars($_POST['dNaiss']);
   $enf =  htmlspecialchars($_POST['enf']); /*verifier si integer de 1 à 999*/
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   /*crypter le mot de passe*/
   $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
   $mdp2 = password_hash($_POST['mdp2'],PASSWORD_DEFAULT);

   /* condi que si les données ne sont pas vides */
   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['pays']) 
   AND !empty($_POST['enf']) AND !empty($_POST['dNaiss']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      
      /* condi si la taille du prénom et nom est egal ou inferieur à 30 caractères  */
      if((strlen($nom) <= 30) AND (strlen($prenom) <= 30)){
         /* condi si le 1er mail saisie est égal au 2eme mail */
         if($mail == $mail2) {
            /*condi si le mail est bien au format valide avec utilisation de la fonction filter_var */
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               /*execution de la requete et affectation du nombre de lignes dans le tableau contenant l'email demandé*/
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               /*condi : si mail n'existe pas*/
               if($mailexist == 0) {
                  /*condi si la 1ere saisie du mot de passe est égale a la 2eme saisie */
                  if($mdp == $mdp2) {
                     /*preparation et application de la requete de création d'un membre VIP*/
                     $insertmbr->execute(array($nom, $prenom, $mail, $mdp, $adresse, $enf, $pays, $dNaiss, $typIntId));
                     /*messages d'erreur si condi non appliquée*/
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre nom et prénom ne doit pas dépasser 30 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}