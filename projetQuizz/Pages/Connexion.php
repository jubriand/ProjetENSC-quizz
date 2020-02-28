<html lang="fr">
    <?php require_once "../Includes/head.php"; ?> 
	<body>
		<form method ="POST" action="recup.php">
		
		<fieldset ><legend class="text-center"> Se connecter </legend>
		<br/>
		<div class="row align-items-center">
			<div class="m-auto">
				<label for ="Login"> Login : </label>
				<input type="text" name="Login" size ="17"/> <br/>
			</div>
			<div class="m-auto">
				<label for "Mot de passe"> Mot de passe : </label>
				<input type="password" name="mot de passe" size="17"/>
			</div>
		</div>
		
		
		<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
		</form>
		
		
        <?php require_once "../Includes/scripts.php"; ?> 
        <?php require_once "../Includes/footer.php"; ?> 
	</body>
</html>