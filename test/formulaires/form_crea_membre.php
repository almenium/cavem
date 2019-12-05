<?php
require '../gestion_formlaire/crea_membre.php';

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Formulaire Inscription Membre VIP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Inscription</h2>
         <br /><br />
         <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="nom">Nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)){ echo $nom; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Prénom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="pays">Pays :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pays" id="pays" name="pays" value="<?php if(isset($pays)){ echo $pays; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="dNaiss">Date de naissance :</label>
                  </td>
                  <td>
                     <input type="date" placeholder="Votre date de naissance" id="dNaiss" name="dNaiss" value="<?php if(isset($dNaiss)){ echo $dNaiss; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="adresse">Adresse :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre adresse" id="adresse" name="adresse" value="<?php if(isset($adresse)){ echo $adresse; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="enf">Nombre d'enfants :</label>
                  </td>
                  <td>
                     <input type="select" placeholder="" id="enf" name="enf" value="<?php if(isset($enf)){ echo $enf; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="centreInte">Centres d'interets :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre centre d'interet" id="centreInte" name="centreInte" value="<?php if(isset($centreInte)){ echo $centreInte; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)){ echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)){ echo $mail2; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>