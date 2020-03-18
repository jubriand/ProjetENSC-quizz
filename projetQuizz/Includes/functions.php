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

	$stmt = getDb()->prepare('select TYPE_QUEST from question where id=?');
	$stmt->execute(array($id));
	$type = $stmt->fetch(); // Access first (and only) result line
	return $type;
}

function AfficherIntitule($ID_THEME)
{
	$stmt = getDb()->prepare('select intitule from question where ID_THEME=?');
	$stmt->execute(array($ID_THEME));
	$intitule = $stmt->fetch(); // Access first (and only) result line
	?>
	<legend class="text-center"> <?php print $intitule['intitule']; ?> </legend>; <?php
	
}

function QuestionVraiFaux($ID_THEME) //question vrai ou faux (TYPE_QUEST=0)
{	
	
		    AfficherIntitule($ID_THEME);

		?>

			<form method ="POST">
				<fieldset ><legend class="text-center">  </legend>
				<br/>
				<div align="center">
					
					<div class="m-auto">
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

function QuestionOuverte($ID_THEME) //question ouverte (TYPE_QUEST=1)
{	
		AfficherIntitule($ID_THEME);
		
			
		?>

			<form method ="POST">
				<fieldset ><legend class="text-center"> </legend>
				<br/>
				<div align="center">
					<div class="m-auto">
						
						<input type="text" name="intitule" size ="17"/> <br/>
					</div>
					
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
			</form>	
		<?php
}

function QuestionCM($ID_THEME) //question choix multiple (TYPE_QUEST=2)
{	
	
		
		AfficherIntitule($ID_THEME);
		?>

			<form method ="POST">
				<fieldset ><legend class="text-center"> <?php print $intitule['intitule']; ?> </legend>
				<br/>
				<div align="center">
					
					<div class="m-auto">
						<label for="rep1"> réponse 1</label>
						<input type="checkbox" id="rep1" name="rep1" value="Bike" size="17"/><br/>
						
						<label for="rep2"> réponse 2</label>
						<input type="checkbox" id="rep2" name="rep2" value="Car" size="17"/><br/>
						
						<label for="vehicle3"> réponse 3</label>
						<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat" size="17"/><br/>

						<label for="rep4"> réponse 4</label>
						<input type="checkbox" id="rep4" name="rep4" value="Train" size="17"/><br/>
						
						
					</div>
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
			</form>	
		<?php
} ?>
</html>