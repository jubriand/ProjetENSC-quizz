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
	$demande = getDb()->prepare('select COUNT(*) from question where ID_THEME=?');
	$demande->execute(array($ID_THEME));
    $nbremax = $demande->fetch();
	echo "theme:".(int)$nbremax."cense etre la valeur max      ";

	//definir chiffre random 
	$RANDINT= rand( 1, 4) ;
	echo "id de la question:".(int)$RANDINT;
	//on regarde le type de la question choisie au hasard 	
	$demande1 = getDb()->prepare('select TYPE_QUEST from question where ID_QUEST=?');
	$demande1->execute(array($RANDINT));
    $question = $demande1->fetch();

	if ($question["TYPE_QUEST"]==0)
	{
		QuestionVraiFaux($RANDINT); //est ce que le theme doit etre un argument à la fonction ? il faut tester
	}
	elseif ($question["TYPE_QUEST"]==1) 
	{
		QuestionOuverte($RANDINT);
    }
	elseif ($question["TYPE_QUEST"]==2) 
	{
		QuestionCM($RANDINT);
    }

	

?>
<html>
	<body>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>