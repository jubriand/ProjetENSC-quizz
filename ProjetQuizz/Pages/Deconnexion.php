<?php
session_start();
require_once "../Includes/functions.php";
session_destroy();
redirect('PageChoix.php');
?>