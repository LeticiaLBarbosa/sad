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


for ($i = 0; $i < 15; $i++) {
    
    $quesito = "Q" . ($i + 1);
    
    echo "<a href=imprimeQuesito.php?quesito=$i>$quesito</a> &nbsp; &nbsp;";
    
}

?>

<?php



include "config.php";
echo "1";
include "geraMediaPorQuesito.php";
echo "2";
include "csvFunction.php";
echo "3";
include "geraQuesito.php"
echo "4";
/*
    if ($i == $quesito && $quesito < 13) {
		
		echo "<br>";
        		
		$arrayMediasQuesito = geraMediasQuesitos();
        echo '<a target="_top" href="help.php" >Pontuação</a>',": ","<b>",stringScore($ValorRespostas),"</b>";
       	
       	echo "<br>";   

		echo "<br>";
		echo "<b>Ranking do sua pontuação nesse quesito </b>:";
                
        
            echo '<iframe
                name="Ranking"
                width="100%"
                height="23%"
                src="geraRanking.php"
                scrolling="no"
                frameborder="0"
                >
                </iframe> ';
        
        
        
        
        	 echo 
	'<p class="button">
		<button id="button1" class="buttonControl" aria-controls="t1"><span>Mostrar</span> Comentários</button>
	</p>

	<div id="t1" class="topic" role="region" aria-labelledby="t1-label" tabindex="-1" aria-expanded="false">'
	;
		

				echo '<iframe
					name="iframe1"
					width="100%"
					height="30%"
				src="geraComments.php?questao=' . $i . '&disciplina_id=' . $disciplina_id . '"
				frameborder="yes"
				scrolling="yes">
			</iframe>';

		
	echo '</div>';
        
                
        echo "</p>";
    }
        
   

        
        
    $indiceResposta = $indiceResposta + 2;
    $QqidQuestao    = $QqidQuestao + 1;
    
}

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
