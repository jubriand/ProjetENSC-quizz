<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php";

//On récupère les infos sur le thème sélectinné
if(!isset($_SESSION['ID_THEME']))//Cas d'une arrivée depuis l'accueil
{
    $ID_THEME = $_GET['id'];
    $_SESSION['ID_THEME']=$ID_THEME;
}
else //Cas d'une arrivée autre (ex: après modif)
{
    $ID_THEME=$_SESSION['ID_THEME'];
}

$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
$stmt->execute(array($ID_THEME));
$theme = $stmt->fetch(); 
?>


<html>
    <body>
        <?php require_once "../Includes/header.php"; ?>
        <div class="container">
            <br/><div class="jumbotron">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        <img class="img-fluid" src="../Images/<?= $theme['PHOTOS'] ?>" title="<?= $theme['NOM_THEME'] ?>" />
                    </div>
                    <div class="col-md-7 col-sm-6">
                        <br/>
                        <h2 class= "text-center"><span class="title"><?= $theme['NOM_THEME'] ?></span></h2><br/><br/>
                        <p><span class="font-weight-bold">Nombre de questions:</span> <?= $theme['NB_QUESTIONS'] ?> <?php if($_SESSION['mode']=="admin"){AddModif("NB_QUESTIONS","theme",$ID_THEME);}?></p>
                        <p><?= $theme['DESC_THEME'] ?><?php if($_SESSION['mode']=="admin"){AddModif("DESC_THEME","theme",$ID_THEME);}?></p>

                        <?php if($_SESSION['mode']=="joueur")
                        {?>
                            <h4 class= "text-center">Meilleur score: <?= $theme['BEST_SCORE'] ?></h4>

                            <br/>
                            <br/>
                            <h5 class= "text-center">Choix de la difficulté:</h5>
                            <div class='row'>
                                <div class="col"> <p class="text-center"> <a href="PartieQuizz.php?diff=1" class="btn btn-success btn-lg choiceBtn"> Facile</a> </p> </div>
                                <div class="col"> <p class="text-center"> <a href="PartieQuizz.php?diff=2" class="btn btn-warning btn-lg choiceBtn"> Moyen </a> </p> </div>
                                <div class="col"> <p class="text-center"> <a href="PartieQuizz.php?diff=3" class="btn btn-danger btn-lg choiceBtn"> Difficile </a> </p> </div>
                            </div>
                        <?php }
                        else if($_SESSION['mode']=="admin")
                        { ?>
                        <br/><br/><p class='text-center'><?php AddSupp('Theme');?> </p>
                        <?php } ?>
                    </div>
                </div>            
            </div>
            <?php if($_SESSION['mode']=="admin") //Si on est en mode admin la liste des questions et de leurs réponses s'affiche
            {
                $questions = getDb()->prepare('select * from question where ID_THEME=? order by ID_QUEST');
                $questions->execute(array($ID_THEME));
                ?>
                <br/><div class="jumbotron">
                    <h3 class="text-center"> Liste des questions </h3>
                    <?php
                    $i=1; 
                    foreach($questions as $question)
                    {?>
                        <hr/>
                        <div class='float-right'><?php AddSupp('Question', $question['ID_QUEST']);?></div>
                        
                        <h4>Question n°<?= $i?>: </h4> 

                        <p>Intitulé: <?= $question['INTITULE'] ?> <?php AddModif("INTITULE","question",$question['ID_QUEST']);?></p>
                        <p>Type de Question: 
                        <?php if($question['TYPE_QUEST']==0)
                        {
                            print " Vrai/Faux";
                        }
                        elseif($question['TYPE_QUEST']==1)
                        {
                            print " Question ouverte";
                        }
                        elseif($question['TYPE_QUEST']==2)
                        {
                            print " QCM";
                        }
                        ?> </p>
                        <h5>Réponses: </h5>
                        <?php $reponses = getDb()->prepare('select * from reponse where ID_QUEST=? order by ID_REPONSE');
                        $reponses->execute(array($question['ID_QUEST']));
                        foreach($reponses as $reponse)
                        {
                            if($reponse['IS_TRUE']==0)
                            {?>
                                <div class="alert alert-success" role="alert">
                            <?php }
                            else
                            {?>
                                <div class="alert alert-danger" role="alert">
                            <?php } 
                                print ''. $reponse['INTITULE']; AddModif("INTITULE","reponse",$reponse['ID_REPONSE']);?>
                            </div>
                        <?php }
                        $i++;
                    } ?>
                    <br/>
                    <div class="text-center">
						<a class="btn btn-warning navbar-btn" type="button" href="AjoutQuestion.php?id=<?=$ID_THEME?>"> <h5>Ajouter une question</h5></a>
					</div>
                </div>
            <?php } ?>
            
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
		<?php require_once "../Includes/footer.php"; ?> 
    </body>
</html>