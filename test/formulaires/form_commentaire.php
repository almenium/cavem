<?php require "../gestion_formulaire/crea_commentaire.php" ?>
<h2>Commentaires:</h2>
<form method="POST">
   
   <input type="text" name="nom" placeholder="Votre nom"><br>
   <input type="text" name="prenom" placeholder="Votre prenom"><br>
   <input type="text" name="pays" placeholder="Votre pays"><br>   
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br>
   <input type="file" name="attach" placeholder="Piece jointe"><br>
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire">
   
</form>