<?php

	session_start();
	
	session_destroy();

	session_unset();

	setcookie("login",null);
	setcookie("senha",null);
	
	header("Location: ../index.html");
	
?>
