<?php
session_start();
require_once "../Includes/functions.php";
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