<?php
echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>';

include "config.php";

// Iniciando conexao ao BD e gerando variaveis essenciais
$id  = mysql_connect($host, $login_db, $senha_db);
$con = mysql_select_db($database, $id);

// Pega a questao que esta sendo acessada
$quesito = $_GET['quesito'];

$q = (int) $quesito;
$q += 1;
setcookie('quesito', "Q".$q);

$disciplina_id = $_COOKIE['disciplina_id'];


// Consulta para exibir as questÃµes
$sql1 = "SELECT question FROM `lime_questions` WHERE sid = $disciplina_id";
$res1 = mysql_query($sql1, $id);

$indiceResposta = 6; // Representa o indice da resposta, tratando a tabela do BD como uma matriz

$TituloQuestoes = array();
$TituloRespostas = array();
$ValorRespostas = array();
$indiceTituloRespostas = 0;

// Adicionando os títulos das questoes
$TituloQuestoes[0] = "Os pré-requisitos assumidos pela disciplina foram adequados?";
$TituloQuestoes[1] = "O programa da disciplina está de acordo com a ementa da mesma?";
$TituloQuestoes[2] = "A metodologia usada pelo professor (recursos didáticos, atividades dentro e fora de sala de aula) teve qual impacto no aprendizado?";
$TituloQuestoes[3] = "A bibliografia apresentada teve qual impacto no seu aprendizado?";
$TituloQuestoes[4] = "Qual é o nível de domínio do assunto pelo professor?";
$TituloQuestoes[5] = "O método de avaliação foi apropriado para o conteúdo da disciplina?";
$TituloQuestoes[6] = "Na sua opinião, quanto do material ministrado na disciplina você aprendeu bem?";
$TituloQuestoes[7] = "Como você avalia a pontualidade do professor?";
$TituloQuestoes[8] = "Como você avalia a assiduidade do professor?";
$TituloQuestoes[9] = "Para as aulas que o professor faltou (no caso, faltas não previstas no cronograma da disciplina), houve reposição em outros horários?";
$TituloQuestoes[10] = 'Como o professor equilibrou teoria/prática na disciplina (em disciplinas de laboratório, considere como "teoria" a orientação do professor para os exercícios)?';
$TituloQuestoes[11] = "A comunicação da turma com o professor tem qual nível de qualidade?";
$TituloQuestoes[12] = "O professor demonstra preocupação com o aprendizado dos alunos?";
$TituloQuestoes[13] = "Como você avalia a infra-estrutura da sala de aula (ou laboratório)?";
$TituloQuestoes[14] = "Quais os tipos de problema mais sérios que você detectou durante esta disciplina (checkboxes, podendo escolher mais de um)?";

// Adicionando as respostas em uma especie de matriz

