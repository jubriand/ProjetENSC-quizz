# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS UTILISATEUR
 (
   PSEUDO VARCHAR(20) NOT NULL  ,
   MDP VARCHAR(20) NOT NULL  ,
   IS_ADMIN TINYINT NOT NULL  ,
   TOTAL_SCORE INTEGER NOT NULL  
   , PRIMARY KEY (PSEUDO) 
 ) 
 comment = "";

INSERT INTO UTILISATEUR VALUES ('ADMIN', 'ADMIN', 0, 0);


# -----------------------------------------------------------------------------
#       TABLE : THEME
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS THEME
 (
   NOM_THEME VARCHAR(50) NOT NULL  ,
   PHOTO VARCHAR(250) NULL  ,
   DESC_THEME TEXT(500) NOT NULL  ,
   TIMER BIGINT NOT NULL DEFAULT '600'  ,
   NB_QUEST INT NOT NULL DEFAULT '10' 
   , PRIMARY KEY (NOM_THEME) 
 ) 
 comment = "";

INSERT INTO THEME(NOM_THEME, DESC_THEME) VALUES ('Harry Potter',"Questions sur le monde d'Harry Potter");


# -----------------------------------------------------------------------------
#       TABLE : QUESTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS QUESTION
 (
   ID_QUEST INTEGER NOT NULL  ,
   INTITULE VARCHAR(500) NOT NULL  ,
   TYPE_QUEST VARCHAR(50) NOT NULL ,
   MEDIA VARCHAR(250) NULL, 
   NOM_THEME VARCHAR(50) NOT NULL
   , PRIMARY KEY (ID_QUEST) 
 ) 
 comment = "";

INSERT INTO QUESTION(ID_QUEST,INTITULE,TYPE_QUEST,NOM_THEME) VALUES (1, 'Quel est le nom du personnage principal', 'TEXT','Harry Potter');



# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE QUESTION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_QUESTION_THEME
     ON QUESTION ( NOM_THEME ASC);

# -----------------------------------------------------------------------------
#       TABLE : REPONSE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS REPONSE
 (
   ID_REPONSE INTEGER NOT NULL  ,
   INTITULE VARCHAR(500) NOT NULL  ,
   IS_TRUE TINYINT NOT NULL ,
   ID_QUEST INTEGER NOT NULL  ,
   PRIMARY KEY (ID_REPONSE) 
 ) 
 comment = "";

INSERT INTO REPONSE VALUES (1, 'Harry Potter', 0, 1);



# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE REPONSE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_REPONSE_QUESTION
     ON REPONSE ( ID_QUEST ASC);

# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE QUESTION 
  ADD FOREIGN KEY FK_QUESTION_THEME (NOM_THEME)
      REFERENCES THEME (NOM_THEME) ;


ALTER TABLE REPONSE
  ADD FOREIGN KEY FK_REPONSE_QUESTION (ID_QUEST)
      REFERENCES QUESTION (ID_QUEST) ;
