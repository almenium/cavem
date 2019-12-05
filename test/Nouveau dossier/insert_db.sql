INSERT INTO type_internaute(TYPINT_LIB)
VALUES
("MODERATEUR"),
("UTILISATEUR"),
("MEMBRE");

--VIP--
INSERT INTO internaute(TYPINT_ID,INT_NOM,INT_PRE,INT_LOGIN,INT_PASS,INT_ADRE,INT_ENF,INT_PAYS,INT_DNAISS)
VALUES
(3,),
;

--utilisateur--
INSERT INTO internaute(TYPINT_ID,INT_NOM,INT_PRE,INT_PAYS)
VALUES
(2,"user","user","pays"),
;

--Moderateur--
INSERT INTO internaute(TYPINT_ID,INT_NOM,INT_PRE,INT_LOGIN,INT_PASS,INT_PAYS)
VALUES
(1,"Menier","Alexia","alMenier","1mot2passe","FRANCE");


INSERT INTO centre_d_interet(CENTRE_LIB)
VALUES 
("ECOLOGIE"),
("NATURE"),
("RANDONNEE"),
("SPORTS EXTREMES"),
("MUSIQUE"),
("GASTRONOMIE");

-- membre uniquement --
INSERT INTO l_centre_interet(INT_ID,CENTRE_ID)
VALUES 
(,);


INSERT INTO pages(PAGE_LIB)
VALUES
("DEFAUT"),
("ACCUEIL"),
("RANDONNEE"),
("FREJUS"),
("SAINT-RAPHAEL");

INSERT INTO theme(THEM_LIB,INT_ID)
VALUES
("DEFAUT",1),
("",),
("",),
("",),
("",),
("",);

INSERT INTO l_pages_themes(PAGE_ID,THEM_ID)
VALUES
(1,1),
(,),
(,),
(,),
(,),
(,),
(,),
(,);

INSERT INTO extention(EXTEND_LIB)
VALUES
("txt"),
("jpg"),
("jpeg"),
("png"),
("doc"),
("docx"),
("pdf"),
(""),
(""),
(""),
(""),
(""),
("");


INSERT INTO commentaire(EXTEND_ID,COM_TIT,COM_NOMFIC,COM_DMODIF)
VALUES
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","",""),
(,"","","");

INSERT INTO l_theme_comtr(COM_ID, THEM_ID, INT_ID, DCAP)
VALUES
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
(,,,""),
;

INSERT INTO motcle(MOTCLE_LIB)
VALUES
("defaut"),
("randonnee"),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
(""),
("");

INSERT INTO l_doc_motcle(MOTCLE_ID,COM_ID)
VALUES
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,);

INSERT INTO l_piece_jointe(COM_ID,COM_COM_ID)
VALUES
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,),
(,);