$TituloRespostas[0][0] = "Totalmente";
$TituloRespostas[0][1] = "Parcialmente, mas o professor ministrou o conteúdo que faltava"; 
$TituloRespostas[0][2] = "Parcialmente";
$TituloRespostas[0][3] = "Pouco";
$TituloRespostas[0][4] = "Absolutamente, tive que estudar por conta própria o conteúdo que deveria ter sido dado em disciplinas anteriores";
$TituloRespostas[1][0] = "Totalmente";
$TituloRespostas[1][1] = "Quase totalmente";
$TituloRespostas[1][2] = "Neutro";
$TituloRespostas[1][3] = "Muito pouco";
$TituloRespostas[1][4] = "Em desacordo";
$TituloRespostas[2][0] = "Muito bom, facilitou o aprendizado";
$TituloRespostas[2][1] = "Bom";
$TituloRespostas[2][2] = "Não teve impacto";
$TituloRespostas[2][3] = "Ruim";
$TituloRespostas[2][4] = "Muito ruim";
$TituloRespostas[3][0] = "Muito alto, continha tudo que era necessário, básico e avançado";
$TituloRespostas[3][1] = "Acima da média";
$TituloRespostas[3][2] = "Mediano: supriu o básico";
$TituloRespostas[3][3] = "Ruim: precisei procurar material adicional";
$TituloRespostas[3][4] = "Muito ruim, substituí completamente por outro material";
$TituloRespostas[4][0] = "Muito alto";
$TituloRespostas[4][1] = "Alto";
$TituloRespostas[4][2] = "Médio";
$TituloRespostas[4][3] = "Regular, com certa insegurança";
$TituloRespostas[4][4] = "Fraco, com total insegurança";
$TituloRespostas[5][0] = "Ideal";
$TituloRespostas[5][1] = "Apropriado";
$TituloRespostas[5][2] = "Indiferente";
$TituloRespostas[5][3] = "Inapropriado em alguns aspectos";
$TituloRespostas[5][4] = "Completamente inapropriado";
$TituloRespostas[6][0] = "80-100%";
$TituloRespostas[6][1] = "60-80%";
$TituloRespostas[6][2] = "40-60%";
$TituloRespostas[6][3] = "20-40%";
$TituloRespostas[6][4] = "0-20%";
$TituloRespostas[7][0] = "Ótima";
$TituloRespostas[7][1] = "Boa";
$TituloRespostas[7][2] = "Média";
$TituloRespostas[7][3] = "Abaixo da média";
$TituloRespostas[7][4] = "Péssima";
$TituloRespostas[8][0] = "Ótima";
$TituloRespostas[8][1] = "Boa";
$TituloRespostas[8][2] = "Média";
$TituloRespostas[8][3] = "Abaixo da média";
$TituloRespostas[8][4] = "Péssima";
$TituloRespostas[9][0] = "Não precisou, não houve faltas";
$TituloRespostas[9][1] = "Sempre houve reposição das faltas";
$TituloRespostas[9][2] = "Houve substituição";
$TituloRespostas[9][3] = "Parcialmente";
$TituloRespostas[9][4] = "Não houve reposição das aulas perdidas";
$TituloRespostas[10][0] = "Bem equilibrada, ilustrando a teoria com exemplos e exercícios";
$TituloRespostas[10][1] = "Equilibrada";
$TituloRespostas[10][2] = "Equilibrada, mas usou poucos exemplos e exercícios";
$TituloRespostas[10][3] = "Predominância de teoria";
$TituloRespostas[10][4] = "Apenas teoria, praticamente sem exemplos e exercícios";
$TituloRespostas[11][0] = "Muito fácil";
$TituloRespostas[11][1] = "Fácil";
$TituloRespostas[11][2] = "Regular";
$TituloRespostas[11][3] = "Ruim";
$TituloRespostas[11][4] = "Péssima";
$TituloRespostas[12][0] = "Sempre";
$TituloRespostas[12][1] = "Nem sempre";
$TituloRespostas[12][2] = "Neutro";
$TituloRespostas[12][3] = "Quase nunca";
$TituloRespostas[12][4] = "Nunca";
$TituloRespostas[13][0] = "Muito boa";
$TituloRespostas[13][1] = "Boa";
$TituloRespostas[13][2] = "Regular";
$TituloRespostas[13][3] = "Ruim";
$TituloRespostas[13][4] = "Péssima";
$TituloRespostas[14][0] = "Climatização";
$TituloRespostas[14][1] = "Recursos didáticos (quadro, datashow, etc.)";
$TituloRespostas[14][2] = "Mobiliário (cadeiras, mesas, etc.)";
$TituloRespostas[14][3] = "Limpeza";
$TituloRespostas[14][4] = "Ambiente (sala)";


// Array de medias
// Laco referente as perguntas de cada disciplina
// Codigo abaixo Pega todas as questÃµes

$range = $quesito;

if ($range == 14) {
    $range = 13;
}

