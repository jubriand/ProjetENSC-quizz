<?php
session_start();
require_once "../Includes/functions.php";
$login=$_SESSION['login'];
$stmt = getDb()->prepare("delete from utilisateur where PSEUDO=?");
$stmt->execute(array($login));
session_destroy();
redirect('PageChoix.php');
?>