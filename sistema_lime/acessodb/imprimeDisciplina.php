<html>
<title>Informacoes Disciplina</title>
<head>
<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
include "imprimeQuesito.php";
$disciplina_id = $_GET ['disciplina_id'];
setcookie('disciplina_id',$disciplina_id);

?>
</head>

<body>
	
	<div id="cssmenu">
		
		<ul>
			
			<?php				
				
				while ( $row = mysql_fetch_array ( $res ) ) {
					$disciplina = utf8_encode ( $row ["surveyls_title"] );
					$disciplina_id = $row ["disciplina_id"];
					
					echo "<li><a href=imprimeGraficoDisciplinaFelipe.php?disciplina_id=$disciplina_id>$disciplina</a></li>";
				}
			?>

		</ul>

	</div>
                
    <iframe
        name="iframe2"
        width="600"
        height="600"
        src="radar.html"
        frameborder="yes"
        >
    </iframe>        


    <iframe
        name="iframe3"
        width="600"
        style="background-color:#FAEBD7"
        height="600"
        src="menuQuesitos.php"
        frameborder="yes"
        >
     </iframe> 


</html>
