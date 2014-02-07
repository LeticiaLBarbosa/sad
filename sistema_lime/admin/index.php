<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Exemplo Ranking</title>
  <script type="text/javascript" src="d3.v3.js"></script>
  <script type="text/javascript" src="ranking.js"></script>
</head>

<body>

<div id="infos" class="plot-info2" style="text-align:left; font-size : 14px;">
		
</div>

<script type="text/javascript">

var duration = 1000;
var dados_ranking = [];

d3.csv("ranking.csv",function(data){
    dados_ranking = data;

	

<?php

session_start();


for ($i = 1; $i < 14; $i++ ){
		
?>
	var nome = getCookie('disciplina_id'); //livia: aqui vem a leitura do cookie
	var p = <?php echo $i; ?>; //livia: aqui vem a leitura do cookie

	plot_bar_disciplina_ranking(nome, p);

});




<?php

}

?>

</script>
  
</body>

</html> 
  
