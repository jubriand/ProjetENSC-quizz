<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 

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

// Recuperer tous les themes
$themes = getDb()->query('select * from theme order by ID_THEME'); 
?>

<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid"><br/>
			<h1 class="text-center"><span class="title">Themes</span> </h1> <br/><br/>
				<?php 
				$i=0;
				foreach ($themes as $theme) 
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
			<?php if(isUserConnected())
			{
				 if($_SESSION['mode']=="admin")
				{?>	
					<div class="text-center">
						<a class="btn btn-warning navbar-btn" type="button" href="AjoutTheme.php"> <h5>Ajouter un thème</h5></a>
					</div>
					<br/>
				<?php } 
			}?>
				
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>