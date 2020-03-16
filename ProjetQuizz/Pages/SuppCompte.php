<?php
require_once "../Includes/functions.php";
session_start();
$login=$_SESSION['login'];
print "$login";
$stmt = getDb()->prepare("delete from utilisateur where PSEUDO=?");
$stmt->execute(array($login));
session_destroy();
redirect('PageChoix.php');
?>