<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();

if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
    $login = $_POST['login'];
	$password = $_POST['mdp'];
    $stmt = getDb()->prepare('select * from utilisateur where PSEUDO=? and MDP=?');
    $stmt->execute(array($login, $password));
    if ($stmt->rowCount() == 1) {
        // Authentication successful
        $_SESSION['login'] = $login;
        redirect("PageChoix.php");
    }
    else {
        $error = "Utilisateur non reconnu";
    }
}
?>

<html lang="fr">
	<body>
		<?php formUser('Inscription'); ?> 
		
		
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>