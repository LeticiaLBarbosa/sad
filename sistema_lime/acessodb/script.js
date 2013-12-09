// Livia: esse é o arquivo que vai mudar para ler os dados do .csv
var w = 500,
	h = 500;

var colorscale = d3.scale.category10();

//Data from csv file
d3.csv("teste.csv", function(data) {

//Legend titles
var LegendOptions = ['Media dos resultados','Seu resultado'];

/* Data
Livia: aqui os dados vem do arquivo .csv. Foi na forca bruta, mas funciona. So tem um problema: como passar para este script
o indice/linha do melhor resultado e a linha da disciplina sendo apresentada?
*/

var d = [
		  [//Melhor resultado
			{axis:"Q1",value:data[1].Q1},
			{axis:"Q2",value:data[1].Q2},
			{axis:"Q3",value:data[1].Q3},
			{axis:"Q4",value:data[1].Q4},
			{axis:"Q5",value:data[1].Q5},
			{axis:"Q6",value:data[1].Q6},
			{axis:"Q7",value:data[1].Q7},
			{axis:"Q8",value:data[1].Q8},
			{axis:"Q9",value:data[1].Q9},
			{axis:"Q10",value:data[1].Q10},
			{axis:"Q11",value:data[1].Q11},
			{axis:"Q12",value:data[1].Q12},
			{axis:"Q13",value:data[1].Q13},
		  ],[// Seu resultado
			{axis:"Q1",value:data[0].Q1},
			{axis:"Q2",value:data[0].Q2},
			{axis:"Q3",value:data[0].Q3},
			{axis:"Q4",value:data[0].Q4},
			{axis:"Q5",value:data[0].Q5},
			{axis:"Q6",value:data[0].Q6},
			{axis:"Q7",value:data[0].Q7},
			{axis:"Q8",value:data[0].Q8},
			{axis:"Q9",value:data[0].Q9},
			{axis:"Q10",value:data[0].Q10},
			{axis:"Q11",value:data[0].Q11},
			{axis:"Q12",value:data[0].Q12},
			{axis:"Q13",value:data[0].Q13}
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

