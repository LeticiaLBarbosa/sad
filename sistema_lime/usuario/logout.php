<?php

///	session_start();
	setcookie("login","");
	setcookie("senha","");
	
	
	//unset($_SESSION['loginSession']);
	//unset($_SESSION['senhaSession']);
	
	unset($_COOKIE['login']);
	unset($_COOKIE['disciplina_id']);
	unset($_COOKIE['senha']);
	
	
	session_destroy();

	header("Location: ../index.html");
	
?>
