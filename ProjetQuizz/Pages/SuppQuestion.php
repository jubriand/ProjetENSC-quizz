<?php
require_once "../Includes/functions.php";
session_start();
$ID_QUEST=$_GET['id'];

$stmt = getDb()->prepare("delete from reponse where ID_QUEST=?");
$stmt->execute(array($ID_QUEST));
$stmt = getDb()->prepare("delete from question where ID_QUEST=?");
$stmt->execute(array($ID_QUEST));


redirect("SelectionTheme.php");
?>