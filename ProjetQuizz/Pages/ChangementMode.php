<?php
require_once "../Includes/functions.php";
session_start();
if($_SESSION['mode']=="joueur")
{
    $_SESSION['mode']="admin";
}
elseif($_SESSION['mode']=="admin")
{
    $_SESSION['mode']="joueur";
}
redirect('PageChoix.php');
?>