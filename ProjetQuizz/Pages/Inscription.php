<?php
require_once "../Includes/head.php";
require_once "../Includes/functions.php";
session_start();

if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
    $login = $_POST['login'];
    $password = $_POST['mdp'];
    $is_admin=$_POST['admin'];
    if ($is_admin=='on')
    {
        $is_admin=1;
    }
    else
    {
        $is_admin=0;
    }

    $stmt = getDb()->prepare("insert into utilisateur(PSEUDO, MDP, IS_ADMIN) values($login, $password, $is_admin)");
    $stmt->execute();
    redirect("PageChoix.php");
}
?>

<html lang="fr">
	<body>
		<?php formUser('Inscription'); ?> 
		
		
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>