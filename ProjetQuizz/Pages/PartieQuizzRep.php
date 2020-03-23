<html>
	<body>
		<?php
			require_once "../Includes/functions.php";
			require_once "../Includes/head.php"; 
			require_once "../Includes/header.php";
			session_start();


			Reponse($ID_QUEST);


		?>
		<p class="text-center"> <input type="submit" value="Question suivante"/> </p>

		
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>