// Laço que imprime o titulo da questão ate a questao 14
for ($i = 0; $i < $range + 1; $i++) {

	if ($i == $quesito) {
		echo "<br>";
		echo "<br>";
		echo "<b>", ($quesito + 1), " - ", $TituloQuestoes[$i], "</b>";
		echo "<br>";
		echo "<br>";
	
    }
	
	$valorA1 = 0;
    $valorA2 = 0;
    $valorA3 = 0;
    $valorA4 = 0;
    $valorA5 = 0;
	
	$tabelaDisciplina = "lime_survey_" . $disciplina_id;
    $sql3   = "SELECT * FROM $tabelaDisciplina";
    $res3   = mysql_query($sql3, $id);
	
	// Laco que anda pelas linhas contando a quantidade de respostas
	while ($row3 = mysql_fetch_array($res3)) {
        
        if ($row3[$indiceResposta] == "A1") {
            $valorA1 += 1;
        }
        if ($row3[$indiceResposta] == "A2") {
            $valorA2 += 1;
        }
        if ($row3[$indiceResposta] == "A3") {
            $valorA3 += 1;
        }
        if ($row3[$indiceResposta] == "A4") {
            $valorA4 += 1;
        }
        if ($row3[$indiceResposta] == "A5") {
            $valorA5 += 1;
        }
    }
    
    $ValorRespostas[0] = $valorA1;
    $ValorRespostas[1] = $valorA2;
    $ValorRespostas[2] = $valorA3;
    $ValorRespostas[3] = $valorA4;
    $ValorRespostas[4] = $valorA5;
	
	$indiceResposta = $indiceResposta + 2;
	
	// Laco que imprime as respostas e o valor delas
	if ($i == $quesito) {
		for ($j = 0; $j < 5; $j ++){
			echo "<b>A", ($j + 1), ") </b>", $TituloRespostas[$quesito][$j], " = ", $ValorRespostas[$indiceTituloRespostas], " voto(s)";
			echo "<br>";
			$indiceTituloRespostas = $indiceTituloRespostas + 1;
		}
		
		// Condição para imprimir as pontuações (a 14 e 15 não entram, pois é de infraestrutura)
		if ($i < 13) {
			$arrayMediasQuesito = geraMediasQuesitos();
			echo "<br>";
			echo '<a target="_top" href="help.php" >Pontuação</a>',": ","<b>",stringScore($ValorRespostas),"</b>";
			echo "<br>";   
			echo "<br>";
			echo "<b>Ranking de sua pontuação nesse quesito </b>:";
                
        
            echo '<iframe
                name="Ranking"
                width="100%"
                height="23%"
                src="geraRanking.php"
                scrolling="no"
                frameborder="0"
                >
                </iframe> ';
        }
		
		// Iframe com os comentarios
        
		echo '<p class="button"><button id="button1" class="buttonControl" aria-controls="t1"><span>Mostrar</span> Comentários</button></p>
			<div id="t1" class="topic" role="region" aria-labelledby="t1-label" tabindex="-1" aria-expanded="false">';

		echo '<iframe
			name="iframe1"
			width="100%"
			height="30%"
			src="geraComments.php?questao=' . $i . '&disciplina_id=' . $disciplina_id . '"
			frameborder="yes"
			scrolling="yes">
			</iframe>';

		echo '</div>';
			
	}
	
}

// Gerando impressao para ultima pergunta e as respostas dela, ja que a logica eh diferente
if ($i == $quesito) {
    
    $row1 = mysql_fetch_array($res1);
    echo "<br>";
    echo "<br>";
	echo "<b>", ($quesito + 1), " - ", $TituloQuestoes[$i], "</b>";
    echo "<br>";
    echo "<br>";

    
    $valor = 0;
    
    $indiceDoValor = 0; // so pra alternar
    
    $valores   = array();    
    
    while ($row1 = mysql_fetch_array($res1)) {
        $res3 = mysql_query($sql3, $id);
        
        while ($row3 = mysql_fetch_array($res3)) {
            if ($row3[$indiceResposta] == "Y") {
                $valor = $valor + 1;
            }
        }
        
        $valores[$indiceDoValor]   = $valor;
        
        $indiceDoValor  = $indiceDoValor + 1;
        $indiceResposta = $indiceResposta + 1;
        $valor          = 0;
    }
    
      // Laço que imprime as respostas e seus votos    
    for ($i = 0; $i < 5; $i++) {   
        echo "<br>";
        echo "<b>A" . ($i + 1) . ") </b>" . $TituloRespostas[$quesito][$i], " = ", $valores[$i], " voto(s)";
    }
    
}


?>