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

</head>

<body>
	
	<div id="cssmenu">
		
		<ul>
			
			<?php

			while ($row = mysql_fetch_array($res)) {
				$disciplina    = utf8_encode($row["surveyls_title"]);
				$disciplina_id = $row["disciplina_id"];
				
				echo "<li><a href=imprimeDisciplina.php?disciplina_id=$disciplina_id>$disciplina</a></li>";
			}
			?>

		</ul>

	</div>
                
    <iframe
        name="Radar"
        width="49%"
        height="88%"
        src="radar.html"
        scrolling="no"
        frameborder="0"
        >
        </iframe>        


        <iframe
        name="Quesito"
        width="49%"
        height="88%"
        src="menuQuesitos.php"
        >
          </iframe> 


</html>
