<?php

include_once 'functions.php';

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);
	unset($_SESSION['name']);
	session_destroy();

}

header("Location: login.php");
die;