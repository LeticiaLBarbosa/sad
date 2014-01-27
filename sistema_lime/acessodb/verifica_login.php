<?php

include "config.php";

function verificaLogin(){
	
	$login = $_COOKIE["login"];

	$id = mysql_connect ( $host, $login_db, $senha_db );
	$con = mysql_select_db ( $database, $id );

	$confirmacao = mysql_query("SELECT * FROM $tabela WHERE login = '$login'", $db) or die(mysql_error()); //verifica se o login e a senha conferem
	$contagem = mysql_num_rows($confirmacao);

	if ( $contagem == 0 ) {
		header("Location: ../index.html");
		
	}
}

?>
