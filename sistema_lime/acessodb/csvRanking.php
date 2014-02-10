<?php

include "functions.php";

// Arquivo usado pra gerar o csv do ranking
$fileCSV = fopen("ranking.csv", "w", 0);
fwrite($fileCSV,"disciplina,media,questao,posicao\n");

$row        = 1;
$handle     = fopen("data.csv", "r");
$matriz     = array();
$disciplina = array();
$index      = 0;
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
    for ($i = 0; $i < $num; $i++) {
        $disciplina[$i] = $data[$i];
    }
    
    $matriz[$index] = $disciplina;
    $index++;
}

fclose($handle);

$matrizDisc = array();
for ($i = 1; $i < count($matriz) - 2; $i++) {
    
    for ($j = 1; $j < count($matriz[$i]); $j++) {
        
	$matrizDisc[$i-1][$j-1] = $matriz[$i][$j];    
        
        fwrite($fileCSV, ($matriz[$i][0] . "," . $matriz[$i][$j] . "," . $matriz[0][$j] . "," . returnPosicao($j, $matriz[$i][$j], $matriz) . "\n"));
    }
}

	for ($i = 0; $i < count($matrizDisc[0]);$i++) {

        fwrite($fileCSV, ("desvioPositivo" . "," . (media(arrayColunaDaMatriz($matrizDisc,$i))+desvioPadrao(arrayColunaDaMatriz($matrizDisc,$i))) . "," . "Q".($i+1) . "," . 0 . "\n"));
        fwrite($fileCSV, ("desvioNegativo" . "," . (media(arrayColunaDaMatriz($matrizDisc,$i))-desvioPadrao(arrayColunaDaMatriz($matrizDisc,$i))) . "," . "Q".($i+1) . "," . 0 . "\n"));
 
		
	}
	
	fclose($fileCSV);
	

function arrayColunaDaMatriz($matriz, $coluna) {
	
	$arrayColuna = array();

	for($i = 0; $i < count($matriz); $i++) {
		
		$arrayColuna[$i] = $matriz[$i][$coluna];
	
	} 
		
	return $arrayColuna;

}


function returnPosicao($quesito, $nota, $matriz){
    
    $notas = array();
    
    for ($i = 1; $i < count($matriz) - 2; $i++) {
        
        $notas[$i - 1] = $matriz[$i][$quesito];
    }
    
    sort($notas);
    
    for ($j = 0; $j < count($notas); $j++) {
        
        if ($notas[$j] == $nota) {
            return count($notas) - $j;
        }
    }
}

echo "passou";

?>
