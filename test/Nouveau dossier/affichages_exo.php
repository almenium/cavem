<?php
require '../db/requetes.php';

$searchNbrMCbyCommments -> execute();
$liste = $searchNbrMCbyCommments -> fetchALL(PDO::FETCH_NUM);
print_r($liste);
foreach($liste as list($a, $b)) {
    echo 'Le commentaire "'.$a.'" a '.$b.' mot-clé(s).<br>';
};

echo '<br><br>';

$showMCusedOnce -> execute();
$liste = $showMCusedOnce -> fetchALL(PDO::FETCH_NUM);
print_r($liste);
foreach($liste as list($a)) {
    echo 'Le commentaire "'.$a.'" a 1 mot-clé.<br>';
};

echo '<br><br>';

$themUnderAvgNbrComtr -> execute();
$liste = $themUnderAvgNbrComtr -> fetchALL(PDO::FETCH_NUM);
print_r($liste);
echo 'Liste des Thèmes avec un nombre de commentaire en dessous de la moyenne : <br>';
foreach($liste as list($a)){ 
    echo $a.'<br>';
}

echo '<br><br>';

$searchNbrCmtbyTh -> execute();
$liste = $searchNbrCmtbyTh -> fetchALL(PDO::FETCH_NUM);
print_r($liste);
foreach($liste as list($column1, $column2)){
    echo 'Le theme '.$column1.' a '.$column2.' commentaire(s) référencé(s).<br>';
}

echo '<br><br>';

$searchComNonEU -> execute();
$liste = $searchComNonEU -> fetch(PDO::FETCH_NUM);
print_r($liste);
echo "Le nombre de commentaires émis par des internautes situé en dehors de l'EU sont ".$liste[0].".<br>";

echo '<br><br>';

$showViewComtrLess1Month -> execute();
$liste = $showViewComtrLess1Month -> fetchALL(PDO::FETCH_NUM);
print_r($liste);
foreach($liste as list($column1, $column2)){
    echo ' commentaire : "'.$column1.'" Date : '.$column2.'<br>';
}



//print_r($liste);

//var_dump($liste);

?>