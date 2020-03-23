<?php
	require_once "../Includes/functions.php";
	require_once "../Includes/head.php"; 
	session_start();
	
	$difficulte=$_GET['diff'];

	$ID_THEME = $_SESSION['ID_THEME'];
	$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$theme = $stmt->fetch(); // Access first (and only) result line

	//on regarde le nombre max de question par theme //ne fonctionne pas 
	$demande= getDb()->prepare("select count(ID_QUEST) as nbQuest from question where ID_THEME=?");
	$demande->execute(array($theme['ID_THEME']));
	$row=$demande->fetch();
	$nbremax=$row['nbQuest'];

	//definir chiffre random 
	$RANDINT= random_int( 1, $nbremax) ; 

	//on recupère la question choisie au hasard 	
	$questions = getDb()->prepare('select * from question where ID_THEME=?');
	$questions->execute(array($theme['ID_THEME']));
	$i=1;
	foreach($questions as $question)
	{
		if($i==$RANDINT)
		{
			$ID_QUEST=$question['ID_QUEST'];
		}
		$i++;
	}

	//on recupère la question choisie au hasard 	
	$demande2 = getDb()->prepare('select * from question where ID_QUEST=?');
	$demande2->execute(array($ID_QUEST));
	$question = $demande2->fetch();
	
	if($question["TYPE_QUEST"]==2) //cas d'une question CM
	{
		//on recupère la réponse juste réponses liées à cette question
		$demande3 = getDb()->prepare('select * from reponse where ID_QUEST=? and IS_TRUE=0');
		$demande3->execute(array($ID_QUEST));
		$reponseJuste = $demande3->fetch();

		//On définit la position de la réponse juste
		$RANDINT= random_int( 0, ($difficulte+2));

		//On créee un tableau qui va récupérer les positions des différentes propositions
		$positions=array($RANDINT=>$reponseJuste);

		//on recupère les réponses fausses réponses liées à cette question
		$reponsesFausses = getDb()->prepare('select * from reponse where ID_QUEST=? and IS_TRUE=1');
		$reponsesFausses->execute(array($ID_QUEST));

		//on attribue des positions aux réponses fausses
		$i=0;
		foreach($reponsesFausses as $reponseFausse)
		{	
			if($i<($difficulte+2))
			{
				do
				{
					$RANDINT= random_int( 0, ($difficulte+2));
				} while(array_key_exists($RANDINT,$positions));
				$positions[$RANDINT]=$reponseFausse;
				$i++;
			}
		}
	}

	$reponses = getDb()->prepare('select * from reponse where ID_QUEST=?');
	$reponses->execute(array($ID_QUEST));
	

?>
<html>
	<body>
		<?php require_once "../Includes/header.php";?>
		<div class="container-fluid">
			<?php
			/*
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
			*/
			?>
			
			<?php if($question['MEDIA']!=null)
			{?>
				<div class="col-md-4 col-sm-6">
                    <img class="img-fluid" src="../Images/<?= $question['MEDIA'] ?>" title="<?= $question['MEDIA'] ?>" />
                </div>
			<?php }?>

			<div class="text-center <?php if($question['MEDIA']!=null) { ?> col-md-8 col-sm-6 <?php } ?>">
				<br/><h4><?=$question['INTITULE']?></h4><br/>
					
				<?php if ($question["TYPE_QUEST"]==1)
				{ ?>
					<form method ="POST" action="PartieQuizzRep.php?id=<?=$ID_QUEST?>&typeQuest=<?=$question["TYPE_QUEST"]?>"> 
						<fieldset ><legend class="text-center"action="PartieQuizzRep.php"> </legend>
						<div class="text-center">
							<div class="m-auto">
								<input type="text" name="reponse" size ="50"/> <br/>
							</div>
						</div>
						</fieldset>
						<br/>
						<p class="text-center"><button type="submit" class="btn btn-primary">Valider</button> </p>
					</form>	
				<?php }
				else
				{
					$i=0;
					foreach ($reponses as $reponse) 
					{ 
						if($i<(3+$difficulte))
						{
							if($i%3==0)
							{
								print "<div class='row'>";
							}
							if($question["TYPE_QUEST"]==2)
							{ ?>
								<div class="col"> <p class="text-center"> <a href="PartieQuizzRep.php?id=<?= $positions[$i]['ID_REPONSE'] ?>&typeQuest=<?=$question["TYPE_QUEST"]?>" class="btn btn-primary btn-lg"> <?= $positions[$i]['INTITULE'] ?> </a> </p> </div>
							<?php }
							else 
							{ ?>
								<div class="col"> <p class="text-center"> <a href="PartieQuizzRep.php?id=<?= $reponse['ID_REPONSE'] ?>&typeQuest=<?=$question["TYPE_QUEST"]?>" class="btn btn-primary btn-lg"> <?= $reponse['INTITULE'] ?> </a> </p> </div>
							<?php }
							$i++;  
							if($i%3==0)
							{
								print "</div></br>";
							}
						}
					}
				}?>
			</div>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>