<html>

<?php

// Pagina inicial do nosso sistema apos o login

include "verifica_login.php";

verificaLogin();

?>

<head>
<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

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
			<li><a href="sessao.php" class="here">Inicio</a></li>
			<li><a href="menuDisciplinas.php">Disciplinas</a></li>
			<li><a href="help.php">Ajuda</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>
	
	
	<h2 align="center">Login efetuado com sucesso!</h2>
	<h2 align="center"> Bem vindo(a) <? echo $login ?>!</h2>
	<br>
	
	<div align="justify">
	<p>
	O SAD (Sistema de Avaliação Docente) é destinado ao acompanhamento da avaliação docente do Curso de Bacharelado em Ciência da Computação do Departamento de Sistemas e Computação (DSC) da Universidade Federal de Campina Grande (UFCG). A <a href="http://www.computacao.ufcg.edu.br/">computação da UFCG</a>  possui como <a href="http://www.computacao.ufcg.edu.br/professores">professores</a> 34 profissionais, sendo 27 doutores, os quais lecionam cerca de 34 disciplinas de conteúdo básico e complementar obrigatório, além das disciplinas de conteúdo complementar flexível.
	</p>
	<p>
	Nesse sistema, cada professor irá encontrar informações e estatísticas sobre a avaliação realizada pelos alunos das disciplinas lecionadas por ele a partir de 2012.2, por meio de <a href="help.php">questionário</a> <poderia ter um link em questionário para o help com todas as questões utilizadas> online. Todo o processo de avaliação docente tem sido conduzido por uma equipe de professores do DSC (escolhida em assembleia departamental) com o apoio da coordenação colegiada e do <a href="http://www.dsc.ufcg.edu.br/~pet/">PET computação</a>.
	</p>
	<p>
	O SAD mostra para cada <a href="menuDisciplinas.php">disciplina</a> <marcar cada disciplina apontando para a primeira disciplina daquele professor> do professor um gráfico, denominado <a href="help.php">radar plot</a> <marcar radar plot apontando para o help>, que permite visualizar seu desempenho em cada questão avaliada, comparado ao maior e menor desempenho naquela questão, dentre todas as disciplinas avaliadas, no período selecionado. 
	</p>
	<p>
	É possível ainda visualizar o desempenho do professor por questão avaliada, no gráfico denominado de <a href="help.php">ranking plot</a> <marcar ranking plot apontando para o help>, comparado às demais disciplinas avaliadas, o período selecionado. Além disso, tem-se informações sobre a média geral do DSC na questão e o “score” do professor na questão, ou seja, seu percentual em relação à melhor nota possível naquela questão.
	</p>
	
</body>
	
</html>
