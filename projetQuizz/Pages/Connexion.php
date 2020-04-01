<?php
ob_start();
session_start();
require_once "../Includes/head.php";
require_once "../Includes/functions.php";

if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
    $login = $_POST['login'];
	$mdp = $_POST['mdp'];
    $stmt = getDb()->prepare('select * from utilisateur where PSEUDO=? and MDP=?');
    $stmt->execute(array($login, $mdp));
    if ($stmt->rowCount() == 1) {
        // Authentication successful
        $_SESSION['login'] = $login;
        $_SESSION['mode']="joueur";
        redirect("PageChoix.php");
    }
    else {
        $error = "Utilisateur non reconnu";
    }
}
?>

<html lang="fr">
	<body>
        <?php formUser('Connexion'); ?> 
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>