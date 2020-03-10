<?php

// Connect to the database. Returns a PDO object
function getDb() {
    // Local deployment
    $server = "localhost";
    $username = "test";
    $password = "test";
    $db = "id12746608_quizzensc"; 
    
    // Deployment on Heroku with ClearDB for MySQL
    /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);*/
    
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['login']);
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}

// Escape a value to prevent XSS attacks
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
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