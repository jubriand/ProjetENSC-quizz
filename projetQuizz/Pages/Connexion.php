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
    if ($stmt->rowCount() == 1) 
    {
        // Utilisateur reconnu
        $_SESSION['login'] = $login; //On retient son login
        redirect("PageChoix.php");
    }
}
?>
<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid text-center"> <br/> <!-- Si l'utilisateur n'est pas reconnu ou qu'une donnée manque on affiche message d'erreur-->
            <div class="alert alert-danger" role="alert">
                <img src="../Icons/svg/warning.svg" alt="warning">
                Utilisateur non reconnu.</br>
                Vous serez redirigé vers la page d'accueil dans 3 secondes.
            </div><br/>
            <script language="JavaScript">
                window.onload = function () 
                {
                    setTimeout(function(){ window.location.href = "PageChoix.php"}, 3000);
                };
            </script>
        </div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>
