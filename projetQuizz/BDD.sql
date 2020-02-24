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

INSERT INTO UTILISATEUR VALUES ('ADMIN', 'ADMIN', 1, 0);


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

INSERT INTO CLIENT VALUES ('Harry Potter', , "Questions sur le monde d'Harry Potter", , );


# -----------------------------------------------------------------------------
#       TABLE : 
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PREFERENCE
 (
   CLI_NUM INTEGER(2) NOT NULL  ,
   PAYS_CODE VARCHAR(2) NOT NULL  ,
   EST_CODE VARCHAR(2) NOT NULL  
   , PRIMARY KEY (CLI_NUM,PAYS_CODE,EST_CODE) 
 ) 
 comment = "";

INSERT INTO PREFERENCE VALUES (1, 'B', 'DE');
INSERT INTO PREFERENCE VALUES (2, 'B', 'AB');
INSERT INTO PREFERENCE VALUES (3, 'SP', 'EXC');
INSERT INTO PREFERENCE VALUES (2, 'F', 'AB');
INSERT INTO PREFERENCE VALUES (5, 'D', 'S');
INSERT INTO PREFERENCE VALUES (2, 'CH', 'EXC');


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PREFERENCE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PREFERENCE_CLIENT
     ON PREFERENCE (CLI_NUM ASC);

CREATE  INDEX I_FK_PREFERENCE_PAYS
     ON PREFERENCE (PAYS_CODE ASC);

CREATE  INDEX I_FK_PREFERENCE_ESTIMATION
     ON PREFERENCE (EST_CODE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE CLIENT 
  ADD FOREIGN KEY FK_CLIENT_PAYS (PAYS_CODE)
      REFERENCES PAYS (PAYS_CODE) ;


ALTER TABLE PREFERENCE 
  ADD FOREIGN KEY FK_PREFERENCE_CLIENT (CLI_NUM)
      REFERENCES CLIENT (CLI_NUM) ;


ALTER TABLE PREFERENCE 
  ADD FOREIGN KEY FK_PREFERENCE_PAYS (PAYS_CODE)
      REFERENCES PAYS (PAYS_CODE) ;


ALTER TABLE PREFERENCE 
  ADD FOREIGN KEY FK_PREFERENCE_ESTIMATION (EST_CODE)
      REFERENCES ESTIMATION (EST_CODE) ;

