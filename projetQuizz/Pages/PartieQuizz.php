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
		//Si c'est le cas
		RebootSession(); //On réinitialise les variables de session (cas où on rejoue sans passer par l'accueil)

		//On définit les différent paramètres de partie et on les met en session
		$difficulte=$_GET['diff'];
		$_SESSION['diff']=$difficulte;
		$_SESSION['score']=0; //Compte le nombre de questions reussies
		$_SESSION['questionsPassees']=array(); //Garde en mémoire les ID des questions passées

		$time_start = microtime_float();
		$_SESSION['time_start']=$time_start; //Permettra de calculer le nombre de secondes passées pour calculer le score final

		$time_stop = ($theme['NB_QUESTIONS']*8 - 3*$difficulte)*1000;
		$_SESSION['time_stop']=$time_stop; //Définit le temps du chrono (en ms)
	}
	else
	{
		//Sinon on récupère les variables en session
		$difficulte=$_SESSION['diff'];
		$time_stop=$_SESSION['time_stop'];
	}?>

	<script language="JavaScript"> //script du chrono
		function startTimer(duration, display) {
			var start = Date.now(),
			diff= duration - ((Date.now() - start) | 0),
			minutes,
			seconds,
			milSeconds;
			function timer() 
			{
				diff = duration - ((Date.now() - start) | 0); //On compte le nombre de ms restantes
				localStorage.setItem("time",diff); //On met ce nombre en mémoire (permet de reprendre le timer après un changement de page)

				// On convertit ce nombre en min:s:ms
				minutes = (diff / 60000) | 0;
				seconds = ((diff % 60000) / 1000) | 0;
				milSeconds = ((diff % 60000) % 1000) | 0;

				minutes = minutes < 10 ? "0" + minutes : minutes;
				seconds = seconds < 10 ? "0" + seconds : seconds;
				milSeconds = milSeconds < 10 ? "0" + milSeconds : milSeconds;

				display.textContent = minutes + ":" + seconds + ":" + milSeconds; 

				if (diff <= 0) //Permet de finir le quizz si le temps est écoulé
				{
					window.location.href = "PartieQuizzResult.php";
				}
			};
			setInterval(timer, 1); //On appelle la fonction timer toutes les ms
		}
		window.onload = function () 
		{
			//A l'arrivée sur la page on récupère la valeur du chrono
			if (localStorage.getItem("time") == null) 
            {
                startCountdown=<?=$time_stop?>;
                localStorage.setItem("time",startCountdown);
            }
            else
            {
                startCountdown=localStorage.getItem("time");
            }
			//On le lance et on l'affiche sur la page
			var timeStop = startCountdown,
				display = document.querySelector('#time');
			startTimer(timeStop, display);
		};
	</script>

	<?php if(count($_SESSION['questionsPassees'])==$theme['NB_QUESTIONS']) //Redirige sur les résultats si toutes les questions sont passées
	{
		redirect("PartieQuizzResult.php");
	}

	//on recupère le nombre de questions n'étant pas déjà passées en BDD pour ce thème
	$demande= getDb()->prepare("select count(ID_QUEST) as nbQuest from question where ID_THEME=? and ID_QUEST not in ( '" . implode( "', '" ,$_SESSION['questionsPassees'] ) . "' )");
	$demande->execute(array($theme['ID_THEME']));
	$row=$demande->fetch();
	$nbremax=$row['nbQuest'];

	//On récupère les questions liées à ce thème n'étant pas déjà passées
	$questions = getDb()->prepare("select * from question where ID_THEME=? and ID_QUEST not in  ( '" . implode( "', '" ,$_SESSION['questionsPassees'] ) . "' )");
	$questions->execute(array($theme['ID_THEME']));

	//On récupère une question n'étant pas passée au hasard
	$RANDINT= random_int( 1, $nbremax);	
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

	//on recupère les infos liées à la question choisie au hasard 	
	$demande2 = getDb()->prepare('select * from question where ID_QUEST=?');
	$demande2->execute(array($ID_QUEST));
	$question = $demande2->fetch();
	
	if($question["TYPE_QUEST"]==2) //cas d'une question CM (On affiche la réponse juste et 3 à 5 propositions fausses dans un ordre aléatoire)
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

		//on attribue des positions aléatoires aux réponses fausses
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

	//On récupère les infos liées aux réponses de la question sélectionnée
	$reponses = getDb()->prepare('select * from reponse where ID_QUEST=?');
	$reponses->execute(array($ID_QUEST));
	

?>
<html>
	<body>
		<?php require_once "../Includes/header.php";?>
		<div class="container-fluid">
			<br/>
			<div class="jumbotron">
				<h3 class="text-center"><span class="title"><?=$theme['NOM_THEME']?>: <?php AfficheDifficulte($difficulte);?></span></h3><br/>
				<h3 class="text-center timer"> Temps restant <br/> <span id="time">00:00:000</span></h3><br/>

				<?php if($question['MEDIA']!=null) //On affiche un media si la question en possède un
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
						
					<?php if ($question["TYPE_QUEST"]==1) //Si c'est une question ouverte on affiche un formulaire
					{ ?>
						<form method ="POST" action="PartieQuizzRep.php?id=<?=$ID_QUEST?>&typeQuest=<?=$question["TYPE_QUEST"]?>&timeStop="> 
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
					{ //Sinon on affiche des lignes de 3 boutons avec les différentes propositions
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
				</div>
			</div>
		</div>
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>