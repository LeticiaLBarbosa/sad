<?php

include "config.php";

function verificaLogin(){
	
	$login = "";
	$login = $_COOKIE["login"];
	
	$db			=	mysql_connect ($host, $login_db, $senha_db); //conecta ao mysql
	$basedados	=	mysql_select_db($database); //conecta a base de dados

	//$confirmacao = mysql_query("SELECT * FROM $tabela WHERE login = '$login'", $db) or die(mysql_error()); //verifica se o login e a senha conferem
	$contagem = mysql_num_rows($confirmacao);

	if ( $contagem == 0 ) {
		header("Location: ../index.html");
		
	}
}

?>
