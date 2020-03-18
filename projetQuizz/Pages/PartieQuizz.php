<?php
	require_once "../Includes/functions.php";
	require_once "../Includes/head.php"; 
	require_once "../Includes/header.php";
	session_start();
	
	$ID_THEME = $_GET['id'];
	$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$theme = $stmt->fetch(); // Access first (and only) result line

	//on regarde le nombre max de question par theme 
	$NBRE_MAX = $_GET['id'];
	$stmt = getDb()->prepare('select COUNT(*) from question where ID_THEME=?');
	$stmt->execute(array($NBRE_MAX));
	$nbremax = $stmt->fetch();
	//definir chiffre random 
	$RANDINT=rand(1,$nbremax)

	//on regarde le type de la question choisie au hasard 
	$TYPE_QUEST = $_GET['id'];
	$stmt = getDb()->prepare('select TYPE_QUEST from question where ID_QUEST=$RANDINT');
	$stmt->execute(array($TYPE_QUEST));
	$question = $stmt->fetch(); // Access first (and only) result line
    
	if ($question==0)
	{
		QuestionVraiFaux($ID_THEME);
	}
	elseif ($question==1) 
	{
		QuestionOuverte($ID_THEME);
    }
	//elseif ($question==2) 
	{
		QuestionCM($ID_THEME);
    }

	

?>
<html>
	<body>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>