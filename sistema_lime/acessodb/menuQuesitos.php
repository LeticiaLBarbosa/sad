<html>
<head>
<!--<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
-->
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
</head>

<body>

<br>
<p>
Este gráfico, chamado de Radar Plot, é muito usado para representar observações multivariadas que envolvem diversas variáveis, onde cada "estrela" (formada pela ligação entre os pontos que determinam os valores das variáveis do gráfico para cada observação) representa uma observação.
No caso dos dados da avaliação, a estrela de cor laranja representa a média do professor em cada quesito avaliado de uma dada disciplina ministrada por ele no semestre corrente; já a estrela de cor azul representa as maiores médias de cada quesito para todas as disciplinas oferecidas pelo departamento no semestre corrente; e a estrela de cor verde representa as menores médias de cada quesito para todas as disciplinas oferecidas pelo departamento no semestre corrente. Dessa forma é possível comparar o desempenho do professor em uma disciplina em relação aos resultados obtidos na avaliação docente do departamento no semestre corrente.
<br>
<br>
Os quesitos usados para avaliar cada disciplina estão listados abaixo e para obter mais detalhes basta clicar no identificador de cada quesito:
</p>

<br>

                
<?php



for ($i = 0; $i < 15; $i++) {
   
   $quesito = "Q".($i + 1);

echo "<a href=imprimeQuesito.php?quesito=$i>$quesito</a>  ";}

?>





</body>

</html>
