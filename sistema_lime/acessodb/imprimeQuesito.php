<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
   <script type="text/javascript" src="../ranking/d3.v3.js"></script>
   <script type="text/javascript" src="../ranking/ranking.js"></script>
</head>

<body onload="loadData();">


<?php


for ($i = 0; $i < 15; $i++) {
   
   $quesito = "Q".($i + 1);

echo "<a href=imprimeQuesito.php?quesito=$i>$quesito</a> &nbsp; &nbsp;" ;

}

?>

<?php

//        function imprimeQuesito($quesito){
        
                
                include "config.php";
                include "geraMediaPorQuesito.php";
                include "csvFunction.php";
                
                // Iniciando conexao ao BD e gerando variaveis essenciais
                $id = mysql_connect ( $host, $login_db, $senha_db );
                $con = mysql_select_db ( $database, $id );
                
                
                $quesito = $_GET['quesito'];
                $disciplina_id = $_COOKIE['disciplina_id'];


               // setcookie('disciplina_id',$disciplina_id);
                
                $indiceResposta = 5;
                $lacoResposta = 0;
                $valores = array ();
                
                $TituloRespostas = array ();
                $ValorRespostas = array ();
                $indiceArrayTituloRespostas = 0;
                $indiceArrayTituloRespostasImpressao = 0;
                
                // Criando a vÃ¡riavel QqidQuestao que leva a referencia de qid para a consulta sql3 que separa as resposta de cada questÃ£o
                $sql = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid ";
                $res = mysql_query ( $sql, $id );
                $row = mysql_fetch_array ( $res );
                $QqidQuestao = $row ["qid"];
                
                // Consulta para exibir as questÃµes
                $sql1 = "SELECT question FROM `lime_questions` WHERE sid = $disciplina_id";
                $res1 = mysql_query ( $sql1, $id );
                
                
                // Array de medias
                // Laco referente as perguntas de cada disciplina
                // Codigo abaixo Pega todas as questÃµes

                $range = $quesito;

                if($range == 14){
                        $range = 13;
                }
                
                for($i = 0; $i < $range + 1; $i ++) {
                        
                        $valorA1 = 0;
                        $valorA2 = 0;
                        $valorA3 = 0;
                        $valorA4 = 0;
                        $valorA5 = 0;
                        
                        $tabela = "lime_survey_" . $disciplina_id;
                        $sql2 = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid and q.qid = $QqidQuestao";
                        $res2 = mysql_query ( $sql2, $id );
                        $sql3 = "SELECT * FROM $tabela";
                        $res3 = mysql_query ( $sql3, $id );
                        $row1 = mysql_fetch_array ( $res1 );
                        
                        $tituloQ = utf8_encode ( $row1 [0] );
                        if ($i == $quesito) {
                           echo "<br>";
                           echo "<br>";
                           echo "<br>";
                           echo "<b>", ($quesito + 1), " - ", $tituloQ, "</b>";
                           
                           echo '<a href="javascript:plot_bar_disciplina_ranking('."'EDA'".', '."'Q2'".');">Ranking...</a>
                                    <div id="infos" class="plot-info2" style="text-align:left; font-size : 14px;">
                                      </div>';
                           
                        }
                        
                        $valores [$tituloQ] = array ();
                        // echo $valores[$tituloQ];
                        
                        // Laco que pega o titulo de cada resposta e salva no array $TituloRespostas
                        while ( $row2 = mysql_fetch_array ( $res2 ) ) {
                                $TituloRespostas [$indiceArrayTituloRespostas] = utf8_encode ( $row2 ["answer"] );
                                $indiceArrayTituloRespostas = $indiceArrayTituloRespostas + 1;
                        }
                        
                        $indiceArrayTituloRespostas = 0;
                        
                        // Laco que anda pelas linhas contando a quantidade de respostas
                        while ( $row3 = mysql_fetch_array ( $res3 ) ) {
                                
                                if ($row3 [$indiceResposta] == "A1") {
                                        $valorA1 += 1;
                                }
                                if ($row3 [$indiceResposta] == "A2") {
                                        $valorA2 += 1;
                                }
                                if ($row3 [$indiceResposta] == "A3") {
                                        $valorA3 += 1;
                                }
                                if ($row3 [$indiceResposta] == "A4") {
                                        $valorA4 += 1;
                                }
                                if ($row3 [$indiceResposta] == "A5") {
                                        $valorA5 += 1;
                                }
                        }
                        
                        $ValorRespostas [0] = $valorA1;
                        $ValorRespostas [1] = $valorA2;
                        $ValorRespostas [2] = $valorA3;
                        $ValorRespostas [3] = $valorA4;
                        $ValorRespostas [4] = $valorA5;
                        $indiceTituloRespostas = 0;
                        
                        if ($i == $quesito) {
                        //        echo "<br>";
                 //               echo '<img src="geraGraficoFelipe.php?value1=' . $valorA1 . '&value2=' . $valorA2 . '&value3=' . $valorA3 . '&value4=' . $valorA4 . '&value5=' . $valorA5 . '" align="left" >';
                                echo "<p>";
                                echo "<br>";
                                echo "<br>";        
                                 
                                
                                if($i < 13){
                                        $arrayMediasQuesito = geraMediasQuesitos();
                                        echo utf8_encode ("Média do DSC: "). $arrayMediasQuesito[$i] . " || " . utf8_encode ("Sua Média: ") . media($ValorRespostas);
                                }
                        
                                echo "<br>";
                                echo "<br>";
                        
                        }
                        
                        // Laco que imprime as respostas e o valor delas
                        while ( $TituloRespostas [0] != null ) {
                                $valores [$tituloQ] [$TituloRespostas [0]] = $ValorRespostas [$indiceTituloRespostas];
                                        if ($i == $quesito) {
                                                       echo $valores [$tituloQ] [$indiceArray];
                                        echo "<b>A", ($indiceTituloRespostas + 1), ") </b>", $TituloRespostas [0], " = ", $ValorRespostas [$indiceTituloRespostas];
                                        echo "<br>";
                                        }                
                                array_shift ( $TituloRespostas );
                                $indiceTituloRespostas = $indiceTituloRespostas + 1;
                        }
                        
                        if ($i == $quesito) {
                        
                                //echo "<br>";
                                //echo "<br>";
                                echo "<br>";
                                
                                echo "<b>".utf8_encode ("Comentários:")." </b><br>";        
                                echo '<iframe
                                name="iframe1"
                                width="600"
                                height="200"
                                src="geraComments.php?questao='.$i. '&disciplina_id='. $disciplina_id.'"
                                frameborder="yes"
                                scrolling="yes">
                                </iframe>';
                                
                                echo "<br>";
                                //echo "<a href=geraComments.php?questao=".$i. "&disciplina_id=". $disciplina_id."> Ver Mais</a>";
                                echo "<br>";
                                echo "<br>";
                                echo "<br>";
                                
                        
                                echo "</p>";
                        }
                        
                        //$lacoResposta = $lacoResposta + 1;
                        $indiceResposta = $indiceResposta + 2;
                        $QqidQuestao = $QqidQuestao + 1;
                        //$indiceQuestao = $indiceQuestao + 1;
                }

                // Gerando impressao para ultima pergunta e as respostas dela, ja que a logica eh diferente
                
                if ($i == $quesito) {
                
                        $row1 = mysql_fetch_array ( $res1 );
                        
                        echo "<br>";
                        echo "15 - ", utf8_encode ( $row1 [0] );
                        echo "<br>";
                        
                        $valor = 0;
                        
                        $indiceDoValor = 0; // so pra alternar
                        
                        $valores = array ();
                        $enunciado = array ();
                        
                        
                        while ( $row1 = mysql_fetch_array ( $res1 ) ) {
                                $res3 = mysql_query ( $sql3, $id );
                                
                                while ( $row3 = mysql_fetch_array ( $res3 ) ) {
                                        if ($row3 [$indiceResposta] == "Y") {
                                                $valor = $valor + 1;
                                        }
                                }
                                        
                                $valores [$indiceDoValor] = $valor;
                                $enunciado [$indiceDoValor] = utf8_encode ( $row1 [0] );
                                
                                $indiceDoValor = $indiceDoValor + 1;
                                $indiceResposta = $indiceResposta + 1;
                                $valor = 0;
                        }
                        
                        
                        for($i = 0; $i < 5; $i ++) {
                                
                                echo "<br>";
                                echo "<b>A" . ($i + 1) . ") </b>" . $enunciado [$i], " = ", $valores [$i];
                        }
                        
                }
//}

?>

</body>

</html>
