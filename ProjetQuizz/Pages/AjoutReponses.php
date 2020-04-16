<?php
ob_start();
session_start();
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
$ID_QUEST = $_GET['id'];
$nbReponses = $_GET['nbRep'];
?>

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <div class="jumbotron">
                <?php if (!empty($_POST['INTITULE1'])) 
                {
                    $new_id=RecupNewId('reponse');
                    
                    //Variables permettant de vérifier que toutes les propositions sont rentrées et qu'une seule est juste
                    $emptyIntitule=false;
                    $countTrue=0;
                    for($i=1; $i<=$nbReponses; $i++) 
                    {
                        $intitule=escape($_POST['INTITULE'.$i]);
                        if($intitule==null)
                        {
                            $emptyIntitule=true; //Si au moins un intitulé est vide on le signale
                        }
                        $is_true=$_POST['IS_TRUE'.$i];
                        if($is_true==0)
                        {
                            $countTrue++; //On compte le nombre de propositions juste
                        }
                    }
                    if($emptyIntitule==false and $countTrue==1) //Si la vérification est bonne
                    {
                        for($i=1; $i<=$nbReponses; $i++) //On ajoute en BDD toutes les réponses rentrées par l'utilisateur
                        {
                            $intitule=escape($_POST['INTITULE'.$i]);
                            $is_true=$_POST['IS_TRUE'.$i];
                            $stmt = getDb()->prepare("insert into reponse values('$new_id', '$intitule', '$is_true', '$ID_QUEST')");
                            $stmt->execute();
                            $new_id++;
                        }
                        
                        if($_SESSION['new_theme']>1) //Si on est dans le cas de la création d'un nouveau thème...
                        {
                            $_SESSION['new_theme']--;//...On indique qu'on à ajouter une question...
                            redirect("AjoutQuestion.php");//...et on retourne sur l'ajout de questionS
                        }
                        else //Si il s'agit d'un thème existant on retourne sur la page du thème
                        {
                            redirect("SelectionTheme.php");
                        }
                    }
                    //Sinon on affiche le message d'erreur correspondant
                    else if($emptyIntitule==true)
                    {?>
                        <div class="alert alert-danger" role="alert">
                            <img src="../Icons/svg/warning.svg" alt="warning">
                            Veuillez renseigner les intitulés de l'ensemble des propositions
                        </div>
                    <?php }
                    else if($countTrue!=1)
                    {?>
                        <div class="alert alert-danger" role="alert">
                            <img src="../Icons/svg/warning.svg" alt="warning">
                            Veuillez ne rentrer qu'une seule proposition juste
                        </div>
                    <?php }
                    
                }
                ?> 

                <form method ="POST">   
                    <fieldset><legend class="text-center"> <h3><span class="title">Ajout d'une question</span></h3></legend>
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
            <br/><br/>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>