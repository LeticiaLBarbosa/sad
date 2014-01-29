<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<?php
include "config.php";

$questao = $_GET ['questao'];

// Iniciando conexao ao BD e gerando variÃ¡veis essenciaisis
$id = mysql_connect ( $host, $login_db, $senha_db );
$con = mysql_select_db ( $database, $id );

$disciplina_id = $_GET ['disciplina_id'];

$indiceComentario = 6 + 2 * $questao;

$tabela = "lime_survey_" . $disciplina_id;

$sql3 = "SELECT * FROM $tabela";

$res3 = mysql_query ( $sql3, $id );

$stringComentarios = "";

$count = 0;
while ( $row3 = mysql_fetch_array ( $res3 ) ) {
	if ($row3 [$indiceComentario] != "") {
		$count ++;
		
		
		$c = utf8_encode ( "Comentário" );
		$stringComentarios .= "<b>" . $count . utf8_encode ("º - ") . $c . ":" . "</b> <br>" . utf8_encode ( $row3 [$indiceComentario] ) . "<br>";
	}
}

echo '<p align="justify">';
echo $stringComentarios;
echo "</p>";
echo "<br>"

?>

