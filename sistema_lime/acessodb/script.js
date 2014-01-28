// Livia: esse � o arquivo que vai mudar para ler os dados do .csv

// Tamanho do radar
var w = 300, 
	h = 300;

var colorscale = d3.scale.category10();
var disciplina = '<%= Session("diciplina_id")%>';

//Data from csv file
d3.csv("data.csv", function(data) {

//Indice da Disciplina
var index = getIndex(disciplina,data);
//Indice dos Melhores Resultados
var indexM = getIndex("MelhoresR",data);

//Indice dos Melhores Resultados
var indexP = getIndex("PioresR",data);

//Legend titles
var LegendOptions = ['Melhores resultados','Seu resultado','Piores resultados'];

/* Data
Livia: aqui os dados vem do arquivo .csv. Foi na forca bruta, mas funciona. So tem um problema: como passar para este script
o indice/linha do melhor resultado e a linha da disciplina sendo apresentada?
*/

var d = [ [//Melhor resultado
			{axis:"Q1",value:(data[indexM].Q1/4)},
			{axis:"Q2",value:(data[indexM].Q2/4)},
			{axis:"Q3",value:(data[indexM].Q3/4)},
			{axis:"Q4",value:(data[indexM].Q4/4)},
			{axis:"Q5",value:(data[indexM].Q5/4)},
			{axis:"Q6",value:(data[indexM].Q6/4)},
			{axis:"Q7",value:(data[indexM].Q7/4)},
			{axis:"Q8",value:(data[indexM].Q8/4)},
			{axis:"Q9",value:(data[indexM].Q9/4)},
			{axis:"Q10",value:(data[indexM].Q10/4)},
			{axis:"Q11",value:(data[indexM].Q11/4)},
			{axis:"Q12",value:(data[indexM].Q12/4)},
			{axis:"Q13",value:(data[indexM].Q13/4)}
		  ],
	[// Seu resultado
			{axis:"Q1",value:(data[index].Q1/4)},
			{axis:"Q2",value:(data[index].Q2/4)},
			{axis:"Q3",value:(data[index].Q3/4)},
			{axis:"Q4",value:(data[index].Q4/4)},
			{axis:"Q5",value:(data[index].Q5/4)},
			{axis:"Q6",value:(data[index].Q6/4)},
			{axis:"Q7",value:(data[index].Q7/4)},
			{axis:"Q8",value:(data[index].Q8/4)},
			{axis:"Q9",value:(data[index].Q9/4)},
			{axis:"Q10",value:(data[index].Q10/4)},
			{axis:"Q11",value:(data[index].Q11/4)},
			{axis:"Q12",value:(data[index].Q12/4)},
			{axis:"Q13",value:(data[index].Q13/4)}
		  
		]
	,
	[//Pior resultado
			{axis:"Q1",value:(data[indexP].Q1/4)},
			{axis:"Q2",value:(data[indexP].Q2/4)},
			{axis:"Q3",value:(data[indexP].Q3/4)},
			{axis:"Q4",value:(data[indexP].Q4/4)},
			{axis:"Q5",value:(data[indexP].Q5/4)},
			{axis:"Q6",value:(data[indexP].Q6/4)},
			{axis:"Q7",value:(data[indexP].Q7/4)},
			{axis:"Q8",value:(data[indexP].Q8/4)},
			{axis:"Q9",value:(data[indexP].Q9/4)},
			{axis:"Q10",value:(data[indexP].Q10/4)},
			{axis:"Q11",value:(data[indexP].Q11/4)},
			{axis:"Q12",value:(data[indexP].Q12/4)},
			{axis:"Q13",value:(data[indexP].Q13/4)}
		]
			  
	];

//Options for the Radar chart, other than default
var mycfg = {
  w: w,
  h: h,
  maxValue: 1,
  levels: 5,
  ExtraWidthX: 200 // Espa�o extra ao lado
}

//Call function to draw the Radar chart
//Will expect that data is in %'s
RadarChart.draw("#chart", d, mycfg);

////////////////////////////////////////////
/////////// Initiate legend ////////////////
////////////////////////////////////////////

var svg = d3.select('#body')
	.selectAll('svg')
	.append('svg')
	.attr("width", w+300)
	.attr("height", h)

//Create the title for the legend
var text = svg.append("text")
	.attr("class", "title")
	.attr('transform', 'translate(90,0)') 
	.attr("x", w - 20) //localiza��o do titulo da legenda
	.attr("y", 10)
	.attr("font-size", "12px")
	.attr("fill", "#404040")
	.text("Resultados do semestre:");
		
//Initiate Legend	
var legend = svg.append("g")
	.attr("class", "legend")
	.attr("height", 200)
	.attr("width", 200)
	.attr('transform', 'translate(160,20)') // localiza��o da legenda 
	;
	//Create colour squares
	legend.selectAll('rect')
	  .data(LegendOptions)
	  .enter()
	  .append("rect")
	  .attr("x", w - 65)
	  .attr("y", function(d, i){ return i * 20;})
	  .attr("width", 10)
	  .attr("height", 10)
	  .style("fill", function(d, i){ return colorscale(i);})
	  ;
	//Create text next to squares
	legend.selectAll('text')
	  .data(LegendOptions)
	  .enter()
	  .append("text")
	  .attr("x", w - 52)
	  .attr("y", function(d, i){ return i * 20 + 9;})
	  .attr("font-size", "11px")
	  .attr("fill", "#737373")
	  .text(function(d) { return d; })
	  ;
});//csv file reading


function getIndex(id,data){
	for (var i = 0; i < data.length; i++){
		if (data[i].DisciplinaID == id){
			return i;		
		}			
	}

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

