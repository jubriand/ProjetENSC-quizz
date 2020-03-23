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
function AddModif($modif, $table, $id)
{?>
	<a class="btn btn-secondary navbar-btn" type="button" href="Modification.php?modif=<?=$modif?>&table=<?=$table?>&id=<?=$id?>"><img src="../Icons/svg/pencil.svg" alt="pencil"> Modifier</a>
<?php }

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

function RecupNewId($table)
{
	if($table=='THEME')
	{
		$id='ID_THEME';
	}
	else if($table=='QUESTION')
	{
		$id='ID_QUEST';
	}
	else if($table=='REPONSE')
	{
		$id='ID_REPONSE';
	}
	$stmt = getDb()->prepare("select MAX($id) as max from `".$table."`");
    $stmt->execute();
    $max_id=$stmt->fetch();
	$new_id=$max_id['max']+1;
	return $new_id;
}

function AddSupp($element, $ID_QUEST='')
{?>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Supp<?=$element?>">
    	<h6>Supprimer</h6>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="Supp<?=$element?>" tabindex="-1" role="dialog" aria-labelledby="Supp<?=$element?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Supp<?=$element?>Label"><img src="../Icons/svg/warning.svg" alt="warning"> Attention!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
        	        Êtes-vous bien sûr de vouloir supprimer définitivement ce <?=$element?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <a type="button" class="btn btn-primary" href="Supp<?=$element?>.php<?php if($element=='Question'){?>?id=<?=$ID_QUEST?> <?php }?>">Oui</a>
                </div>
            </div>
        </div>
    </div>
<?php }

function TypeQuestion($id)
{

	$stmt = getDb()->prepare('select TYPE_QUEST from question where id=?');
	$stmt->execute(array($id));
	$type = $stmt->fetch(); // Access first (and only) result line
	return $type;
}

function AfficherIntitule($ID_QUEST)
{
	$stmt = getDb()->prepare('select intitule from question where ID_QUEST=?');
	$stmt->execute(array($ID_QUEST));
	$intitule = $stmt->fetch(); // Access first (and only) result line
	?>
	<legend class="text-center"> <?php print $intitule['intitule']; ?> </legend>; <?php
	
}

function QuestionVraiFaux($ID_QUEST) //question vrai ou faux (TYPE_QUEST=0)
{	
	
		    AfficherIntitule($ID_QUEST);

		?>
		
			<form method ="POST" action="PartieQuizzRep.php?rep=<?value ?>"> 
				<fieldset ><legend class="text-center">  </legend>
				<br/>
				<div align="center">
					
					<div class="m-auto">
						<label for ="reponse"> Vrai </label>
						<input type="radio" name="reponse" value="vrai" size="17"/>
						<label for ="reponse"> Faux </label>
						<input type="radio" name="reponse" value="faux" size="17"/>
					</div>
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer"/> </p>
			</form>
			$rep=value;
		<?php
} //?quest=<?= $question['ID_QUEST']?

function QuestionOuverte($ID_QUEST) //question ouverte (TYPE_QUEST=1)
{	
		AfficherIntitule($ID_QUEST);
		
			
		?>

			<form method ="POST" action="PartieQuizzRep.php"> 
				<fieldset ><legend class="text-center"action="PartieQuizzRep.php"> </legend>
				<br/>
				<div align="center">
					<div class="m-auto">
						
						<input type="text" name="reponse" size ="17"/> <br/>
					</div>
					
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer" /> </p>
			</form>	
		<?php
}

function QuestionCM($ID_QUEST) //question choix multiple (TYPE_QUEST=2)
{	
	
		
		AfficherIntitule($ID_QUEST);
		?>

			<form method ="POST" action="PartieQuizzRep.php">
				<fieldset ><legend class="text-center"> </legend>
				<br/>
				<div align="center">
					
					<div class="m-auto">
						<label for="rep1"> réponse 1</label>
						<input type="checkbox" id="rep1" name="rep1" value="1" size="17"/><br/>
						
						<label for="rep2"> réponse 2</label>
						<input type="checkbox" id="rep2" name="rep2" value="2" size="17"/><br/>
						
						<label for="vehicle3"> réponse 3</label>
						<input type="checkbox" id="vehicle3" name="rep3" value="3" size="17"/><br/>

						<label for="rep4"> réponse 4</label>
						<input type="checkbox" id="rep4" name="rep4" value="4" size="17"/><br/>
						
						
					</div>
				</div>
				
				
				<p class="text-center"> <input type="submit" value="Envoyer" /> </p>
			</form>	
		<?php
} 

function Reponse($ID_QUEST)
{
	$stmt = getDb()->prepare('select intitule from reponse where ID_QUEST=?');
	$stmt->execute(array($ID_QUEST));
	$intitule = $stmt->fetch();
	 if ($_POST['reponse']==$intitule['intitule'])
	 {
		print "Bravo, la réponse est juste";
	 }
	 else 
	 {
	 	 print "la reponse est fausse, la bonne réponse était : "; ?>
		 <legend class="text-center"> <?php print $intitule['intitule']; ?> </legend>;<?php
	 }
}
?>

</html>