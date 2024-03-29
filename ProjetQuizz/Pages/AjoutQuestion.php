<?php
ob_start();
session_start();
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
$ID_THEME = $_SESSION['ID_THEME'];

?>

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <div class="jumbotron">
                <?php if (!empty($_POST['INTITULE']) and isset($_POST['TYPE_QUEST']))
                {
                    if(!empty($_FILES['MEDIA']['name'])) //Ajoute un media au répertoire si l'utilisateur l'a sélectionné
                    {
                        $message=AddMedia('MEDIA');
                        if($message!="Ok") //Affiche message d'erreur si l'ajout n'a pas pu être possible
                        { ?>
                            <div class="alert alert-danger" role="alert">
                                <img src="../Icons/svg/warning.svg" alt="warning">
                                <?=$message?>
                            </div>
                        <?php
                        }
                    }

                    if(empty($_FILES['MEDIA']['name']) or $message=="Ok") //Si pas d'erreurs on ajoute la question en BDD
                    {
                        $intitule=escape($_POST['INTITULE']);
                        $type_quest=$_POST['TYPE_QUEST'];
                        $media=escape($_FILES['MEDIA']['name']);

                        $new_id=RecupNewId('question');

                        $stmt = getDb()->prepare("insert into question values('$new_id', '$intitule', '$type_quest', '$media', '$ID_THEME')");
                        $stmt->execute();

                        //On déduit du type de la question le nombre de réponses devant être affichées
                        if($type_quest==0)
                        {
                            $nbReponses=2;
                        }
                        else if($type_quest==1)
                        {
                            $nbReponses=1;
                        }
                        else if($type_quest==2)
                        {
                            $nbReponses=6;
                        }
                        //On redirige sur l'ajout des réponses associées à la question en indiquant le nombre de réponses à rentrer
                        redirect("AjoutReponses.php?id=$new_id&nbRep=$nbReponses");
                    }          
                } ?>

                <form method ="POST" enctype="multipart/form-data">   
                    <fieldset><legend class="text-center"> <h3> <span class="title">Ajout d'une question</span></h3></legend>
                        <hr/>
                        <h5 class="text-center">Question</h5>
                        <hr/>
                            <br/>
                            <div class="form-group">
                                <label for ="INTITULE"> Rentrez l'intitulé de la question: </label>
                                <input type="text" name="INTITULE" size ="50"/> <br/><br/>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-8">
                                    <label for="TYPE_QUEST">Rentrez le type de question: </label>
                                    <select class="form-control col-lg-6 col-md-9 col-sm-10" name="TYPE_QUEST">
                                        <option value="0">Vrai/Faux</option>
                                        <option value="1">Question Ouverte</option>
                                        <option value="2">Question à choix multiple</option>
                                    </select>
                                </div>
                                <br/>
                                <div class="form-group col-md-6 col-sm-8">
                                    <label for="MEDIA">Ajoutez une image/video si vous le souhaitez: (formats acceptés: .jpg, .png, .gif, .mp4, .avi, .mov)</label>
                                    <input type="file" class="form-control-file" accept=".jpg, .png, .gif, .mp4, .avi, .mov" name="MEDIA" id="MEDIA">
                                </div>
                            </div>
                            <br/><p class="text-center"><button type="submit" class="btn btn-primary">Ajouter</button></p>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>