<?php
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



?>
