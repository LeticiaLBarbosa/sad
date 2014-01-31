<?php

// Arquivo usado pra gerar o csv do ranking
$fileCSV = ("ranking.csv","w",0);

echo "passou 1";

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
/*
for ($i = 0; $i < count($matriz) - 2; $i++) {
    
    for ($j = 0; $j < count($matriz[$i]); $j++) {
        
        if ($j == 13) {
            echo $matriz[$i][$j] . ",";
        }
    }
    
    echo "<br>";
}
*/
echo "<br><br>";

for ($i = 1; $i < count($matriz) - 2; $i++) {
    for ($j = 1; $j < count($matriz[$i]); $j++) {
        
        
        //	echo $matriz[$i][0].",".$matriz[$i][$j].",".$matriz[0][$j].",".arrayQuesito($j,$matriz[$i][$j],$matriz)."<br>";
        
        fwrite($fileCSV, ($matriz[$i][0] . "," . $matriz[$i][$j] . "," . $matriz[0][$j] . "," . arrayQuesito($j, $matriz[$i][$j], $matriz) . "\n"));
        
    }
}

function arrayQuesito($quesito, $nota, $matriz)
{
    
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
