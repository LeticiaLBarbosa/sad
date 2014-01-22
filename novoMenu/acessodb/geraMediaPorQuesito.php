<?php

function geraMediasQuesitos(){
	$mediasGerais = array ();

	$file = fopen ( "data.csv", "r" );
	//$mediaFile = fopen ( "media.csv", "w");
	//fwrite($mediaFile, "Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10,Q11,Q12,Q13\n");
	for($j = 0; $j < 13; $j ++) {
		array_push ( $mediasGerais, 0 );
	}
	
	$contaProfessores = 0;

	if ($file) {
		
		$ignoraCabecalho = 0;
		while ( ! feof ( $file ) ) {
			$line = fgets ( $file );
			
			if($ignoraCabecalho == 1){
				$token = strtok ( $line, "," );
				
				$i = 0;
				while ( $token != false ) {
					
					if ($i >= 1) {
		
						$mediasGerais [$i - 1] += $token;
					}
					
					$i ++;
					
					$token = strtok ( "," );
				}
				
				$contaProfessores ++;
			}
			
			$ignoraCabecalho = 1;
		}
		
		for($j = 0; $j < 13; $j ++) {
			
			$mediasGerais [$j] = round($mediasGerais [$j] / $contaProfessores,2);
			
		}
		fclose ( $file );
	}

	//for ($i = 0; $i < 12; $i++) {
		//fwrite($mediaFile, $mediasGerais[$i].",");
	
	//}

//	fwrite($mediaFile, $mediasGerais[12]."\n");
	//fclose($mediaFile);
	
	return $mediasGerais;
	
}

?>

