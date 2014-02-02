<html>
  <head>
  <link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <script src="http://d3js.org/d3.v3.min.js"></script>
        <script src="RadarChart.js"></script>
  </head>
  
  <br>
  
  
  <body>
  
    <h3><center><?php   
        
    include "config.php";        
        
    session_start();
    
    $disciplina_idAtual = $_COOKIE['disciplina_id'];
    
    $id    = mysql_connect($host, $login_db, $senha_db);
    $con   = mysql_select_db($database, $id);
    $login = $_SESSION['login'];
    
    $sql = "SELECT p.nome, l.surveyls_title, d.disciplina_id  FROM sad_professor_disciplina as d, professores p, lime_surveys_languagesettings as l WHERE p.login = d.login and l.surveyls_survey_id         = d.disciplina_id and d.login = '$login'";
    $res = mysql_query($sql, $id);
    
    while ($row = mysql_fetch_array($res)) {
				$disciplina    = utf8_encode($row["surveyls_title"]);
				$disciplina_id = $row["disciplina_id"];
				
				if ($disciplina_id == $disciplina_idAtual){
				  echo $disciplina;
				  break;
				  
				}
				
				//echo "<li><a href=imprimeDisciplina.php?disciplina_id=$disciplina_id>$disciplina</a></li>";
		}
		
    
    ?></center></h3>
    
    <div id="body">
          <div id="chart"><script type="text/javascript" src="script.js"></script></div>
          
    </div>
        
    
        
  </body>
</html>
