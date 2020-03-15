<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 



// Recuperer tous les themes
$login=$_SESSION['login'];
$stmt = getDb()->query("select * from utilisateur where PSEUDO='$login'"); 
$profil=$stmt->fetch();
?>

<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid">
            <br/><div class="jumbotron col-md-5 col-sm-7 text-center">
                <h1> Profil </h1> <br/><br/>
                <h4> Pseudo/Login: <?= $profil['PSEUDO'] ?> <a class="btn btn-secondary navbar-btn" type="button" href="ModifProfil.php?modif=PSEUDO"><span class="glyphicon glyphicon-pencil"></span>Modifier</a> </h4>
                <h4> Mot de passe: <?= $profil['MDP'] ?></h4>
                <h4> Administrateur: <?php if($profil['IS_ADMIN']==0){ print'OUI'; } else{ print'NON'; } ?></h4><br/>
                <h3> Score total: <?= $profil['SCORE_TOTAL'] ?></h4>

            </div>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>