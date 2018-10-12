<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">




<script>
window.onload = function () {
//var xVal = d;
var temp_c = 0;
var dps = [];
var yVal = 0; 
var updateInterval = 1000;
var dataLength = 10000; // number of dataPoints visible at any point
var d = new Date();
var b = d.getTime();
var chart = new CanvasJS.Chart("chartContainer", {
	title :{
		text: "Temp"
	},
	axisY: {
		includeZero: false
	},      
	data: [{
		type: "line",
		dataPoints: dps
	}]
});

var get_temp = function () {

  

  var req = new XMLHttpRequest();
    console.log("Grabbing Value");
    req.onreadystatechange=function() {
      if (req.readyState==4 && req.status==200) {
           var full_temp = req.responseText;
                             var temp_array = full_temp.split(",");
                             temp_c = parseFloat(temp_array[0]);
                             var temp_f = temp_array[1];
                             document.getElementById('temp_f').innerText = temp_f.replace(/(\r\n|\n|\r)/gm,"") + " F ";
                             document.getElementById('temp_c').innerText = temp_c + " C ";
                             //window.alert(temp_c);

                             

      }
    }
    req.open("GET", 'temps.txt', true); // Grabs whatever you've written in this file
    req.send(null);

  


}


  var updateChart = function (count){
  count = count || 1;
  for (var j = 0; j < count; j++) {
        var xVal = new Date();
    get_temp();
    yVal = temp_c;


    dps.push({
      x: xVal,
      y: yVal
    });
    xVal++;
  }

  if (dps.length > dataLength) {
    dps.shift();
  }
  
  chart.render();
};

updateChart(dataLength);
setInterval(function(){updateChart()}, updateInterval);

}
</script>
</head>
<body>
 <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="http://18.195.162.116/test.php">Temperature</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Temperature reading Jyväskylä Finland</h1>
    
		
		
			<h1 id="temp_c"></h1>
                        <h1 id="temp_f"></h1>
                        <p>This temperature reading is streamed from Raspberry Pi. It's updated every 10 seconds. Location 40100, Jyväskylä, Finland</p>
		</div>
 </div>	
<div id="chartContainer" style="height: 370px; width:100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
