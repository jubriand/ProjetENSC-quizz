<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();

if (!empty($_POST['NOM_THEME']) and !empty($_POST['NB_QUESTIONS']) and !empty($_POST['TIMER_MIN']) and !empty($_POST['DESC_THEME'])) 
{
    $NOM_THEME=$_POST['NOM_THEME'];
    $NB_QUESTIONS=$_POST['NB_QUESTIONS'];
    $TIMER=60*$_POST['TIMER_MIN']+$_POST['TIMER_SEC'];
    $DESC_THEME=$_POST['DESC_THEME'];
    $MEDIA=$_POST['MEDIA'];

    $new_id=RecupNewId('THEME');

    $stmt = getDb()->prepare("insert into theme values('$new_id', '$NOM_THEME', '$NB_QUESTIONS', '$TIMER','$DESC_THEME', '$MEDIA', 0)");
    $stmt->execute();
    
    $_SESSION['new_theme']=$NB_QUESTIONS;
    $_SESSION['ID_THEME']=$new_id;
    redirect("AjoutQuestion.php");
} 
?>

<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid"> <br/>
            <form method ="POST">   
                <fieldset ><legend class="text-center"> <h3>Ajout d'un thème</h3></legend>
                    <br/>
                    <div class="form-group">
                        <label for ="NOM_THEME"> Rentrez le nom du thème: </label>
                        <input type="text" name="NOM_THEME" size ="50"/> <br/>
                    </div>
                    <div class="form_group">
                        <label for="NB_QUESTIONS">Rentrez le nombre de questions affichés lors d'une partie: </label>
                        <input type="text" name="NB_QUESTIONS" size ="5" value="10"/> <br/>
                    </div>
                    <div class="form-group">
                        <label for="TIMER_MIN">Rentrez le temps d'une partie: </label>
                        <input type="text" name="TIMER_MIN" size ="5"/> minutes et 
                        <input type="text" name="TIMER_SEC" size ="5"/> secondes<br/><br/>
                    </div>
                    <div class="form_group">
                        <textarea name="DESC_THEME" rows="3" cols="100" placeholder="Rentrez une description du thème"></textarea><br/><br/>
                    </div>
                    <div class="form-group">
                        <label for="MEDIA">Ajoutez une image représentant le thème: </label>
                        <input type="file" class="form-control-file" accept="image/*" name="MEDIA">
                    </div>

                    </br><p class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AjoutTheme"> Ajouter</button></p>
                </fieldset>
            </form>
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
                            Une fois ce thème créé vous devrez y ajouter au moins 10 questions. Tant que cela ne sera pas fait le thème ne sera pas jouable.
                            Voulez-vous poursuivre la création de ce thème?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>