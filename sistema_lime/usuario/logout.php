<?php

///	session_start();
	
	
	//unset($_SESSION['loginSession']);
	//unset($_SESSION['senhaSession']);
	
	unset($_COOKIE['login']);
	unset($_COOKIE['disciplina_id']);
	unset($_COOKIE['senha']);
	
	setcookie("login","",time()-3600);
	setcookie("senha","",time()-3600);
	
	//session_destroy();

	header("Location: ../index.html");
	
?>
