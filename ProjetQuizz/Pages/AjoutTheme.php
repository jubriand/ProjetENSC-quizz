<?php
ob_start();
session_start();
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
?>

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>

            <?php if (!empty($_POST['NOM_THEME']) and !empty($_POST['NB_QUESTIONS']) and !empty($_POST['DESC_THEME']) and !empty($_FILES['MEDIA']["name"])) 
            {
                if($_POST['NB_QUESTIONS']>=10)
                {
                    $message=AddMedia();
                    if($message!="Ok")
                    { ?>
                        <div class="alert alert-danger" role="alert">
                            <img src="../Icons/svg/warning.svg" alt="warning">
                            <?=$message?>
                        </div>
                    <?php }
                    else
                    {
                        $NOM_THEME=escape($_POST['NOM_THEME']);
                        $NB_QUESTIONS=escape($_POST['NB_QUESTIONS']);
                        $DESC_THEME=escape($_POST['DESC_THEME']);
                        $MEDIA=escape($_FILES['MEDIA']["name"]);
    
                        $new_id=RecupNewId('theme');
    
                        $stmt = getDb()->prepare("insert into theme values('$new_id', '$NOM_THEME', '$NB_QUESTIONS','$DESC_THEME', '$MEDIA', 0)");
                        $stmt->execute();
                        
                        $_SESSION['new_theme']=$NB_QUESTIONS;
                        $_SESSION['ID_THEME']=$new_id;
                        redirect("AjoutQuestion.php");
                    }    
                }                
            } ?>

            <form method ="POST" enctype="multipart/form-data">   
                <fieldset ><legend class="text-center"> <h3><span class="title">Ajout d'un thème</span></h3></legend>
                    <br/>
                    <div class="form-group">
                        <label for ="NOM_THEME"> Rentrez le nom du thème: </label>
                        <input type="text" name="NOM_THEME" size ="50"/> <br/>
                    </div>
                    <div class="form_group">
                        <label for="NB_QUESTIONS">Rentrez le nombre de questions affichés lors d'une partie: (minimum 10)</label>
                        <input type="text" name="NB_QUESTIONS" size ="5" value="10"/> <br/>
                    </div><br/>
                    <div class="form_group">
                        <textarea name="DESC_THEME" rows="3" cols="100" placeholder="Rentrez une description du thème"></textarea><br/><br/>
                    </div>
                    <div class="form-group">
                        <label for="MEDIA">Ajoutez une image représentant le thème: </label>
                        <input type="file" class="form-control-file" accept="image/*" name="MEDIA" id="MEDIA">
                    </div>

                    </br><p class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AjoutTheme"> Ajouter</button></p>
                </fieldset>
                <!-- Modal -->
                <div class="modal fade" id="AjoutTheme" tabindex="-1" role="dialog" aria-labelledby="AjoutThemeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AjoutThemeLabel">Avertissement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Une fois ce thème créé vous devrez y ajouter le nombre de question que vous avez défini. Tant que cela ne sera pas fait le thème ne sera pas jouable.
                                Voulez-vous poursuivre la création de ce thème?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                <button type="submit" class="btn btn-primary">Oui</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>