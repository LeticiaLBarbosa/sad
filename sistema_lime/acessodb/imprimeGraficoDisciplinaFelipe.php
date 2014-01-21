<html>
<title>Informacoes Disciplina</title>
<head>
<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="RadarChart.js"></script>


<?php
$disciplina_id = $_GET ['disciplina_id'];
setcookie('disciplina_id',$disciplina_id);

?>
</head>

<body>
        <div id='banner' align='center'>
                <img style='display: block; margin-left: auto; margin-right: auto'
                        bgcolor='black' src='../imagens/ba.jpg'>
        </div>

        </p>

        <div id="cssmenu">
                <ul>
                        <li><a href="sessao.php">Meus dados</a></li>
                        <li><a href="../usuario/logout.php">Sair</a></li>

                </ul>

        </div>
        
   <div id="body">
          <div id="chart"></div>
    </div>
	
    <iframe
	name="iframe2"
	width="100"
	height="200"
	src="radar.html"
	frameborder="yes"
	>
	</iframe>        

<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>

<?php
include "config.php";
include "geraMediaPorQuesito.php";
include "csvFunction.php";


echo "aqui 2";
print "aqui 3";


// Iniciando conexao ao BD e gerando variaveis essenciais
$id = mysql_connect ( $host, $login_db, $senha_db );
$con = mysql_select_db ( $database, $id );

// Variavel com o id da disciplina em questao
$disciplina_id = $_GET ['disciplina_id'];

setcookie('disciplina_id',$disciplina_id);

$indiceResposta = 5;
$lacoResposta = 0;
$valores = array ();

$TituloRespostas = array ();
$ValorRespostas = array ();
$indiceArrayTituloRespostas = 0;
$indiceArrayTituloRespostasImpressao = 0;

// Criando a váriavel QqidQuestao que leva a referencia de qid para a consulta sql3 que separa as resposta de cada questão
$sql = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid ";
$res = mysql_query ( $sql, $id );
$row = mysql_fetch_array ( $res );
$QqidQuestao = $row ["qid"];

// Consulta para exibir as questões
$sql1 = "SELECT question FROM `lime_questions` WHERE sid = $disciplina_id";
$res1 = mysql_query ( $sql1, $id );


// Array de medias



// Laco referente as perguntas de cada disciplina
// Codigo abaixo Pega todas as questões

// Deconsidero as 5 ultimas questoes
for($i = 0; $i < 14; $i ++) {
        
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
        
        echo "<br>";
        echo "<b>", ($i + 1), " - ",  $tituloQ, "</b>";
        echo "<br>";
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
        
        echo '<img src="geraGraficoFelipe.php?value1=' . $valorA1 . '&value2=' . $valorA2 . '&value3=' . $valorA3 . '&value4=' . $valorA4 . '&value5=' . $valorA5 . '" align="left" >';
        
        echo "<p>";
        
        echo "<br>";
        echo "<br>";
        
        if($i < 13){

                $arrayMediasQuesito = geraMediasQuesitos();
                echo utf8_encode ("<b>M?dia do DSC: </b>").  $arrayMediasQuesito[$i]  . " || " .  utf8_encode ("<b>Sua M?dia: </b>") . media($ValorRespostas);
        }

        echo "<br>";
        echo "<br>";

        
        // Laco que imprime as respostas e o valor delas
        while ( $TituloRespostas [0] != null ) {
                
                $valores [$tituloQ] [$TituloRespostas [0]] = $ValorRespostas [$indiceTituloRespostas];
                
                echo $valores [$tituloQ] [$indiceArray];
                
                echo "<b>A", ($indiceTituloRespostas + 1), ") </b>", $TituloRespostas [0], " = ", $ValorRespostas [$indiceTituloRespostas];
                echo "<br>";
                
                array_shift ( $TituloRespostas );
                $indiceTituloRespostas = $indiceTituloRespostas + 1;
        }
        
        
        
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        echo "<b>".utf8_encode ("Coment?rios:")." </b><br>";        
        echo  '<iframe
        name="iframe1"
        width="600"
        height="200"
        src="geraComments.php?questao='.$i. '&disciplina_id='. $disciplina_id.'"
        frameborder="yes"
        scrolling="yes">
        </iframe>';
        
        echo "<a href=geraComments.php?questao=".$i. "&disciplina_id=". $disciplina_id."> Ver Mais</a>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        

        echo "</p>";
        
        //$lacoResposta = $lacoResposta + 1;
        $indiceResposta = $indiceResposta + 2;
        $QqidQuestao = $QqidQuestao + 1;
        //$indiceQuestao = $indiceQuestao + 1;
}

// Gerando impressao para ultima pergunta e as respostas dela, ja que a logica eh diferente
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

echo '<img src="geraGraficoFelipe.php?value1=' . $valores [0] . '&value2=' . $valores [1] . '&value3=' . $valores [2] . '&value4=' . $valores [3] . '&value5=' . $valores [4] . '" align="left" >';

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

for($i = 0; $i < 5; $i ++) {
        
        echo "<br>";
        echo "<b>A" . ($i + 1) . ") </b>" . $enunciado [$i], " = ", $valores [$i];
}

?>
<br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2>
                <a href="http://pdfcrowd.com/url_to_pdf/">Fazer download em PDF</a>
        </h2>

</html>