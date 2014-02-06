<?php
// Pagina que gera os relatorios do admin - Emergencial

include "../acessodb/verifica_login.php";

verificaLogin();

?>

<html>
<head>
	<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title> Relatórios - SAD </title>
</head>

<body>
	<div id='banner' align='center'>
		<img style='display: block; margin-left: auto; margin-right: auto ' bgcolor='black' src='../imagens/ba.jpg'>
	</div>

</p>

<!-- Menu inicial -->

<div id="cssmenu">
		<ul>
			<li><a href="sessao2.php">Inicio</a></li>
			<li><a href="relatorio.php"  class="here">Relatório</a></li>
			<li><a href="../usuario/logout.php">Sair</a></li>
		</ul>

	</div>

<body>

<h3><p>Relatório</p></h3>

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


$row        = 1;
$handle     = fopen("../acessodb/data.csv", "r");
$matriz     = array();
$disciplina = array();
$index      = 0;
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
    for ($i = 0; $i < $num; $i++) {
        $disciplina[$i] = $data[$i];
    }
    
    $matriz[$index] = $disciplina;
    $index++;

}

$disciplinas = array();
 for ($i = 1; $i < count($matriz) - 2; $i++) {
        
        $disciplinas[$i] = $matriz[$i][0];
  }
    

//for($i = 0; $i < count($disciplinas); $i++) {
	
setcookie('disciplina_id',$disciplina[0]);
//	echo "<a href=../acessodb/imprimeDisciplinaAdmin.php?disciplina_id=$disciplinas[$i]>$disciplinas[$i]</a>","<br>";
//	break;
//}

for($i = 0; $i < 13; $i++){
	echo '<iframe
                name="Ranking"
                width="100%"
                height="23%"
                src="../acessodb/index.php"
                scrolling="no"
                frameborder="0"
                >
                </iframe> ', "<br>";
                
	
}


?>



<h3>passou</h3>


</body>
</html>
