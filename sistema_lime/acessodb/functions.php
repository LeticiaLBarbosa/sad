<?php

// Contem as funcoes usadas para gerar o arquivo csv contendo as notas das disciplinas em cada quesito. E usado pelo arquivo geraCSVcomScore.php


//Gera a linha que eh colocada no arquivo CSV
function geraLinhaCSV($disciplina_id) {
       
    $linhaMontada = $disciplina_id . ",";
    
    for ($i = 0; $i < 13; $i++) {
        
        $scores = scorePorQuesito($disciplina_id);
        
        if ($i == 12) {
            $linhaMontada .= $scores[$i];
        } else {
            $linhaMontada .= $scores[$i] . ",";
        }
        
    }
    
    return $linhaMontada;
    
}


// Retorna um array contendo o score de cada quesito de  1 - 13
function scorePorQuesito($disciplina_id) {
    include "config.php";
    
    $id  = mysql_connect($host, $login_db, $senha_db);
    $con = mysql_select_db($database, $id);
    
    $scores         = array(); // Array contendo o score de todos os quesitos
    $indiceQuestao = 6; // O indice da coluna de respostas de cada questao no BD comeca de 6 e vai pulando de 2 em 2 
    //$lacoResposta   = 0;
    //$valores        = array();
    
    $ValorRespostas                      = array();
    
    // Criando a v�~C¡riavel QqidQuestao que leva a referencia de qid para a consulta sql3 que separa as resposta de cada quest�~C£o
    //$sql         = "SELECT q.qid, q.sid, q.question, a.code, a.answer FROM `lime_questions` q, lime_answers a WHERE q.sid = $disciplina_id and q.qid = a.qid ";
    //$res         = mysql_query($sql, $id);
    //$row         = mysql_fetch_array($res);
    //$QqidQuestao = $row["qid"];
    
    // Conta o valor de cada questao
    for ($i = 0; $i < 13; $i++) {
        
        $valorA1 = 0;
        $valorA2 = 0;
        $valorA3 = 0;
        $valorA4 = 0;
        $valorA5 = 0;
        
        $tabelaDisciplina = "lime_survey_" . $disciplina_id;
        $sql3   = "SELECT * FROM $tabelaDisciplina";
        $res3   = mysql_query($sql3, $id);
        
       // $indiceArrayTituloRespostas = 0; // Laco que anda pelas linhas contando a quantidade de respostas do quesito
        while ($row3 = mysql_fetch_array($res3)) {
            if ($row3[$indiceQuestao] == "A1") {
                $valorA1 += 1;
            }
            if ($row3[$indiceQuestao] == "A2") {
                $valorA2 += 1;
            }
            if ($row3[$indiceQuestao] == "A3") {
                $valorA3 += 1;
            }
            if ($row3[$indiceQuestao] == "A4") {
                $valorA4 += 1;
            }
            if ($row3[$indiceQuestao] == "A5") {
                $valorA5 += 1;
            }
        }
        
        
        $ValorRespostas[0] = $valorA1;
        $ValorRespostas[1] = $valorA2;
        $ValorRespostas[2] = $valorA3;
        $ValorRespostas[3] = $valorA4;
        $ValorRespostas[4] = $valorA5;
        
        $scores[$i] = calculaScore($ValorRespostas);
            
        //$lacoResposta   = $lacoResposta + 1;
        $indiceQuestao = $indiceQuestao + 2;
        //$QqidQuestao    = $QqidQuestao + 1;
  
        //$indiceQuestao  = $indiceQuestao + 1;
    }
    
    return $scores;
    
}


function geraMelhor() {
    include "config.php";
    
    $melhores = array(); //peso minimo 
        
    for ($j = 0; $j < 13; $j++) {
        $melhores[$j] = 0.0;
    }
    
    $id  = mysql_connect($host, $login_db, $senha_db);
    $con = mysql_select_db($database, $id);
    
    $sql = "SELECT p.nome, pd.disciplina_id, d.surveyls_title 
	FROM professores p, `sad_professor_disciplina` pd, lime_surveys_languagesettings d
	where p.login = pd.login and pd.disciplina_id = d.surveyls_survey_id";
    
    $res = mysql_query($sql, $id);
    
    while ($row = mysql_fetch_array($res)) {
        
        $quesito = array();
        $quesito = scorePorQuesito($row["disciplina_id"]);
        
        for ($i = 0; $i < 13; $i++) {
            if ($quesito[$i] > $melhores[$i]) {
                $melhores[$i] = $quesito[$i];
            }
        }
        
    }
    
    $linhaMelhor = "MelhoresR,";
    
    for ($k = 0; $k < 13; $k++) {
        if ($k == 12) {
            $linhaMelhor .= $melhores[$k];
        } else {
            $linhaMelhor .= $melhores[$k] . ",";
        }
    }
    
    return $linhaMelhor;
    
}


function geraPior()
{
    
    include "config.php";
    
    $piores = array(); //peso minimo 
        
    for ($j = 0; $j < 13; $j++) {
        $piores[$j] = 4.0;
    }
    
    $id  = mysql_connect($host, $login_db, $senha_db);
    $con = mysql_select_db($database, $id);
    
    $sql = "SELECT p.nome, pd.disciplina_id, d.surveyls_title 
	FROM professores p, `sad_professor_disciplina` pd, lime_surveys_languagesettings d
	where p.login = pd.login and pd.disciplina_id = d.surveyls_survey_id";
    
    $res = mysql_query($sql, $id);
    
    while ($row = mysql_fetch_array($res)) {
        
        $quesito = array();
        $quesito = scorePorQuesito($row["disciplina_id"]);
        
        for ($i = 0; $i < 13; $i++) {
            if ($quesito[$i] < $piores[$i]) {
                $piores[$i] = $quesito[$i];
            }
        }
        
    }
    
    $linhaPior = "PioresR,";
    
    for ($k = 0; $k < 13; $k++) {
        if ($k == 12) {
            $linhaPior .= $piores[$k];
        } else {
            $linhaPior .= $piores[$k] . ",";
        }
    }
    
    return $linhaPior;
    
}

// Dado o array com o valor de cada opcao, retorna o score da questao 
function calculaScore($respostas)
{
    $totalRespostas = array_sum($respostas);
    
    $peso = 4;
    
    for ($i = 0; $i < 5; $i++) {
        $respostas[$i] = $respostas[$i] * ($peso);
        $peso--;
    }
    
    return round((array_sum($respostas) / $totalRespostas), 2);
}

/*
///BURRICE
function score($respostas)
{
    
    $peso = 4;
    $melhor = array_sum($respostas)*$peso;
    
    for ($i = 0; $i < 5; $i++) {
        
        $respostas[$i] = $respostas[$i] * ($peso);
        $peso--;
    }
 
      return round((array_sum($respostas) / $melhor)*100, 2);
}
*/

function stringScore($respostas)
{
    
    $peso = 4;
    $melhor = array_sum($respostas)*$peso;
    
    for ($i = 0; $i < 5; $i++) {
        
        $respostas[$i] = $respostas[$i] * ($peso);
        $peso--;
    }
 
      return array_sum($respostas)."/".$melhor;
}

function desvioPadrao($respostas) {
	
	$somaDasDiferencas = 0;		
	$media = media($respostas);
		
	foreach ($respostas as &$valor){
		
		$somaDasDiferencas += quadrado($media - $valor); 
	}

	return round(sqrt($somaDasDiferencas/count($respostas)), 2);
	
}

function quadrado($number) {

	return $number*$number;
}

function media($array) {
	
	return (array_sum($array)/count($array));
}


?>


