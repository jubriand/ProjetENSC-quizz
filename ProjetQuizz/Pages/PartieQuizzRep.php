<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
require_once "../Includes/head.php"; 


$id=$_GET['id'];
$typeQuest=$_GET['typeQuest'];
if($typeQuest==1)
{
	$stmt = getDb()->prepare('select * from reponse where ID_QUEST=?');
	$stmt->execute(array($id));
	$reponse=$stmt->fetch();
	if($reponse['INTITULE']==$_POST['reponse'])
	{
		$_SESSION['score']++;
	}
}
else
{
	$stmt = getDb()->prepare('select * from reponse where ID_REPONSE=?');
	$stmt->execute(array($id));
	$reponse=$stmt->fetch();
	if($reponse['IS_TRUE']==0)
	{
		$_SESSION['score']++;
	}
}
redirect("PartieQuizz.php"); 
?>
