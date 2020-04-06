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
function isUserConnected() 
{
    return isset($_SESSION['login']);
}

function isAdmin()
{
    $stmt = getDb()->prepare('select * from utilisateur where PSEUDO=?');
    $stmt->execute(array($_SESSION['login']));
    $is_admin = $stmt->fetch();
    return $is_admin['IS_ADMIN'];
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}

// Escape a value to prevent XSS attacks
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

function AddModif($modif, $table, $id)
{?>
	<a class="btn btn-secondary navbar-btn" type="button" href="Modification.php?modif=<?=$modif?>&table=<?=$table?>&id=<?=$id?>"><img src="../Icons/svg/pencil.svg" alt="pencil"> Modifier</a>
<?php }

function formUser($type)
{?>	
<div class="container">
    <br/><div class="jumbotron">
		<form method ="POST">
		
			<fieldset><legend class="text-center"> <h3> <span class="title"><?php print$type; ?></span></h3> </legend>
				<br/>
				<br/>
				<div class="row align-items-center">
					<div class="form-group">
						<label for ="login"> Login : </label>
						<input type="text" name="login" size ="17"/> <br/>
					</div>
					<div class="form-group">
						<label for ="mdp"> Mot de passe : </label>
						<input type="password" name="mdp" size="17"/>
					</div>
					<?php if($type=='Inscription'){?>
						<div class="form-group">
						<label for ="mdp"> Cochez cette case pour être administrateur: </label>
						<input type="radio" name="admin"/>
						</div>
					<?php } ?>
				</div>
				
			</fieldset>
			<br/><p class="text-center"><button type="submit" class="btn btn-primary">Envoyer</button></p><br/>
		</form>
	</div>
</div>
<?php }

function RecupNewId($table)
{
	if($table=='theme')
	{
		$id='ID_THEME';
	}
	else if($table=='question')
	{
		$id='ID_QUEST';
	}
	else if($table=='reponse')
	{
		$id='ID_REPONSE';
	}
	$stmt = getDb()->prepare("select MAX($id) as max from `".$table."`");
    $stmt->execute();
    $row=$stmt->fetch();
	$new_id=$row['max']+1;
	return $new_id;
}

function AddSupp($element, $ID_QUEST='')
{?>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Supp<?=$element?><?=$ID_QUEST?>">
    	<h6>Supprimer</h6>
	</button>
	
	<!-- Modal -->
	<div class="modal fade" id="Supp<?=$element?><?=$ID_QUEST?>" tabindex="-1" role="dialog" aria-labelledby="Supp<?=$element?><?=$ID_QUEST?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Supp<<?=$element?><?=$ID_QUEST?>Label"><img src="../Icons/svg/warning.svg" alt="warning"> Attention!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
        	        Êtes-vous bien sûr de vouloir supprimer définitivement <?php if($element=='Question'){print "cette";} else{print "ce";} print" ".$element;?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <a type="button" class="btn btn-primary" href="Supp<?=$element?>.php<?php if($element=='Question'){?>?id=<?=$ID_QUEST?> <?php }?>">Oui</a>
                </div>
            </div>
        </div>
	</div>
<?php }

function AddIdent($type)
{?>
    <!-- Modal -->
    <div class="modal fade" id="Supp<?=$type?>" tabindex="-1" role="dialog" aria-labelledby="Supp<?=$type?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Supp<?=$type?>Label"><?=$type?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form method="POST" action="<?=$type?>.php">
						<div class="form-group">
							<label for ="login"> Login : </label>
							<input type="text" name="login" size ="17"/> <br/>
						</div>
						<div class="form-group">
							<label for ="mdp"> Mot de passe : </label>
							<input type="password" name="mdp" size="17"/>
						</div>
						<?php if($type=='Inscription'){?>
							<div class="form-group">
								<label for ="mdp"> Cochez cette case pour être administrateur: </label>
								<input type="radio" name="admin"/>
							</div>
						<?php } ?>
					
				</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
							<button type="submit" class="btn btn-primary">Confirmer</button>
						</div>
					</form>
            </div>
        </div>
    </div>
<?php }

function AddMedia()
{
	$target_dir = "../Images/";
	$target_file = $target_dir . basename($_FILES["MEDIA"]["name"]);
	$uploadOk = 1;
	
	// On vérifie que le fichier n'existe pas déjà
	if (file_exists($target_file)) 
	{
		$message="Le fichier que vous essayez d'ajouter existe déjà";
		$uploadOk = 0;
	}
	// On vérifie la taille dufichier
	if ($_FILES["MEDIA"]["size"] > 500000) 
	{
		$message="Le fichier que vous essayez d'ajouter est trop lourd";
		$uploadOk = 0;
	}

	// On regarde si le fichier peut être ajouté et si oui on l'ajoute
	if ($uploadOk == 1) 
	{
		if (move_uploaded_file($_FILES["MEDIA"]["tmp_name"], $target_file)) 
		{
			$message="Ok";
		} 
		else 
		{
			$message="Il y a eu une erreur lors de l'ajout de votre fichier.";
		}
	}
	return $message;
}


function microtime_float()
{
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$sec);
}

function TimeLeft()
{
	$time_start=$_SESSION['time_start'];
	$time_stop=intdiv($_SESSION['time_stop'],1000);
	$time_check = microtime_float() - $time_start;
	$time_left= $time_stop-$time_check;
	return $time_left;
}

function RebootSession()
{
	if(isset($_SESSION['diff']))
	{
		unset($_SESSION['diff']);
	}
	if(isset($_SESSION['score']))
	{
		unset($_SESSION['score']);
	}
	if(isset($_SESSION['questionsPassees']))
	{
		unset($_SESSION['questionsPassees']);
	}
	if(isset($_SESSION['new_theme']))
	{
		unset($_SESSION['new_theme']);
	}
}
function AfficheDifficulte($difficulte)
{
	if($difficulte==1)
	{
		print("Facile");
	}
	else if($difficulte==2)
	{
		print("Moyen");
	}
	else if($difficulte==3)
	{
		print("Difficile");
	}
}
?>
</html>