<?php

include "config.php";

$login = $_COOKIE["login"];

$confirmacao = mysql_query("SELECT * FROM $tabela WHERE login = '$login'", $db) or die(mysql_error()); //verifica se o login e a senha conferem
$contagem = mysql_num_rows($confirmacao);

if ( $contagem == 0 ) {
	header("Location: ../index.html");
	
}

?>
