<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 



// Recuperer les infos sur l'utilisateur
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
                <h4> Pseudo/Login: <?= $profil['PSEUDO'] ?> <?php AddModif("PSEUDO", "UTILISATEUR", $login); ?></h4>
                <h4> Mot de passe: <?= $profil['MDP'] ?> <?php AddModif("MDP", "UTILISATEUR", $login); ?> </h4>
                <h4> Administrateur: <?php if($profil['IS_ADMIN']==0){ print'OUI'; } else{ print'NON'; } ?></h4><br/>
                <h3> Score total: <?= $profil['SCORE_TOTAL'] ?></h4>

                </br></br><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#SuppCompte">
                <h6>Supprimer le compte</h6>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="SuppCompte" tabindex="-1" role="dialog" aria-labelledby="SuppCompteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SuppCompteLabel"><img src="../Icons/svg/warning.svg" alt="warning"> Attention!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous bien sûr de vouloir supprimer définitivement ce compte?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <a type="button" class="btn btn-primary" href="SuppCompte.php">Oui</a>
                        </div>
                    </div>
                </div>
                </div>

            </div>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>