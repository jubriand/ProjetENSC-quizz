<html>
<?php

// Connexion à la BDD
function getDb() 
{
    $server = "localhost";
    $username = "test";
    $password = "test";
    $db = "id12746608_quizzensc"; 
    
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Regarde si un utilisateur est connecté
function isUserConnected() 
{
    return isset($_SESSION['login']);
}

//Regarde si un utilisateur est admin
function isAdmin()
{
    $stmt = getDb()->prepare('select * from utilisateur where PSEUDO=?');
    $stmt->execute(array($_SESSION['login']));
    $is_admin = $stmt->fetch();
    return $is_admin['IS_ADMIN'];
}

// Renvoie à l'url défini
function redirect($url) {
    header("Location: $url");
}

// Escape a value to prevent XSS attacks
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

//Ajoute un bouton de modification
function AddModif($modif, $table, $id)
{?>
	<a class="btn btn-secondary navbar-btn" type="button" href="Modification.php?modif=<?=$modif?>&table=<?=$table?>&id=<?=$id?>"><img src="../Icons/svg/pencil.svg" alt="pencil"> Modifier</a>
<?php }

//Permet de récupérer l'id d'un nouvel élément
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

// Permet de supprimer une question et les réponses et média qui lui sont associées
function SuppQuestionReponse($id, $column)
{
	$stmt = getDb()->prepare("select * from question where `".$column."`=?");
	$stmt->execute(array($id));

	foreach($stmt as $question)
	{
		unlink("../Images/".$question['MEDIA']);
		$stmt = getDb()->prepare("delete from reponse where ID_QUEST=?");
		$stmt->execute(array($question['ID_QUEST']));
		$stmt = getDb()->prepare("delete from question where ID_QUEST=?");
		$stmt->execute(array($question['ID_QUEST']));
	}
}

// Ajoute un bouton de supression
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

//Correspond au formulaire de Connexion/Inscription
function AddIdent($type)
{?>
    <!-- Modal -->
    <div class="modal fade" id="<?=$type?>" tabindex="-1" role="dialog" aria-labelledby="<?=$type?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?=$type?>Label"><?=$type?></h5>
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

//Affiche le Tutoriel dans une modal
function AddTuto()
{?>
    <!-- Modal -->
    <div class="modal fade" id="Tuto" tabindex="-1" role="dialog" aria-labelledby="TutoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TutoLabel"> Tutoriel </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="../Images/TutoQuizzENSC.mp4" title="Tutoriel"></iframe>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
            </div>
        </div>
    </div>
<?php }

// Permet d'ajouter un média au répetoire du site
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
	if ($_FILES["MEDIA"]["size"] > 100000000) 
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

//Permet de récupérer la date en secondes
function microtime_float()
{
  list($usec, $sec) = explode(" ", microtime());
  $time=((float)$sec*1000)+(float)$usec;
  return $time;
}

//Permet de calculer le nombre de secondes restantes lors d'une partie
function TimeLeft()
{
	$time_start=$_SESSION['time_start'];
	$time_stop=$_SESSION['time_stop'];
	$time_check = microtime_float() - $time_start;
	$time_left= $time_stop-$time_check;
	return $time_left;
}

//Réinitialise les variables en session
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

//Affiche le niveau de difficulté
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