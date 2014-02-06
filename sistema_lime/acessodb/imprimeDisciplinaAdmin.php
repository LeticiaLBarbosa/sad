<?php

include "verifica_login.php";

verificaLogin();

?>

<html>
	<title>Informacoes Disciplina</title>
<head>
	<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<?php

session_start();

$disciplina_id = $_GET['disciplina_id'];

setcookie('disciplina_id', $disciplina_id);


include "config.php";

$id    = mysql_connect($host, $login_db, $senha_db);
$con   = mysql_select_db($database, $id);
$login = $_SESSION['login'];

$sql = "SELECT p.nome, l.surveyls_title, d.disciplina_id  FROM sad_professor_disciplina as d, professores p, lime_surveys_languagesettings as l WHERE p.login = d.login and l.surveyls_survey_id         = d.disciplina_id and d.login = '$login'";
$res = mysql_query($sql, $id);

?>

<html>

	

<?


for($i = 0; $i<15; $i++) {

setcookie('quesito', "Q".$i);

echo '<iframe
                name="Ranking"
                width="100%"
                height="23%"
                src="index.php"
                scrolling="no"
                frameborder="0"
                >
                </iframe> ';

}


?> 


</html>
