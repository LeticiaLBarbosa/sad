<?php

// Pagina usada para selecionar a primeira disciplina do professor

include "verifica_login.php";

verificaLogin();

?>

<html>

<head>
<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

<?php
	
	session_start();
	
	include "config.php";

	$id = mysql_connect ( $host, $login_db, $senha_db );
	$con = mysql_select_db ( $database, $id );
	$login = $_SESSION['login'];

	$sql = "SELECT p.nome, l.surveyls_title, d.disciplina_id  FROM sad_professor_disciplina as d, professores p, lime_surveys_languagesettings as l WHERE p.login = d.login and l.surveyls_survey_id         = d.disciplina_id and d.login = '$login'";
	$res = mysql_query ( $sql, $id );

?>

</head>

<body>
	
	<div id="cssmenu">
		<ul>
			<?php				
				
				$disciplina_id = "";
				$row = mysql_fetch_array ( $res );
				$disciplina_id = $row ["disciplina_id"];
				
				header("Location: imprimeDisciplina.php?disciplina_id=$disciplina_id");
				
			?>

		</ul>
	</div>

</body>
	
</html>
