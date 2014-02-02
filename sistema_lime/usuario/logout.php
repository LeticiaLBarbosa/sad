<?php
	// Página que da logout no usuario
	
	session_start();
	
	session_unset();
	
	session_destroy();
	
	setcookie ('disciplina_id', "", time() - 3600);
	header("Location: ../index.html");
	
?>
