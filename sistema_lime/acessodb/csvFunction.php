<?php


// Iniciando conexao ao BD e gerando variÃ~CÂ¡veis essenciaisis
// VariÃ~CÂ¡vel com o id da disciplina em questÃ~CÂ£o
function mediasPorQuesito($disciplina_id) {
	include "config.php";

	$id = mysql_connect ( $host, $login_db, $senha_db );
	$con = mysql_select_db ( $database, $id );


	$linhaMontada = $disciplina_id.",";
	
	$medias = array ();
	$indiceResposta = 5;
	$lacoResposta = 0;
	$valores = array ();
	
	$TituloRespostas = array ();
	$ValorRespostas = array ();
	$indiceArrayTituloRespostas = 0;
	$indiceArrayTituloRespostasImpressao = 0;
	
	// Criando a vÃ~CÂ¡riavel QqidQuestao que leva a referencia de qid para a consulta sql3 que separa as resposta de cada questÃ~CÂ£o
	$sql = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid ";
	$res = mysql_query ( $sql, $id );
	$row = mysql_fetch_array ( $res );
	$QqidQuestao = $row ["qid"];
	
	// Consulta para exibir as questÃ~CÂµes
	$sql1 = "SELECT question FROM `lime_questions` WHERE sid = $disciplina_id";
	$res1 = mysql_query ( $sql1, $id );
	
	// Laco referente as perguntas de cada disciplina
	// Codigo abaixo Pega todas as questÃ~CÂµes
	
	for($i = 0; $i < 13; $i ++) {
		
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
		
		$valores [$tituloQ] = array (); // Laco que pega o titulo de cada resposta e salva no array $TituloRespostas
		while ( $row2 = mysql_fetch_array ( $res2 ) ) {
			$TituloRespostas [$indiceArrayTituloRespostas] = utf8_encode ( $row2 ["answer"] );
			$indiceArrayTituloRespostas = $indiceArrayTituloRespostas + 1;
		}
		
		$indiceArrayTituloRespostas = 0; // Laco que anda pelas linhas contando a quantidade de respostas while ($row3 = mysql_fetch_array($res3) ){
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
		
		if ($i == 12) {
			$linhaMontada .= media ( $ValorRespostas );
		} else {
			$linhaMontada .= media ( $ValorRespostas ) . ",";
		}
		
		// Laco que imprime as respostas e o valor delas
		while ( $TituloRespostas [0] != null ) {
			$valores [$tituloQ] [$TituloRespostas [0]] = $ValorRespostas [$indiceTituloRespostas];
			
			array_shift ( $TituloRespostas );
			$indiceTituloRespostas = $indiceTituloRespostas + 1;
		}
		
		$lacoResposta = $lacoResposta + 1;
		$indiceResposta = $indiceResposta + 2;
		$QqidQuestao = $QqidQuestao + 1;
		$indiceQuestao = $indiceQuestao + 1;
	}
	
	return $linhaMontada;

}

function media($respostas) {
	$totalRespostas = array_sum ( $respostas );
	
	$peso = 4;
	
	for($i = 0; $i < 5; $i ++) {
		
		$respostas [$i] = $respostas [$i] * ($peso);
		$peso --;
	}
	
	return round( (array_sum ( $respostas ) / $totalRespostas), 2);
}


?>


