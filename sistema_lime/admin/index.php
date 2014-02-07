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

<?php

session_start();


for ($i = 1; $i < 14; $i++ ){
	
?>

<script type="text/javascript">

var duration = 1000;
var dados_ranking = [];

d3.csv("ranking.csv",function(data){
    dados_ranking = data;

	var nome = getCookie('disciplina_id'); //livia: aqui vem a leitura do cookie
	var p = <?php $i ?>; //livia: aqui vem a leitura do cookie

	plot_bar_disciplina_ranking(nome, p);

});

function plot_bar_disciplina_ranking(nome, p){
	disciplina = nome;
    	questao_avaliada = p; //livia: guarda o identificador da questao escolhida
    var h1 = 60;
    var margin = {top: 30, right: 120, bottom: 40, left: 40},
            width = 750 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;
    d3.select("#infos").select("svg").remove();
    var svg = d3.select("#infos");
    
    svg = d3.select("#infos").append("svg")
        .attr("width", 600)
        .attr("height", 400);	
    
    var val_per = dados_ranking.filter(function(d){ return d.questao == questao_avaliada});

    var line_per =  [{'x' : d3.min(val_per,function(d){return parseFloat(d.media);}) , 'y' : h1},
                         {'x':(d3.max(val_per,function(d){return parseFloat(d.media);})), 'y' : h1}];

    if (val_per.length<2) {
        // Imprime mensagem
        svg.append("text")
            .attr("y", h1-30)
            .attr("x", 350)
            .attr("text-anchor", "center")
            .attr("font-size", "12px")
            .attr("font-weight", "bold")
            .text(disciplina+ "Esta eh a unica disciplina avaliada na questao "); //
    }else{
        plot_ranges_ranking(svg, line_per, h1);
        plot_bars_ranking(svg, line_per, h1);            
        plot_disciplinas_ranking(svg, val_per, "blue",line_per[0], line_per[1],h1);

    };
}


function plot_ranges_ranking(svg, dados, y0){
    var valor1 = String(dados[0].x).replace(/\,/g,'');
    var valor2 = String(dados[1].x).replace(/\,/g,'');
    
    var x1 = d3.scale.linear()
          .domain([parseFloat(valor1), parseFloat(valor2)])
          .range([120, 550]);    

    var xAxis = d3.svg.axis()
            .scale(x1)
            .orient("bottom")
            .tickValues([parseFloat(valor1),parseFloat(valor2)])
            .ticks(6);
    
        
        // Adiciona o texto "Min"
        svg.append("text")
            .attr("x", x1(dados[0].x) - 30) // X de onde o texto vai aparecer
            .attr("y", (y0 -2))           // Y de onde o texto vai aparecer
            .text("Min");
        //adiciona a nota minima
        svg.append("text")
            .attr("x",x1(dados[0].x) - 30)
            .attr("y",(y0 + 8))
            .text(valor1);

        // Adiciona o texto "Max"
        svg.append("text")
            .attr("x", x1(dados[1].x) + 10) // X de onde o texto vai aparecer
            .attr("y", (y0 -2))            // Y de onde o texto vai aparecer   
            .text("Max");    
        //adiciona a nota maxima
        svg.append("text")
            .attr("x",x1(dados[1].x) + 10)
            .attr("y",(y0 + 8))
            .text(valor2);
}

/* Funcao para plotar uma barrinha*/
function addLine_ranking(svg,x1,x2,y1,y2,cor){
    
    if(y1 > 100){
        svg.append("line")
              .attr("x1", x1)
              .attr("x2", x2)
              .attr("y1",y1)
              .attr("y2",y2)
              .attr("id","barra_indicador_altura_" + y1)
              .transition().duration(duration)
              .style("stroke",cor)
              .attr("stroke-width",25);
    }else{
        svg.append("line")
              .attr("x1", x1)
              .attr("x2", x2)
              .attr("y1",y1)
              .attr("y2",y2)
              .attr("id","barra_indicador_altura_" + y1)
              .transition().duration(duration)
              .style("stroke",cor)
              .attr("opacity",0.6)
              .attr("stroke-width",25);
    }
}

/* Plota a barrinha de fundo horizontal das notas*/
function plot_bars_ranking(svg, dados,y0){
    
    var x1 = d3.scale.linear()
          .domain([dados[0].x, dados[1].x])
          .range([120, 550]);
    
    addLine_ranking(svg,x1(dados[0].x),x1(dados[1].x),y0,y0,"#E0E0E0");
}


function convert(nota,min,max){
    return (((nota- min)/(max-min))*(550-120)) + 120; //livia: algum tipo de normalizacao?????
}

function plot_disciplinas_ranking(svg, dados, cor, min, max, y0){
console.log(dados);
    var inf = dados.filter(function(d) {return d.disciplina == disciplina});
    console.log(inf);
    
    function mousemove(nota, disciplina) { 
        svg.append("text")
        .attr("x", function(d){ return convert(nota,min.x,max.x) ;})
        .attr("y",(y0 +34)) // Altura de onde o texto vai aparecer
        .attr("text-anchor", "middle")
        .style("fill","black")
        .text(disciplina + ": " + nota);
    } 

    // Funcao que faz o tolltip sumir 
    function mouseout(nota, disciplina) {
      svg.append("text")
        .attr("x", function(d){ return convert(nota,min.x,max.x) ;})
        .attr("y",(y0 +34)) // Altura de onde o texto vai aparecer
        .attr("text-anchor", "middle")
        .attr("font-weight", "bold")
        .style("fill","white")
        .style("stroke","white")
        .style("stroke-width",2)
        .text(disciplina + ": " + nota);
    } 

    // Adiciona o texto do ranking
    svg.append("text")
        .attr("x", function(d){ return convert(inf[0].media,min.x,max.x) - 15;})
        .attr("y",(y0 - 15)) // Altura de onde o texto vai aparecer
        .attr("text-anchor", "middle")
        .attr("font-size", "12px")
        .text(inf[0].posicao + "º colocado");
    
    // Adiciona o texto da nota do aluno selecionado 
    svg.append("text")
        .attr("x", function(d){ return convert(inf[0].media,min.x,max.x) ;})
        .attr("y",(y0 + 25)) // Altura de onde o texto vai aparecer
        .attr("text-anchor", "middle")
        .attr("font-weight", "bold")
        .text(inf[0].media);

    var g = svg.append("g");

    // Adiciona as linhas correspondente as notas na questao escolhida para cada disciplina
    g.selectAll("line").data(dados)
                    .enter()
                    .append("line")
                    .attr("x1", function(d){ return convert(d.media,min.x,max.x);}) // Angulacao superior da linha 
                    .attr("x2", function(d){ return convert(d.media,min.x,max.x);}) // Angulacao inferior da linha
                    .attr("y1",y0-12) // Altura superior da linha
                    .attr("y2",y0+12) // Altura inferior da linha
                    .attr("class","linha_disciplina")
                    .transition().duration(duration) // Transicao
                    .style("stroke","#0000a1") // Cor da linha
                    .attr("stroke-width",5)    // Largura da linha
                    .attr("text",function(d){return d.disciplina;});

    g.selectAll("line").on("mouseout", function(d){mouseout(d.media, d.disciplina);}) 
                       .on("mousemove", function(d){mousemove(d.media, d.disciplina);})
                       .on("click", function(d) {console.log(d.disciplina + "  " + d.media);});


    // Adiciona a linha correspondente a media do aluno escolhido
    svg.append("line")
            .attr("x1", function(d){ return convert(inf[0].media,min.x,max.x);}) // X inicial da linha
            .attr("x2", function(d){ return convert(inf[0].media,min.x,max.x);}) // X final da linha 
            .attr("y1",y0-12) // Y inicial da linha
            .attr("y2",y0+12) // Y final da linha
            .attr("class","linha_disciplina")
            .transition().duration(duration)  // Transicao
            .style("stroke","red") // Cor da linha
            .attr("stroke-width",5)    // Largura da linha
            .attr("text",function(d){return d.disciplina;});
    
    svg.selectAll("line").on("mouseover", function(d){mouseover();}) 
                       .on("mouseout", function(d){mouseout(d.media, d.disciplina);}) 
                    .on("mousemove", function(d){mousemove(d.media, d.disciplina);})
                    .on("click", function(d) {console.log(d.disciplina + "  " + d.media);});


}

function getCookie(c_name){
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1)
	  {
	  c_start = c_value.indexOf(c_name + "=");
	  }
	if (c_start == -1)
	  {
	  c_value = null;
	  }
	else
	  {
	  c_start = c_value.indexOf("=", c_start) + 1;
	  var c_end = c_value.indexOf(";", c_start);
	  if (c_end == -1)
	  {
	c_end = c_value.length;
	}
	c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}

<?php

echo "<br>";

echo "<br>";
}
?>

</script>
  
</body>

</html> 
  
