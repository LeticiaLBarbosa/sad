<head>
<link href="../menu_assets/stylesTeste.css" rel="stylesheet" type="text/css">
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
		
		</ul>

	</div>
	
	<!-- Menu Disciplinas -->

	<div id="cssmenu">
		
		<ul>
			
			<li><a href="sessao.php">Meus dados</a></li>
			
			<li><a>Disciplinas:</a></li>

			<?php				
				
				while ( $row = mysql_fetch_array ( $res ) ) {
					$disciplina = utf8_encode ( $row ["surveyls_title"] );
					$disciplina_id = $row ["disciplina_id"];
					
					echo "<li><a href=imprimeGraficoDisciplinaFelipe.php?disciplina_id=$disciplina_id>$disciplina</a></li>";
				}
			?>
			
			
			<li><a href="../usuario/logout.php">Sair</a></li>

		</ul>

	</div>
	

	<h2 align="center">Login efetuado com sucesso!</h2>
	<h2 align="center"> Bem vindo(a) <? echo $login ?></h2>
</html>
