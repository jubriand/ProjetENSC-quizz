<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 

// Recuperer les infos sur la modification
$modif = $_GET['modif'];
$table = $_GET['table'];
$id = $_GET['id'];

// Préparer la récupération de la BDD
if($table=='utilisateur')
{
    $primKey='PSEUDO';
    $origine="Profil.php"; //Permet de retourner sur la page d'origine
}
else
{
    $origine="SelectionTheme.php"; //Permet de retourner sur la page d'origine
    if($table=='theme')
    {
        $primKey='ID_THEME';
    }
    elseif($table=='question')
    {
        $primKey='ID_QUEST';
    }
    elseif($table=='reponse')
    {
        $primKey='ID_REPONSE';
    }
}


$stmt = getDb()->prepare("select * from `" . $table . "` where `" . $primKey. "`='$id'"); 
$stmt->execute();
$infoBDD=$stmt->fetch();
?>


<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <div class="jumbotron">
                <?php
                if(!empty($_POST['pastInfo']) and !empty($_POST['newInfo']) and !empty($_POST['confirmInfo']))
                {
                    if($_POST['pastInfo']==$infoBDD[$modif]) 
                    {
                        if($_POST['newInfo']==$_POST['confirmInfo'])
                        {
                            //Les véérification sont bien remplies on fait la modif
                            $newInfo=escape($_POST['newInfo']);
                            $stmt = getDb()->prepare("update `" . $table . "` set `" . $modif . "`=? where `" . $primKey. "`=?");
                            $stmt->execute(array($newInfo, $id));
                            if($modif=='PSEUDO') //Si l'élément modifier est le login on met à jour la session
                            {
                                $_SESSION['login'] = $_POST['newInfo'];
                            }
                            redirect($origine); //On netourne sur la page d'origine
                        }
                        //Si les vérifications n'ont pas été remplies on affiche le message d'erreur adapté
                        else
                        {?>
                            <div class="alert alert-danger" role="alert">
                                <img src="../Icons/svg/warning.svg" alt="warning">
                                La confirmation ne correspond pas au nouvel élément rentré
                            </div>
                        <?php }
                    }
                    else
                    {?>
                        <div class="alert alert-danger" role="alert">
                            <img src="../Icons/svg/warning.svg" alt="warning">
                            L'ancien élément renseigné n'est pas valide
                        </div>
                    <?php }
                    
                } ?>
                <form method ="POST">
                
                <fieldset ><legend class="text-center"> <h3> <span class="title">Modification d'un élément </span></h3> </legend>
                <br/>
                <div class=text-center>
                    <label for ="pastInfo"> Rentrez l'ancien élément: </label>
                    <?php if($table!="utilisateur")
                    { ?>
                        <input type="text" name="pastInfo" value="<?=$infoBDD[$modif]?>" size ="30"/> <br/><br/>
                    <?php }
                    else
                    {?>
                        <input type="text" name="pastInfo" size ="30"/> <br/><br/>
                    <?php } ?>
                    <label for ="newInfo"> Rentrez le nouvel élément: </label>
                    <input type="text" name="newInfo" size="30"/> <br/>
                    <label for ="confirmInfo"> Veuillez confirmer le nouvel élément: </label>
                    <input type="text" name="confirmInfo" size="30"/><br/>
                    <br/><button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                </form>
            </div>
		</div>
        <?php require_once "../Includes/scripts.php"; ?> 
		<?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>