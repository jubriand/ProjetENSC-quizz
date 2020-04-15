<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 
?>

<script language="JavaScript">
	localStorage.clear(); //Permet de remettre le chrono à zéro si une partie est quittée en cours de route
</script>

<?php
if(!isset($_SESSION['mode']))//Les personnes non connectés sont obligatoirement des joueurs
{
	$_SESSION['mode']='joueur';
}

//On supprime toutes les variables en session 
RebootSession();
if(isset($_SESSION['ID_THEME']))
{
	unset($_SESSION['ID_THEME']);
}

// On recupere tous les themes
$themes = getDb()->query('select * from theme order by ID_THEME'); 
?>

<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid"><br/>
			<h1 class="text-center"><span class="title">Themes</span> </h1> <br/><br/>
				<?php 
				$i=0; //Compteur permettant de savoir quand retourner à la ligne
				foreach ($themes as $theme) //On affiche chaque thème en mettant 3 boutons par lignes
				{ 
					$stmt= getDb()->prepare("select count(ID_QUEST) as nbQuest from question where ID_THEME=?");
					$stmt->execute(array($theme['ID_THEME']));
					$row=$stmt->fetch();
					if($_SESSION['mode']=='admin' or $row['nbQuest']>=$theme['NB_QUESTIONS'])
					{
						if($i%3==0)
						{
							print "<div class='row'>";
						}
						?>
						<div class="col"> <p class="text-center"> <a href="SelectionTheme.php?id=<?= $theme['ID_THEME'] ?>" class="btn btn-primary btn-lg choiceBtn"> <?= $theme['NOM_THEME'] ?> </a> </p> </div>
						<?php	
						$i++;  
						if($i%3==0)
						{
							print "</div></br>";
						}
					}
				}?>
				</div>
			<br/>
			<?php if($_SESSION['mode']=="admin") //Si on est en mode admin on laisse l'ajout de thème disponible
			{?>	
				<div class="text-center">
					<a class="btn btn-success navbar-btn" type="button" href="AjoutTheme.php"> <h5>Ajouter un thème</h5></a>
				</div>
				<br/>
			<?php } ?>
		</div>
		<?php require_once "../Includes/scripts.php"; ?>
		<?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>