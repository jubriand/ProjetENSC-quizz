<?php
	require_once "../Includes/functions.php";
	require_once "../Includes/head.php"; 
	session_start();
	
	$ID_THEME = $_SESSION['ID_THEME'];
	$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$theme = $stmt->fetch(); // Access first (and only) result line

	//on regarde le nombre max de question par theme //ne fonctionne pas 
	$demande= getDb()->prepare("select count(ID_QUEST) as nbQuest from question where ID_THEME=?");
	$demande->execute(array($theme['ID_THEME']));
	$row=$demande->fetch();
	$nbremax=$row['nbQuest'];
	echo "theme:".(int)$nbremax."cense etre la valeur max      ";

	//definir chiffre random 
	$RANDINT= rand( 1, $nbremax+1) ; //mettre nbremax � la place du 4
	echo "id de la question:".(int)$RANDINT;
	//on regarde le type de la question choisie au hasard 	
	$demande1 = getDb()->prepare('select TYPE_QUEST from question where ID_QUEST=?');
	$demande1->execute(array($RANDINT));
    $question = $demande1->fetch();
	

?>
<html>
	<body>
		<?php require_once "../Includes/header.php";
		
		if ($question["TYPE_QUEST"]==0)
		{
			QuestionVraiFaux($RANDINT); //est ce que le theme doit etre un argument � la fonction ? il faut tester
		
		}
		elseif ($question["TYPE_QUEST"]==1) 
		{
			QuestionOuverte($RANDINT);
		}
		elseif ($question["TYPE_QUEST"]==2) 
		{
			QuestionCM($RANDINT);
		}
		
		Reponse($RANDINT);
		
		require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>