<?php
require_once "../Includes/functions.php";
session_start();
$ID_THEME=$_SESSION['ID_THEME'];

$stmt = getDb()->prepare("select * from question where ID_THEME=?");
$stmt->execute(array($ID_THEME));


foreach($stmt as $question)
{
    $stmt = getDb()->prepare("delete from reponse where ID_QUEST=?");
    $stmt->execute(array($question['ID_QUEST']));
    $stmt = getDb()->prepare("delete from question where ID_QUEST=?");
    $stmt->execute(array($question['ID_QUEST']));
}
$stmt = getDb()->prepare("delete from theme where ID_THEME=?");
$stmt->execute(array($ID_THEME));

redirect('PageChoix.php');
?>