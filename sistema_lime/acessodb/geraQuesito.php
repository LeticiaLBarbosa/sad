<?php
echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>';

// Iniciando conexao ao BD e gerando variaveis essenciais
$id  = mysql_connect($host, $login_db, $senha_db);
$con = mysql_select_db($database, $id);


$quesito = 1;

$q = (int) $quesito;
$q +=1;

$disciplina_id = 54288;

$Respostas = array();


$indiceResposta = 6; // Representa o indice da resposta, tratando a tabela do BD como uma matriz
$lacoResposta   = 0;
$valores        = array();

$ValorRespostas                      = array();

// Criando a vÃ¡riavel QqidQuestao que leva a referencia de qid para a consulta sql3 que separa as resposta de cada questÃ£o
$sql         = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid ";
$res         = mysql_query($sql, $id);
$row         = mysql_fetch_array($res);
$QqidQuestao = $row["qid"];


// Adicionando os títulos das questoes
$TituloRespostas[0] = "Os pré-requisitos assumidos pela disciplina foram adequados?";
$TituloRespostas[1] = "O programa da disciplina está de acordo com a ementa da mesma?";
$TituloRespostas[2] = "A metodologia usada pelo professor (recursos didáticos, atividades dentro e fora de sala de aula) teve qual impacto no aprendizado?";
$TituloRespostas[3] = "A bibliografia apresentada teve qual impacto no seu aprendizado?";
$TituloRespostas[4] = "Qual é o nível de domínio do assunto pelo professor?";
$TituloRespostas[5] = "O método de avaliação foi apropriado para o conteúdo da disciplina?";
$TituloRespostas[6] = "Na sua opinião, quanto do material ministrado na disciplina você aprendeu bem?";
$TituloRespostas[7] = "Como você avalia a pontualidade do professor?";
$TituloRespostas[8] = "Como você avalia a assiduidade do professor?";
$TituloRespostas[9] = "Para as aulas que o professor faltou (no caso, faltas não previstas no cronograma da disciplina), houve reposição em outros horários?";
$TituloRespostas[10] = 'Como o professor equilibrou teoria/prática na disciplina (em disciplinas de laboratório, considere como "teoria" a orientação do professor para os exercícios)?';
$TituloRespostas[11] = "A comunicação da turma com o professor tem qual nível de qualidade?";
$TituloRespostas[12] = "O professor demonstra preocupação com o aprendizado dos alunos?";
$TituloRespostas[13] = "Como você avalia a infra-estrutura da sala de aula (ou laboratório)?";
$TituloRespostas[14] = "Quais os tipos de problema mais sérios que você detectou durante esta disciplina (checkboxes, podendo escolher mais de um)?";

// Adicionando as respostas em uma especie de matriz

