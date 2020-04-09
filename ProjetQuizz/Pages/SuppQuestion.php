<?php
ob_start();
session_start();
require_once "../Includes/functions.php";
$ID_QUEST=$_GET['id'];

SuppQuestionReponse($ID_QUEST,'ID_QUEST');

redirect("SelectionTheme.php");
?>