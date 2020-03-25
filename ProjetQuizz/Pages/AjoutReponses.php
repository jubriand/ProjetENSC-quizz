<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();
$ID_QUEST = $_GET['id'];
$nbReponses = $_GET['nbRep'];

if (!empty($_POST['INTITULE1'])) 
{
    $new_id=RecupNewId('REPONSE');
    
    for($i=1; $i<=$nbReponses; $i++)
    {
        $intitule=$_POST['INTITULE'.$i];
        $is_true=$_POST['IS_TRUE'.$i];
        $stmt = getDb()->prepare("insert into reponse values('$new_id', '$intitule', '$is_true', '$ID_QUEST')");
        $stmt->execute();
        $new_id++;
    }
    
    if($_SESSION['new_theme']>1)
    {
        $_SESSION['new_theme']--;
        redirect("AjoutQuestion.php");
    }
    else
    {
        redirect("SelectionTheme.php");
    }
}
?>
    

<html lang="fr">
	<body>
        <div class="container-fluid"> <br/>
            <form method ="POST">   
                <fieldset><legend class="text-center"> <h3>Ajout d'une question</h3></legend>
                    <div class="text-center">
                        <hr/>
                        <h5>Réponses</h5>
                        <?php for($i=1; $i<=$nbReponses; $i++)
                        {?>
                            <hr/>
                            <div class="form-group">
                                <label for ="INTITULE<?=$i?>"> Rentrez l'intitulé de la proposition n°<?=$i?>: </label>
                                <?php if($i==1 && $nbReponses==2)
                                { ?>
                                    <input type="text" readonly class="form-control-plaintext text-center" name="INTITULE<?=$i?>" size ="50" value="Vrai"/> <br/>
                                <?php }
                                else if($i==2 && $nbReponses==2)
                                { ?>
                                    <input type="text" readonly class="form-control-plaintext text-center" name="INTITULE<?=$i?>" size ="50" value="Faux"/> <br/>
                                <?php }
                                else
                                { ?>
                                    <input type="text" name="INTITULE<?=$i?>" size ="50"/> <br/>
                                <?php } ?>
                                
                            </div>
                            Cette proposition est-elle juste?
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="IS_TRUE<?=$i?>" id="Oui" value="0"
                                <?php if($nbReponses==1){?> checked <?php }?> >
                                <label class="form-check-label" for="Oui">Oui</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="IS_TRUE<?=$i?>" id="Non" value="1" 
                                <?php if($nbReponses==1){?> disabled <?php } else{?> checked <?php }?>>
                                <label class="form-check-label" for="Non">Non</label>
                            </div>
                        <?php } ?>
                        
                        <br/><button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>