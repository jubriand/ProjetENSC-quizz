<?php
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 
session_start();

$id=$_GET['id'];
$typeQuest=$_GET['typeQuest'];
if($typeQuest==1)
{
	$stmt = getDb()->prepare('select * from reponse where ID_QUEST=?');
	$stmt->execute(array($id));
	$reponse=$stmt->fetch();
	if($reponse['INTITULE']==$_POST['reponse'])
	{
		$reussite=true;
	}
	else
	{
	$reussite=false;
	}
}
else
{
	$stmt = getDb()->prepare('select * from reponse where ID_REPONSE=?');
	$stmt->execute(array($id));
	$reponse=$stmt->fetch();
	if($reponse['IS_TRUE']==0)
	{
		$reussite=true;
	}
	else
	{
		$reussite=false;
	}
} ?>

<html>
	<body>
		<?php require_once "../Includes/header.php"; ?>
		<div class="container-fluid">
			<div class="jumbotron col-xl-5 col-lg-6 col-md-7 col-sm-9 text-center">
				<?php if($reussite==true)
				{?>
					<h3>Bien joué! </h3>
				<?php }
				else
				{ ?>
					<h3>Raté... </h3>
				<?php } ?>
				<a href="PartieQuizz.php?id=<?= $positions[$i]['ID_REPONSE'] ?>&typeQuest=<?=$question["TYPE_QUEST"]?>" class="btn btn-primary btn-lg"> <?= $positions[$i]['INTITULE'] ?> </a> 
			</div>
		</div>

		
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>