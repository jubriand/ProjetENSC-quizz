<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 

//On récupère le thème joué
$ID_THEME = $_SESSION['ID_THEME'];
$stmt = getDb()->prepare('select * from theme where ID_THEME=?');
$stmt->execute(array($ID_THEME));
$theme = $stmt->fetch();

$difficulte=$_SESSION['diff'];
$nbQuestionsJustes=$_SESSION['score'];

$ratio=$nbQuestionsJustes/$theme['NB_QUESTIONS'];

$score=$nbQuestionsJustes*2*$difficulte;

$time_stop=$_SESSION['time_stop'];

?>

<script language="JavaScript">
    window.onload = function () 
    {
        if(localStorage.getItem("time") <=0) 
        {
            diff = 0;
        }
        else
        {
            diff = localStorage.getItem("time");
        }
        minutes = ((<?=$time_stop?>-diff) / 60000) | 0;
        seconds = ((<?=$time_stop?>-diff) / 1000) | 0;
		milSeconds = ((<?=$time_stop?>-diff) %1000) | 0;

        string="";
        if(minutes!="0")
        {
            string= string + minutes +" minutes, ";
        }
        string= string + seconds + " secondes et " + milSeconds + " millièmes"
        display = document.querySelector('#time')
        display.textContent = string;
    }

    function clearData() 
    {
        localStorage.clear();
    }     
</script>

<?php
$time_left=TimeLeft();

if($time_left>=0 and $score!=0)
{
    $score+=$time_left;
}


if(isset($_SESSION['login']))
{
    //On met à jour le score total de l'utilisateur
    $login = $_SESSION['login'];
    $stmt = getDb()->prepare('select SCORE_TOTAL from utilisateur where PSEUDO=?');
    $stmt->execute(array($login));
    $row= $stmt->fetch();
    $score_total=$row['SCORE_TOTAL'];

    $score_total+=$score;

    $stmt = getDb()->prepare('update utilisateur set SCORE_TOTAL=? where PSEUDO=?');
    $stmt->execute(array($score_total,$login));
}
?>

<html>
	<body>
		<?php require_once "../Includes/header.php"; ?>
		<div class="container-fluid jumb">
            <br/>
			<div class="jumbotron col-xl-5 col-lg-6 col-md-7 col-sm-9 text-center">
                <h3><span class="title"><?=$theme['NOM_THEME']?>: <?php AfficheDifficulte($difficulte);?></span></h3><br/>
				<h3><?php if($time_left<=0)
                { ?>
                    <span class="timer">Temps écoulé!!</span><br/><br/>
                <?php } 
                else 
                { ?>
                    <span class="dispTime"> Le quizz a été fini en <span id="time"></span></span><br/><br/><br/>
                <?php } ?>
                <span: class="score">Score: <?=$nbQuestionsJustes?>/<?=$theme['NB_QUESTIONS']?>
                <br/><?=$score?> points </span></h3>

                <?php if($theme['BEST_SCORE']<$score)
                {
                    $stmt = getDb()->prepare('update theme set BEST_SCORE=? where ID_THEME=?');
                    $stmt->execute(array($score,$ID_THEME));
                    ?><br/><h4 class="bestScore">Meilleur Score!!</h4>
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
                else if($ratio>=0)
                { ?>
                    <h5>Bravo, vous avez le Q.I. d'un enfant de CM2!</h5>
                <?php } ?>
                <br/>
                <div class='row'>
                    <div class="col"> <p class="text-center"> <a href="PartieQuizz.php?diff=<?=$difficulte?>" class="btn btn-primary btn-lg" onclick="clearData()"> Rejouer</a> </p> </div>
                    <div class="col"> <p class="text-center"> <a href="PageChoix.php" class="btn btn-secondary btn-lg" onclick="clearData()"> Accueil </a> </p> </div>
                </div>

			</div>
		</div>

		
		<?php require_once "../Includes/footer.php"; ?> 
		<?php require_once "../Includes/scripts.php"; ?> 
	</body>
</html>