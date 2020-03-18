<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 

// Recuperer les infos sur l'utilisateur
$login=$_SESSION['login'];
$stmt = getDb()->query("select * from utilisateur where PSEUDO='$login'"); 
$profil=$stmt->fetch();

// Recuperer l'element à modifier
$modif = $_GET['modif'];

// Préparer l'affichage
if($modif=='PSEUDO')
{
    $affichage='login';
    $type='text';
}
else
{
    $affichage='mot de passe';
    $type='password';
}
?>


<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid"> <br/>
            <?php
            if(!empty($_POST['pastInfo']) and !empty($_POST['newInfo']) and! empty($_POST['confirmInfo']))
            {
                if($_POST['pastInfo']==$profil[$modif])
                {
                    if($_POST['newInfo']==$_POST['confirmInfo'])
                    {
                        $stmt = getDb()->prepare("update utilisateur set `" . $modif . "`=? where PSEUDO=?");
                        $stmt->execute(array($_POST['newInfo'], $login));
                        if($modif=='PSEUDO')
                        {
                            $_SESSION['login'] = $_POST['newInfo'];
                        }
                        redirect("Profil.php");
                    }
                    else
                    {?>
                        <div class="alert alert-danger" role="alert">
                            <img src="../Icons/svg/warning.svg" alt="warning">
                            La confirmation du <?= $affichage ?> ne correspond pas au nouveau <?= $affichage ?> rentré
                        </div>
                    <?php }
                }
                else
                {?>
                    <div class="alert alert-danger" role="alert">
                        <img src="../Icons/svg/warning.svg" alt="warning">
                        L'ancien <?= $affichage ?> renseigné n'est pas valide
                    </div>
                <?php }
                
            } ?>
            <form method ="POST">
            
            <fieldset ><legend class="text-center"> <h3> Modification du <?= $affichage ?></h3> </legend>
            <br/>
            <div class=text-center>
                <label for ="pastInfo"> Rentrez votre ancien <?= $affichage ?>: </label>
                <input type=<?=$type?> name="pastInfo" size ="17"/> <br/><br/>
                <label for ="newInfo"> Rentrez votre nouveau <?= $affichage ?>: </label>
                <input type=<?=$type?> name="newInfo" size="17"/> <br/>
                <label for ="confirmInfo"> Veuillez confirmer nouveau <?= $affichage ?>: </label>
                <input type=<?=$type?> name="confirmInfo" size="17"/><br/>
                <br/><button type="submit" class="btn btn-primary">Modifier</button>
            </div>
            </form>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>