<?php
	require_once "../Includes/functions.php";
	require_once "../Includes/head.php"; 
	require_once "../Includes/header.php";
	session_start();
	
	$ID_THEME = $_GET['id'];
	$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$theme = $stmt->fetch(); // Access first (and only) result line
	

 
	QuestionVraiFaux($ID_THEME);

?>
<html>
	<body>
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>