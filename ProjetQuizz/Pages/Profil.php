<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 



// Recuperer les infos sur l'utilisateur
$login=$_SESSION['login'];
$stmt = getDb()->query("select * from utilisateur where PSEUDO='$login'"); 
$profil=$stmt->fetch();
?>

<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid jumb">
            <div class="jumbotron col-xl-5 col-lg-6 col-md-7 col-sm-9 text-center">
            
                <h1> <span class="title">Profil</span> </h1> <br/><br/>
                <h4> Pseudo/Login: <?= $profil['PSEUDO'] ?> <?php AddModif("PSEUDO", "utilisateur", $login); ?></h4>
                <h4> Mot de passe: <?= $profil['MDP'] ?> <?php AddModif("MDP", "utilisateur", $login); ?> </h4>
                <h4> Administrateur: <?php if($profil['IS_ADMIN']==0){ print'OUI'; } else{ print'NON'; } ?></h4><br/>
                <h3> Score total: <?= $profil['SCORE_TOTAL'] ?></h4>

                </br></br><?php AddSupp('Compte'); ?>

            </div>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>