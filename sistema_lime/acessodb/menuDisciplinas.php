<html>

<head>
<link href="../menu_assets/styles.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

<?php

include "config.php";

$id = mysql_connect ( $host, $login_db, $senha_db );
$con = mysql_select_db ( $database, $id );
$login = $_COOKIE["login"];

$sql = "SELECT p.nome, l.surveyls_title, d.disciplina_id  FROM sad_professor_disciplina as d, professores p, lime_surveys_languagesettings as l WHERE p.login = d.login and l.surveyls_survey_id         = d.disciplina_id and d.login = '$login'";
$res = mysql_query ( $sql, $id );

?>

</head>

<body>
	<div id='banner' align='center'>
		<img style='display: block; margin-left: auto; margin-right: auto'
			bgcolor='black' src='../imagens/ba.jpg'>
	</div>

	</p>

	<!-- Menu inicial -->

	<div id="cssmenu">
		<ul>
			<li><a href="sessao.php">Inicio</a></li>
			<li><a href="disciplinas.php">Disciplinas</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>
	
	<div align='center'>
		<p>
			<iframe
				name="disciplinas"
				width="1200"
				height="720"
				src='disicplinas.php'
				frameborder="yes"
				scrolling="yes">
			</iframe>
		</p>
	</div>
	
	

</body>
	
</html>