$Respostas[0][0] = "Totalmente";
$Respostas[0][1] = "Parcialmente, mas o professor ministrou o conteúdo que faltava"; 
$Respostas[0][2] = "Parcialmente";
$Respostas[0][3] = "Pouco";
$Respostas[0][4] = "Absolutamente, tive que estudar por conta própria o conteúdo que deveria ter sido dado em disciplinas anteriores";
$Respostas[1][0] = "Totalmente";
$Respostas[1][1] = "Quase totalmente";
$Respostas[1][2] = "Neutro";
$Respostas[1][3] = "Muito pouco";
$Respostas[1][4] = "Em desacordo";
$Respostas[2][0] = "Muito bom, facilitou o aprendizado";
$Respostas[2][1] = "Bom";
$Respostas[2][2] = "Não teve impacto";
$Respostas[2][3] = "Ruim";
$Respostas[2][4] = "Muito ruim";
$Respostas[3][0] = "Muito alto, continha tudo que era necessário, básico e avançado";
$Respostas[3][1] = "Acima da média";
$Respostas[3][2] = "Mediano: supriu o básico";
$Respostas[3][3] = "Ruim: precisei procurar material adicional";
$Respostas[3][4] = "Muito ruim, substituí completamente por outro material";
$Respostas[4][0] = "Muito alto";
$Respostas[4][1] = "Alto";
$Respostas[4][2] = "Médio";
$Respostas[4][3] = "Regular, com certa insegurança";
$Respostas[4][4] = "Fraco, com total insegurança";
$Respostas[5][0] = "Ideal";
$Respostas[5][1] = "Apropriado";
$Respostas[5][2] = "Indiferente";
$Respostas[5][3] = "Inapropriado em alguns aspectos";
$Respostas[5][4] = "Completamente inapropriado";
$Respostas[6][0] = "80-100%";
$Respostas[6][1] = "60-80%";
$Respostas[6][2] = "40-60%";
$Respostas[6][3] = "20-40%";
$Respostas[6][4] = "0-20%";
$Respostas[7][0] = "Ótima";
$Respostas[7][1] = "Boa";
$Respostas[7][2] = "Média";
$Respostas[7][3] = "Abaixo da média";
$Respostas[7][4] = "Péssima";
$Respostas[8][0] = "Ótima";
$Respostas[8][1] = "Boa";
$Respostas[8][2] = "Média";
$Respostas[8][3] = "Abaixo da média";
$Respostas[8][4] = "Péssima";
$Respostas[9][0] = "Não precisou, não houve faltas";
$Respostas[9][1] = "Sempre houve reposição das faltas";
$Respostas[9][2] = "Houve substituição";
$Respostas[9][3] = "Parcialmente";
$Respostas[9][4] = "Não houve reposição das aulas perdidas";
$Respostas[10][0] = "Bem equilibrada, ilustrando a teoria com exemplos e exercícios";
$Respostas[10][1] = "Equilibrada";
$Respostas[10][2] = "Equilibrada, mas usou poucos exemplos e exercícios";
$Respostas[10][3] = "Predominância de teoria";
$Respostas[10][4] = "Apenas teoria, praticamente sem exemplos e exercícios";
$Respostas[11][0] = "Muito fácil";
$Respostas[11][1] = "Fácil";
$Respostas[11][2] = "Regular";
$Respostas[11][3] = "Ruim";
$Respostas[11][4] = "Péssima";
$Respostas[12][0] = "Sempre";
$Respostas[12][1] = "Nem sempre";
$Respostas[12][2] = "Neutro";
$Respostas[12][3] = "Quase nunca";
$Respostas[12][4] = "Nunca";
$Respostas[13][0] = "Muito boa";
$Respostas[13][1] = "Boa";
$Respostas[13][2] = "Regular";
$Respostas[13][3] = "Ruim";
$Respostas[13][4] = "Péssima";
$Respostas[14][0] = "Climatização";
$Respostas[14][1] = "Recursos didáticos (quadro, datashow, etc.)";
$Respostas[14][2] = "Mobiliário (cadeiras, mesas, etc.)";
$Respostas[14][3] = "Limpeza";
$Respostas[14][4] = "Ambiente (sala)";


// Array de medias
// Laco referente as perguntas de cada disciplina
// Codigo abaixo Pega todas as questÃµes

$range = $quesito;

if ($range == 14) {
    $range = 13;
}

for ($i = 0; $i < $range + 1; $i++) {
    
    $valorA1 = 0;
    $valorA2 = 0;
    $valorA3 = 0;
    $valorA4 = 0;
    $valorA5 = 0;
    
    $tabela = "lime_survey_" . $disciplina_id;
    
    $sql2   = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid and q.qid = $QqidQuestao";
    
    $res2   = mysql_query($sql2, $id);
    $sql3   = "SELECT * FROM $tabela";
    $res3   = mysql_query($sql3, $id);
    $row1   = mysql_fetch_array($res1);
    
    $tituloQ = utf8_encode($row1[0]);
	echo $tituloQ, " aqui";

	if ($i == $quesito) {
		echo "<br>";
		echo "<br>";
		echo "<b>", ($quesito + 1), " - ", $tituloQ, "</b>";
	
    }
}

echo "passouuu";
for ($k = 0; $k < 15; $k ++){
	for ($j = 0; $j < 5; $j ++){
		echo $Respostas[$k][$j];
		echo "<br>";
	}
}
echo "fim";
?>