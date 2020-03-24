<?php
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 
session_start();

//On récupère le thème joué
$ID_THEME = $_SESSION['ID_THEME'];
$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
$stmt->execute(array($ID_THEME));
$theme = $stmt->fetch();

$score=$_SESSION['score']*$_SESSION['diff'];

if(isset($_SESSION['login']))
{
    //On met à jour le score de l'utilisateur
    $login = $_SESSION['login'];
    $stmt = getDb()->prepare('select SCORE_TOTAL from utilisateur where PSEUDO=?');
    $stmt->execute(array($login));
    $row= $stmt->fetch();
    $score_total=$row['SCORE_TOTAL'];

    $score_total+=$score;

    $stmt = getDb()->prepare('update utilisateur set SCORE_TOTAL=? where PSEUDO=?');
    $stmt->execute(array($score_total,$login));
}
$ratio=$_SESSION['score']/$theme['NB_QUESTIONS'];

?>

<html>
	<body>
		<?php require_once "../Includes/header.php"; ?>
		<div class="container-fluid">
            <br/>
			<div class="jumbotron col-xl-5 col-lg-6 col-md-7 col-sm-9 text-center">
				<h3>Score: <?=$_SESSION['score']?>/<?=$theme['NB_QUESTIONS']?>
                <br/><?=$score?> points</h3>
                <?php if($theme['BEST_SCORE']<$score)
                {
                    $stmt = getDb()->prepare('update theme set BEST_SCORE=? where ID_THEME=?');
                    $stmt->execute(array($score,$ID_THEME));
                    ?><h4>Meilleur Score!!</h4>
                <?php } ?>
                
                <br/><br/>
                <?php if($ratio>0.8)
                { ?>
                    <h5>Bravo, ce thème n'a plus aucun secret pour vous</h5>
                <?php }
                else if($ratio>0.5)
                { ?>
                    <h5>Bien joué, continuez comme ça et vous battrez tous les records</h5>
                <?php }
                else if($ratio>0.2)
                { ?>
                    <h5>Dommage, la prochaine fois sera la bonne</h5>
                <?php }
                else if($ratio>0)
                { ?>
                    <h5>Bravo, vous avez le niveau d'un enfant de CM2!</h5>
                <?php } ?>
			</div>
		</div>

		
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>