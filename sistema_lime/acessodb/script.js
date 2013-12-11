// Livia: esse � o arquivo que vai mudar para ler os dados do .csv
var w = 500,
	h = 500;

var colorscale = d3.scale.category10();
var disciplina = getCookie('disciplina_id');
var index = getIndex(disciplina);
//Data from csv file
d3.csv("data.csv", function(data) {


//Legend titles
var LegendOptions = ['Media dos resultados','Seu resultado'];

/* Data
Livia: aqui os dados vem do arquivo .csv. Foi na forca bruta, mas funciona. So tem um problema: como passar para este script
o indice/linha do melhor resultado e a linha da disciplina sendo apresentada?
*/

var d = [
		  [//Melhor resultado
			{axis: "Q1",value:1},
			{axis:"Q2",value:1},
			{axis:"Q3",value:1},
			{axis:"Q4",value:1},
			{axis:"Q5",value:1},
			{axis:"Q6",value:1},
			{axis:"Q7",value:1},
			{axis:"Q8",value:1},
			{axis:"Q9",value:1},
			{axis:"Q10",value:1},
			{axis:"Q11",value:1},
			{axis:"Q12",value:1},
			{axis:"Q13",value:1},
		  ],[// Seu resultado
			{axis: disciplina,value:data[index].Q1/4},
			{axis:"Q2",value:data[index].Q2/4},
			{axis:"Q3",value:data[index].Q3/4},
			{axis:"Q4",value:data[index].Q4/4},
			{axis:"Q5",value:data[index].Q5/4},
			{axis:"Q6",value:data[index].Q6/4},
			{axis:"Q7",value:data[index].Q7/4},
			{axis:"Q8",value:data[index].Q8/4},
			{axis:"Q9",value:data[index].Q9/4},
			{axis:"Q10",value:data[index].Q10/4},
			{axis:"Q11",value:data[index].Q11/4},
			{axis:"Q12",value:data[index].Q12/4},
			{axis:"Q13",value:data[index].Q13/4}
		  ]
		];

//Options for the Radar chart, other than default
var mycfg = {
  w: w,
  h: h,
  maxValue: 1,
  levels: 5,
  ExtraWidthX: 300
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
	.attr("x", w - 70)
	.attr("y", 10)
	.attr("font-size", "12px")
	.attr("fill", "#404040")
	.text("What % of owners use a specific service in a week");
		
//Initiate Legend	
var legend = svg.append("g")
	.attr("class", "legend")
	.attr("height", 100)
	.attr("width", 200)
	.attr('transform', 'translate(90,20)') 
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


function getIndex(id){
	for (var i = 0; i < data.length; i++){
		if (data.[i].DisciplinaID == id){
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

