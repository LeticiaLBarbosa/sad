<?php

$TituloRespostas = array();
echo "hm";
$Respostas = array();

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

for ($i = 0; $i < 15; $i ++){
	echo $TituloRespostas[$i];
	echo "<br>";
}

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

echo $Respostas[4][4];
?>