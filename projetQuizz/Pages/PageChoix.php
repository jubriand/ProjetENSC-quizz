<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 



// Recuperer tous les themes
$themes = getDb()->query('select * from theme order by ID_THEME'); 
?>

<html>
	<body>
	<?php require_once "../Includes/header.php" ;?>
		<div class="container-fluid"><br/>
			<h1 class="text-center"> Themes </h1> <br/><br/>
				<?php 
					$i=0;
					foreach ($themes as $theme) 
					{ 
						if($i%3==0)
						{
							print "<div class='row'>";
						}
				?>
						<div class="col"> <p class="text-center"> <a href="SelectionTheme.php?id=<?= $theme['ID_THEME'] ?>" class="btn btn-primary btn-lg"> <?= $theme['NOM_THEME'] ?> </a> </p> </div>
						<?php	
							$i++;  
							if($i%3==0)
							{
								print "</div></br>";
							}

					}	?>
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