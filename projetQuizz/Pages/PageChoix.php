<?php
require_once "../Includes/functions.php";
session_start();
require_once "../Includes/head.php"; 
require_once "../Includes/header.php";


// Recuperer tous les themes
$themes = getDb()->query('select * from theme order by ID_THEME'); 
?>

<html>
	<body>
		<div class="container">
			<h1 class="text-center"> Themes </h1> <br/>
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
			
		</div>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>