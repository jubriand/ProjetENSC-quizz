<html>
<?php

// Connect to the database. Returns a PDO object
function getDb() {
    // Local deployment
    $server = "localhost";
    $username = "test";
    $password = "test";
    $db = "id12746608_quizzensc"; 
    
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['login']);
}

function isAdmin(){
    $stmt = getDb()->prepare('select * from utilisateur where PSEUDO=?');
    $stmt->execute(array($_SESSION['login']));
    $is_admin = $stmt->fetch();
    return $is_admin['IS_ADMIN'];
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}

function formUser($type)
{?>
    <form method ="POST">
		
		<fieldset ><legend class="text-center"> <?php print$type; ?> </legend>
		<br/>
		<div class="row align-items-center">
			<div class="m-auto">
				<label for ="login"> Login : </label>
				<input type="text" name="login" size ="17"/> <br/>
			</div>
			<div class="m-auto">
				<label for ="mdp"> Mot de passe : </label>
				<input type="password" name="mdp" size="17"/>
			</div>
            <?php if($type=='Inscription'){?>
                <div class="m-auto">
				<label for ="mdp"> Cochez cette case pour être administrateur: </label>
				<input type="radio" name="admin"/>
			    </div>
            <?php } ?>
		</div>
		
		
		<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
    </form>
<?php }

function TypeQuestion($id)
{

	$stmt = getDb()->prepare('select TEST_QUEST from question where id=?');
	$stmt->execute(array($typeQuestion));
	$type = $stmt->fetch(); // Access first (and only) result line
	return $type;
}	

function QuestionVraiFaux($ID_THEME)
{	
	//if (TypeQuestion()==0)
		
			$stmt = getDb()->prepare('select intitule from question where ID_THEME=?');
			$stmt->execute(array($typeQuestion));
			$intitule = $stmt->fetch(); // Access first (and only) result line
		?>

			<form method ="POST">
				<fieldset ><legend class="text-center"> <?php print$type; ?> </legend>
				<br/>
				<div class="row align-items-center">
					<div class="m-auto">
						<label for ="intitule"> $intitule </label>
						<input type="text" name="intitule" size ="17"/> <br/>
					</div>
					<div class="m-auto"> <br/>
						<label for ="reponse"> Vrai </label>
						<input type="radio" name="reponse" value="1" size="17"/>
						<label for ="reponse"> Faux </label>
						<input type="radio" name="reponse" value="0" size="17"/>
					</div>
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
			</form>

			
			
		
		<?php
	
}
?>
</html>