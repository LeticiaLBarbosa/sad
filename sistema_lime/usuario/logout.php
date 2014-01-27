<?php

///	session_start();
	
	setcookie("login","",time()-3600);
	setcookie("senha","",time()-3600);

	//unset($_SESSION['loginSession']);
	//unset($_SESSION['senhaSession']);
	
	//unset($_COOKIE['login']);
	//unset($_COOKIE['disciplina_id']);
	//session_destroy();

	header("Location: ../index.html");
	
?>
