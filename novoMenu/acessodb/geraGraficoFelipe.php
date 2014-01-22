<?php 
// Tentativa 1 Felipe

// Imports da biblioteca
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');	

// Atributos da questao

$answers = array("A1", "A2", "A3", "A4","A5");

// Dados puchados do banco de dados, referentes as repostas dos alunos

$valueA1 = $_GET["value1"];
$valueA2 = $_GET["value2"];
$valueA3 = $_GET["value3"];
$valueA4 = $_GET["value4"];
$valueA5 = $_GET["value5"];

$totalDeRespostas = $valueA1 + $valueA2 + $valueA3 + $valueA4 + $valueA5;

$data = array(($valueA1/$totalDeRespostas), ($valueA2/$totalDeRespostas) , ($valueA3/$totalDeRespostas) , ($valueA4/$totalDeRespostas) , ($valueA5/$totalDeRespostas) );
 
// Cria grafico 
$graph = new PieGraph(600,400);
$graph->SetShadow();

// Configura o grafico

$graph->title->SetFont(FF_FONT2,FS_BOLD);
 
$p1 = new PiePlot3D($data);
$p1->SetAngle(20);
$p1->SetSize(0.4);
$p1->SetCenter(0.45);

$p1->SetLegends($answers);
 
// Plota o grafico 
$graph->Add($p1);
$graph->Stroke();

?>
