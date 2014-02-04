<?php

// Pagina usada ao clicar em "Disciplinas" no menu principal

include "verifica_login.php";

verificaLogin();

?>

<html>

<head>
	<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title> Disciplinas - SAD </title>

	<?php

session_start();

include "config.php";

$id    = mysql_connect($host, $login_db, $senha_db);
$con   = mysql_select_db($database, $id);
$login = $_SESSION['login'];

$sql = "SELECT p.nome, l.surveyls_title, d.disciplina_id  FROM sad_professor_disciplina as d, professores p, lime_surveys_languagesettings as l WHERE p.login = d.login and l.surveyls_survey_id         = d.disciplina_id and d.login = '$login'";
$res = mysql_query($sql, $id);

?>

</head>

<body>
	<div id='banner' align='center'>
		<img style='display: block; margin-left: auto; margin-right: auto'
			bgcolor='black' src='../imagens/ba.jpg'>
	</div>

	<!-- Menu inicial -->

	<div id="cssmenu">
		<ul>
			<li><a href="sessao.php">Inicio</a></li>
			<li><a href="menuDisciplinas.php"  class="here">Disciplinas</a></li>
			<li><a href="help.php">Ajuda</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>
	
	<div align='center'>
			<iframe
				name="disciplinas"
				width="100%"
				height="80%"
				src='disciplinas.php'
				frameborder="yes"
				scrolling="yes">
			</iframe>
	
	</div>

</body>
	
</html>
