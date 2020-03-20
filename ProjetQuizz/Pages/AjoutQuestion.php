<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();
$ID_THEME = $_GET['id'];

if (!empty($_POST['INTITULE']) and !empty($_POST['TYPE_QUEST'])) 
{
    $intitule=$_POST['INTITULE'];
    $type_quest=$_POST['TYPE_QUEST'];
    if(!empty($_POST['MEDIA']))
    {
        $media=$_POST['MEDIA'];
    }
    else
    {
        $media=null;
    }
    $stmt = getDb()->prepare("select MAX(ID_QUEST) as max from question");
    $stmt->execute();
    $max_id=$stmt->fetch();
    $new_id=$max_id['max']+1;

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
                <fieldset ><legend class="text-center"> <h3>Ajout d'une question </h3></legend>
                <div class="text-center">
                    <hr/>
                    <h5>Question</h5>
                    <hr/>
                    <div class="form-group">
                        <label for ="INTITULE"> Rentrez l'intitulé de la question: </label>
                        <input type="text" name="INTITULE" size ="50"/> <br/>
                    </div>
                    <div class="form-group">
                        <label for="TYPE_QUEST">Rentrez le type de question: </label>
                        <select class="form-control" name="TYPE_QUEST">
                            <option>Vrai/Faux</option>
                            <option value=1>Question Ouverte</option>
                            <option value=2>Question à choix multiple</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="MEDIA">Ajoutez une image/video si vous le souhaitez: </label>
                        <input type="file" class="form-control-file" accept="image/*,video/*" id="MEDIA">
                    </div>
                
                    <br/><button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
            </form>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>