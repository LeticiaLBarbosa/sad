<html>

<?php

// Pagina inicial do nosso sistema apos o login para o administrador

include "../acessodb/verifica_login.php";

verificaLogin();

?>

<head>
	<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title> Início - SAD </title>
<?php

session_start();
	
$id = mysql_connect ( $host, $login_db, $senha_db );
$con = mysql_select_db ( $database, $id );
$login = $_SESSION['login'];

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
			<li><a href="sessao2.php" class="here">Inicio</a></li>
			<li><a href="#">Relatorios</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>
	
	
	<h2 align="center">Login efetuado com sucesso!</h2>
	<h2 align="center"> Bem vindo(a) Administrador!</h2>
	<br>
	
</body>
	
</html>
