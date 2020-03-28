<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();
$ID_THEME = $_SESSION['ID_THEME'];

if (!empty($_POST['INTITULE']) and !empty($_POST['TYPE_QUEST'])) 
{
    $intitule=$_POST['INTITULE'];
    $type_quest=$_POST['TYPE_QUEST'];
    $media=$_POST['MEDIA'];
    $new_id=RecupNewId('QUESTION');

    $stmt = getDb()->prepare("insert into question values('$new_id', '$intitule', '$type_quest', '$media', '$ID_THEME')");
    $stmt->execute();


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
    redirect("AjoutReponses.php?id=$new_id&nbRep=$nbReponses");
} 
?>

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <form method ="POST">   
                <fieldset><legend class="text-center"> <h3>Ajout d'une question</h3></legend>
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
                                    <option>Vrai/Faux</option>
                                    <option value=1>Question Ouverte</option>
                                    <option value=2>Question à choix multiple</option>
                                </select>
                            </div>
                            <br/>
                            <div class="form-group col-md-6 col-sm-8">
                                <label for="MEDIA">Ajoutez une image/video si vous le souhaitez: (formats acceptés: .jpg, .png, .gif, .mp4, .avi, .mov)</label>
                                <input type="file" class="form-control-file" accept=".jpg, .png, .gif, .mp4, .avi, .mov" name="MEDIA">
                            </div>
                        </div>
                        <br/><p class="text-center"><button type="submit" class="btn btn-primary">Ajouter</button></p>
                </fieldset>
            </form>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>