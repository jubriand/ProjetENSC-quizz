<?php
ob_start();
session_start();
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
    $login = escape($_POST['login']);
    $mdp = escape($_POST['mdp']);
    $is_admin=$_POST['admin'];
    if ($is_admin=='on')
    {
        $is_admin=0;
    }
    else
    {
        $is_admin=1;
    }

    $stmt = getDb()->prepare("insert into utilisateur(PSEUDO, MDP, IS_ADMIN) values('$login', '$mdp', $is_admin)");
    $stmt->execute();
    $_SESSION['login'] = $login; //On retient son login
    redirect("PageChoix.php?showTuto=true");
}
?>
<html lang="fr">
	<body>
        <?php require_once "../Includes/header.php" ;?>
        <div class="container-fluid text-center"> <br/> <!-- Si une donnée manque on affiche message d'erreur-->
            <div class="alert alert-danger" role="alert">
                <img src="../Icons/svg/warning.svg" alt="warning">
                Une erreur est survenue lors de votre inscription.</br>
                Vous serez redirigé vers la page d'accueil dans 3 secondes.
            </div><br/>
            <script language="JavaScript">
                window.onload = function () 
                {
                    setTimeout(function(){ window.location.href = "PageChoix.php"}, 3000);
                };
            </script>
        </div>
        <?php require_once "../Includes/scripts.php"; ?> 
		<?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>


