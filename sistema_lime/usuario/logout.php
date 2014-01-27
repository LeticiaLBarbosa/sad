<?php

	session_start();
	
	setcookie("login","");
	setcookie("senha","");
	
	session_destroy();

	session_unset();

	header("Location: ../index.html");
	
?>
