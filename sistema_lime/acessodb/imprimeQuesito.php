<?php

// Pagina que mostra um determinado quesito da disciplina

include "verifica_login.php";

verificaLogin();

?>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<link href="../menu_assets/styles4.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="http://www.oaa-accessibility.org/media/examples/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="scriptButton.js"></script>
   
</head>

<body>


<?php

//Laço que imprime a lista de questoes para abrir

for ($i = 0; $i < 15; $i++) {
    
    $quesito = "Q" . ($i + 1);
    
    echo "<a href=imprimeQuesito.php?quesito=$i>$quesito</a> &nbsp; &nbsp;";
    
}

?>

<?php

include "config.php";
include "geraMediaPorQuesito.php";
include "csvFunction.php";
include "geraQuesito.php"

?>

</body>

</html>
