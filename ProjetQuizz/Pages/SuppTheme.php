<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
$ID_THEME=$_SESSION['ID_THEME'];

SuppQuestionReponse($ID_THEME,'ID_THEME');

$stmt = getDb()->prepare("select * from theme where ID_THEME=?");
$stmt->execute(array($ID_THEME));
$theme = $stmt->fetch();
unlink("../Images/".$theme['PHOTOS']);

$stmt = getDb()->prepare("delete from theme where ID_THEME=?");
$stmt->execute(array($ID_THEME));

redirect("PageChoix.php");
?>