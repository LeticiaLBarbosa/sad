<head>
<link href="../menu_assets/styles.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>



<?php

header ( "user.html" );

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
			<li><a href="sessao.php">Início</a></li>
			<li><a href="disciplinas.php">Disciplinas:</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>
	
	
	<h2 align="center">Login efetuado com sucesso!</h2>
	<h2 align="center"> Bem vindo(a) <? echo $login ?></h2>
	
	
	<!-- COMENTARIO DESENVOLVEDOR -->

	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>

	<div id="rodape">

	 <p style="text-align: center;">
					&copy; Copyright 2013 <a href="http://www.dsc.ufcg.edu.br/~pet"> PET Computa&ccedil;&atilde;o UFCG</a>. All rights reserved.</p>

	</div>
</html>
