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

/*
    

// Gerando impressao para ultima pergunta e as respostas dela, ja que a logica eh diferente

if ($i == $quesito) {
    
    $row1 = mysql_fetch_array($res1);
    
    echo "<br>";
    echo "<br>";
    
    echo "<b> 15 - ", utf8_encode($row1[0]), "</b>";
    
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
    $valor = 0;
    
    $indiceDoValor = 0; // so pra alternar
    
    $valores   = array();
    $enunciado = array();
    
    
    while ($row1 = mysql_fetch_array($res1)) {
        $res3 = mysql_query($sql3, $id);
        
        while ($row3 = mysql_fetch_array($res3)) {
            if ($row3[$indiceResposta] == "Y") {
                $valor = $valor + 1;
            }
        }
        
        $valores[$indiceDoValor]   = $valor;
        $enunciado[$indiceDoValor] = utf8_encode($row1[0]);
        
        $indiceDoValor  = $indiceDoValor + 1;
        $indiceResposta = $indiceResposta + 1;
        $valor          = 0;
    }
    
    
    for ($i = 0; $i < 5; $i++) {
        
        echo "<br>";
        echo "<b>A" . ($i + 1) . ") </b>" . $enunciado[$i], " = ", $valores[$i], " voto(s)";
    }
    
}
*/

?>

</body>

</html>
