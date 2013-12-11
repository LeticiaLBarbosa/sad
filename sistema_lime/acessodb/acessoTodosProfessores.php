<?php

include 'config.php';
include 'csvFunction.php';

$fileCSV = fopen("data.csv","w",0);

$id = mysql_connect($host, $login_db,$senha_db);
$con = mysql_select_db($database, $id);

$sql = "SELECT p.nome, pd.disciplina_id, d.surveyls_title 
FROM professores p, `sad_professor_disciplina` pd, lime_surveys_languagesettings d
where p.login = pd.login and pd.disciplina_id = d.surveyls_survey_id";

$res = mysql_query($sql,$id);

fwrite($fileCSV, ("DisciplinaID,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10,Q11,Q12,Q13\n"));

while($row = mysql_fetch_array($res)){
	
	$linhaPronta = "";
	//$linhaPronta .= $row["nome"] . "," . $row["surveyls_title"] . ",".mediasPorQuesito($row["disciplina_id"]);
	$linhaPronta .= mediasPorQuesito($row["disciplina_id"]);
	
	fwrite($fileCSV, ($linhaPronta."\n"));

	echo $linhaPronta . "<br>";
}

fwrite($fileCSV, (geraMelhor()."\n"));
echo geraMelhor() . "<br>";


fwrite($fileCSV, (geraPior()."\n"));
echo geraPior() . "<br>";

fclose($fileCSV);

?>
