<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();
$ID_QUEST = $_GET['id'];
$nbReponses = $_GET['nbRep'];

if (!empty($_POST['INTITULE1']) || $nbReponses==2) 
{
    $stmt = getDb()->prepare("select MAX(ID_REPONSE) as max from reponse");
    $stmt->execute();
    $max_id=$stmt->fetch();
    $new_id=$max_id['max']+1;
    
    if($nbReponses==2)
    {
        $stmt = getDb()->prepare("insert into reponse values('$new_id', 'VRAI', 0, $ID_QUEST)");
        $stmt->execute();
        $new_id++;
        $stmt = getDb()->prepare("insert into reponse values('$new_id', 'FAUX', 1, $ID_QUEST)");
        $stmt->execute();
    }
    else
    {
        for($i=1; $i<=$nbReponses; $i++)
        {
            $intitule=$_POST['INTITULE'.$i];
            $is_true=$_POST['IS_TRUE'.$i];
            $stmt = getDb()->prepare("insert into reponse values('$new_id', '$intitule', '$is_true', '$ID_QUEST')");
            $stmt->execute();
            $new_id++;
        }
    }
    redirect("PageChoix.php");
}
?>
    

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <form method ="POST">   
                <fieldset ><legend class="text-center"> <h3>Ajout d'une question </h3></legend>
                <div class="text-center">
                    <hr/>
                    <h5>Réponses</h5>
                    <?php for($i=1; $i<=$nbReponses; $i++)
                    {?>
                        <hr/>
                        <div class="form-group">
                            <label for ="INTITULE<?=$i?>"> Rentrez l'intitulé de la proposition n°<?=$i?>: </label>
                            <input type="text" name="INTITULE<?=$i?>" size ="50"/> <br/>
                        </div>
                        Cette proposition est-elle juste?
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="IS_TRUE<?=$i?>" id="Oui" value="0">
                            <label class="form-check-label" for="Oui">Oui</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="IS_TRUE<?=$i?>" id="Non" value="1"checked>
                            <label class="form-check-label" for="Non">Non</label>
                        </div>
                    <?php } ?>
                    
                <br/><button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>