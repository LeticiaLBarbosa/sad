<?php

	session_start();

	unset($_SESSION['loginSession']);
	unset($_SESSION['senhaSession']);
	
	unset($_COOKIE['login']);
	unset($_COOKIE['disciplina_id']);
	session_destroy();

	header("Location: ../index.html");
	
?>
