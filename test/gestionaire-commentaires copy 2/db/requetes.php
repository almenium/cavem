<?php
require_once 'connect_db.php';

$transac = $db = Database::connect();

$searchNbrMCbyCommments = $db->prepare('SELECT com.COM_TIT, COUNT(ldm.MOTCLE_ID)
                        FROM COMMENTAIRE as com, L_doc_motcle as ldm 
                        WHERE com.COM_ID = ldm.MOTCLE_ID
                        GROUP BY com.COM_TIT');

$showMCusedOnce = $db->prepare('SELECT mc.MOTCLE_LIB 
                                FROM L_doc_motcle as ldm, motcle as mc 
                                WHERE ldm.MOTCLE_ID = mc.MOTCLE_ID 
                                GROUP BY mc.MOTCLE_LIB 
                                HAVING COUNT(ldm.MOTCLE_ID)=1 ');


$themUnderAvgNbrComtr = $db->prepare('SELECT t.THEM_LIB
                                      FROM theme as t
                                      LEFT JOIN l_theme_comtr as ltc
                                      ON ltc.THEM_ID = t.THEM_ID
                                      GROUP BY t.THEM_LIB
                                      HAVING COUNT(ltc.COM_ID) <(SELECT AVG(comm_avg)
                                                                  FROM (SELECT COUNT(*) comm_avg
                                                                  FROM l_theme_comtr
                                                                  GROUP BY THEM_ID) as nbr)');

$searchNbrCmtbyExt = $db->prepare('SELECT ext.EXTEND_LIB,COUNT(com.COM_ID)
                                FROM extention as ext
                                LEFT JOIN commentaire as com
                                ON ext.EXTEND_ID = com.EXTEND_ID
                                GROUP BY ext.EXTEND_ID');                                                                  
                                            
$searchNbrCmtbyTh = $db->prepare('SELECT t.THEM_LIB,COUNT(ltc.com_Id)
                                   FROM theme as t
                                   LEFT JOIN l_theme_comtr as ltc
                                   ON ltc.them_ID = t.them_ID
                                   GROUP BY t.THEM_ID');

$searchByGivExpr = $db->prepare('SELECT COM_NOMFIC
                                    FROM commentaire
                                    WHERE COM_NOMFIC LIKE "% %"');

$searchComNonEU = $db->prepare('SELECT COUNT(c.COM_ID)
                                FROM commentaire as c, internaute as i
                                WHERE c.COM_AUTEUR=i.INT_Id
                                AND i.INT_PAYS NOT IN ("Allemagne", "Autriche", "Belgique", 
                                                      "Chypre", "Croatie", "Danemark", "Espagne", "Estonie", "Finlande",
                                                      "France", "Grèce", "Hongrie", "Irlande", "Italie", "Lettonie", 
                                                      "Lituanie", "Luxembourg","Malte","Norvège", "Pays-Bas", "Pologne", 
                                                      "Portugal", "République tchèque", "Roumanie", "Royaume-Uni", 
                                                      "Slovaquie", "Slovénie", "Suède", "Suisse");');

$showViewComtrLess1Month = $db -> prepare('SELECT * FROM commentaires_recents GROUP BY comtr');

$getTxt = $db->prepare('SELECT COM_NOMFIC, COM_TIT FROM commentaire WHERE EXTEND_ID IN (1)');

$getDirectoryFile = $db->prepare('SELECT PRM_CHEMIN FROM parametre');
$getDirectoryFile -> execute();
$directory = $getDirectoryFile -> fetch(PDO::FETCH_NUM);

$getCmtrWImg = $db->prepare('SELECT c.COM_NOMFIC, clpj.COM_NOMFIC, ext.EXTEND_LIB
                        FROM commentaire AS c
                        JOIN l_piece_jointe AS lpj
                        ON c.COM_ID = lpj.COM_ID
                        LEFT JOIN commentaire AS clpj
                        ON lpj.COM_COM_ID = clpj.COM_ID
                        LEFT JOIN extention as ext 
                        ON clpj.EXTEND_ID = ext.EXTEND_ID
                        WHERE clpj.EXTEND_ID = 2');

$verifExten = $db->prepare('SELECT EXTEND_ID
                            FROM extention
                            WHERE EXTEND_LIB = ?');

$reqmail = $db->prepare("SELECT * FROM internaute WHERE INT_LOGIN = ?");

$insInt = $db->prepare('SELECT INT_NOM, INT_PRE, INT_PAYS, INT_ID
FROM internaute
WHERE INT_NOM = ? AND INT_PRE = ? AND INT_PAYS = ?');

$listExten = $db->prepare('SELECT EXTEND_LIB, EXTEND_ID FROM extention;');
$showThem = $db->prepare('SELECT THEM_ID,THEM_LIB FROM theme;');
$showMC = $db->prepare('SELECT MOTCLE_ID,MOTCLE_LIB FROM motcle');
$ShowThemIdPriv = $db->prepare('SELECT THEM_ID, THEM_LIB, THEM_PRIVE FROM theme;');

$addCmtr = 'INSERT INTO commentaire (EXTEND_ID,COM_TIT,COM_NOMFIC,COM_DMODIF,COM_AUTEUR) VALUES (?,?,?,NOW(),?);';
$addMc = 'INSERT INTO motcle(MOTCLE_LIB) VALUES(?);';
$addLPj = 'INSERT INTO l_piece_jointe(COM_ID,COM_COM_ID) VALUES (?,?);';
$addLMC = 'INSERT INTO l_doc_motcle(MOTCLE_ID,COM_ID) VALUES (?,?);';
$addVIP = 'INSERT INTO internaute(INT_NOM, INT_PRE, INT_LOGIN, INT_PASS, INT_ADRE, INT_ENF, INT_PAYS, INT_DNAISS, TYPINT_ID) 
VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);';
$addNewsletter = 'INSERT INTO internaute(INT_NOM, INT_PRE, INT_LOGIN, INT_PAYS, TYPINT_ID) 
VALUES(?, ?, ?, ?, ?);';
$addLthemCmtr = 'INSERT INTO l_theme_comtr(COM_ID, THEM_ID, INT_ID, DCAP) VALUES(?,?,?,NOW());';


$db = Database::disconnect();

?>