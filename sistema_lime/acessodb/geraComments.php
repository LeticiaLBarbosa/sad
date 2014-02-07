<?php

// Codigo usado para gerar a pagina dos comentarios

include "verifica_login.php";

verificaLogin();

?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<?php

include "config.php";

$questao = $_GET['questao'];

// Iniciando conexao ao BD e gerando variáveis essenciaisis
$id  = mysql_connect($host, $login_db, $senha_db);
$con = mysql_select_db($database, $id);

$disciplina_id = $_COOKIE['disciplina_id'];

$indiceComentario = 7 + 2 * $questao;

$tabela = "lime_survey_" . $disciplina_id;

$sql3 = "SELECT * FROM $tabela";

$res3 = mysql_query($sql3, $id);

$stringComentarios = "";

$count = 0;
while ($row3 = mysql_fetch_array($res3)) {
    if ($row3[$indiceComentario] != "") {
        $count++;
        
        
        $c = "Comentário";
        $stringComentarios .= "<b>" . $count . "º - " . $c . ":" . "</b> <br>" . utf8_encode($row3[$indiceComentario]) . "<br>";
    }
}

echo '<p align="justify">';
echo $stringComentarios;
echo "</p>";
echo "<br>";
?>
