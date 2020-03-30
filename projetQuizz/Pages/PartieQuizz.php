<?php
	ob_start();
	session_start();
	require_once "../Includes/functions.php";
	require_once "../Includes/head.php"; 
	
	//On récupère le thème joué
	$ID_THEME = $_SESSION['ID_THEME'];
	$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$theme = $stmt->fetch();


	//On cherche à savoir si c'est le début de la partie ou non
	if(isset($_GET['diff']))
	{
		//On supprime toutes les variables en session 
		RebootSession();

		$difficulte=$_GET['diff'];
		$_SESSION['diff']=$difficulte;
		$_SESSION['score']=0;
		$_SESSION['questionsPassees']=array();

		$time_start = microtime_float();
		$_SESSION['time_start']=$time_start;

		$time_stop = $theme['NB_QUESTIONS']*8 - 3*$difficulte;
		$_SESSION['time_stop']=$time_stop;
	}
	else
	{
		$difficulte=$_SESSION['diff'];
	}

	$time_left=TimeLeft();
	//On regarde si la partie est finie
	if(count($_SESSION['questionsPassees'])==$theme['NB_QUESTIONS'] 
	or $time_left<=0)
	{
		redirect("PartieQuizzResult.php");
	}

	//on regarde le nombre max de questions par theme
	$demande= getDb()->prepare("select count(ID_QUEST) as nbQuest from question where ID_THEME=? and ID_QUEST not in ( '" . implode( "', '" ,$_SESSION['questionsPassees'] ) . "' )");
	$demande->execute(array($theme['ID_THEME']));
	$row=$demande->fetch();
	$nbremax=$row['nbQuest'];

	//On récupère les questions liées à ce thème
	$questions = getDb()->prepare("select * from question where ID_THEME=? and ID_QUEST not in  ( '" . implode( "', '" ,$_SESSION['questionsPassees'] ) . "' )");
	$questions->execute(array($theme['ID_THEME']));

	//On tire au hasard un nombre 
	$RANDINT= random_int( 1, $nbremax);
	//on recupère la question choisie au hasard 	
	$i=1;
	foreach($questions as $question)
	{
		if($i==$RANDINT)
		{
			$ID_QUEST=$question['ID_QUEST'];
		}
		$i++;
	}

	

	//On garde en memoire l'ID de la question sélectionnée
	$_SESSION['questionsPassees'][]=$ID_QUEST;

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
			<br/>
			<div class="jumbotron">
				<h3 class="text-center timer"> <?=$time_left?> secondes restantes</h3><br/>
				<?php if($question['MEDIA']!=null)
				{
					?> <div class="row"> <?php
					if(substr($question['MEDIA'],-3)=="jpg" or substr($question['MEDIA'],-3)=="png"
					or substr($question['MEDIA'],-3)=="gif")
					{?>
						<div class="col-md-4 col-sm-6">
							<img class="img-fluid" src="../Images/<?= $question['MEDIA'] ?>" title="<?= $question['MEDIA'] ?>" />
						</div>
					<?php }
					else if(substr($question['MEDIA'],-3)=="avi" or substr($question['MEDIA'],-3)=="mp4"
					or substr($question['MEDIA'],-3)=="mov")
					{ ?>
						<div class="col-md-4 col-sm-6">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe src="../Images/<?= $question['MEDIA'] ?>" title="<?= $question['MEDIA'] ?>"></iframe>
							</div>
						</div>
					<?php }
				} ?>

					<div class="text-center <?php if($question['MEDIA']!=null) { ?> col-md-8 col-sm-6 <?php } ?>">
						<br/><h4 class="intitQuest mx-sm-2 mx-md-5"><?=$question['INTITULE']?></h4><br/><br/>
							
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
										<div class="col"> <p class="text-center"> <a href="PartieQuizzRep.php?id=<?= $positions[$i]['ID_REPONSE'] ?>&typeQuest=<?=$question["TYPE_QUEST"]?>" class="btn btn-primary btn-lg choiceBtn"> <?= $positions[$i]['INTITULE'] ?> </a> </p> </div>
									<?php }
									else 
									{ ?>
										<div class="col"> <p class="text-center"> <a href="PartieQuizzRep.php?id=<?= $reponse['ID_REPONSE'] ?>&typeQuest=<?=$question["TYPE_QUEST"]?>" class="btn btn-primary btn-lg choiceBtn"> <?= $reponse['INTITULE'] ?> </a> </p> </div>
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
				<?php if($question['MEDIA']!=null)
				{
					print"</div>";
				} ?>
			</div>
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>