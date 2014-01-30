<?php

// Usado para verificar se o usuario esta logado no sistema, no cabecalho de cada pagina

function verificaLogin(){
	
	session_start();
		
	include "config.php";	
	
	$login = $_SESSION['login'];
	$senha = $_SESSION['senha'];
	
	$db			=	mysql_connect ($host, $login_db, $senha_db); //conecta ao mysql
	$basedados	=	mysql_select_db($database); //conecta a base de dados

	$confirmacao = mysql_query("SELECT * FROM $tabela WHERE login = '$login' AND senha = '$senha'", $db) or die(mysql_error()); //verifica se o login e a senha conferem
	$contagem = mysql_num_rows($confirmacao);

	if ( $contagem != 1 ) {
		header("Location: ../index.html");
		
	}
}

?>
