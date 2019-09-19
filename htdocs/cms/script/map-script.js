var map;

var crisisList;
var gmarkers = [];
var loggedIn = false;
var chkSevere = document.getElementById('chkSevere');
var currentLayer;

function getCrisisList(){
  return new Promise(function (resolve, reject) {
	let xhr = new XMLHttpRequest;
    xhr.open('GET', '../cmo/results1.json', true)
	xhr.onload = function() 
		{
			if (this.status === 200) 
			{
        crisisList=JSON.parse(this.responseText);
        resolve(this.response);
      }
      else{
        reject({
          status: this.status,
          statusText: xhr.statusText
      });
      }
		}
  xhr.send();
  })
}

function addCrisis(crisis){
  if(loggedIn){
  var contentString = '<div id="content">'+
  '<div id="siteNotice">'+
  '</div>'+
  '<h1 id="firstHeading" class="firstHeading">' +
  crisis.emergencyType+
  '</h1>'+
  '<table>'+
	  '<tr>'+
		'<th> Witness </th>'+
		'<td>'+crisis.name+'</td>'+
	  '</tr>'+
	  '<tr>'+
		'<th>Location </th>'+
		'<td>'+crisis.location+'</td>'+
	  '</tr>'+
	  '<tr>'+
		'<th>Assistance </th>'+
		'<td>'+crisis.typeOfAssistance+'</td>'+
	  '</tr>'+
	  '<tr>'+
		'<th>Remarks </th>'+
		'<td>'+crisis.remarks+'</td>'+
	  '</tr>'+
	  '<tr>'+
		'<th>File Time </th>'+
		'<td>'+crisis.fileDateTime+'</td>'+
	  '</tr>'+
  '</table>'+
  '</div>';
}
else{
  var contentString = '<div id="content">'+
  '<div id="siteNotice">'+
  '</div>'+
  '<h1 id="firstHeading" class="firstHeading">' +
  crisis.emergencyType+
  '</h1>'+
  '<table>'+
	  '<tr>'+
		'<th>Location </th>'+
		'<td>'+crisis.location+'</td>'+
	  '</tr>'+
	  '<tr>'+
		'<th>Remarks </th>'+
		'<td>'+crisis.remarks+'</td>'+
	  '</tr>'+
  '</table>'+
  '</div>';
}

  var infowindow = new google.maps.InfoWindow({
  content: contentString
  });
  
	google.maps.event.addListener(map, "click", function(event) {
		infowindow.close();
	});

  var icon;
  var colour;
  if(crisis.IsSevere=='true') {
	  colour = 'red';
  }
  else {
	  colour = 'black';
  }
  
  switch (crisis.emergencyType){
    case("Fire"):
    /* if(crisis.status)
      url="";
    else */
      url="http://u.cubeupload.com/daneso/fire"+colour+".png";
    break;
  case("Terrorist Attack"):
    url="http://u.cubeupload.com/daneso/gun"+colour+".png";
    break;
  case("Traffic Accident"):
    url="http://u.cubeupload.com/daneso/accident"+colour+".png";
    break;
  case("Natural Disaster"):
    url="http://u.cubeupload.com/daneso/plant"+colour+".png";
    break;
  case("Gas Leak"):
    url="http://u.cubeupload.com/daneso/gas"+colour+".png";
    break;
  default:
    url="http://u.cubeupload.com/daneso/warning"+colour+".png";
    break; 
  }
  icon = {
    url: url,
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
	}
  var marker = new google.maps.Marker({
  position: {lat: parseFloat(crisis.latitude), lng: parseFloat(crisis.longitude)},
  map: map,
  icon: icon,
  title: crisis.emergencyType
  });
  gmarkers.push(marker);
  marker.addListener('click', function() {
    infowindow.open(map, this);
    });
}

function addHaze(values, region, position){
  var contentString = '<div id="content">'+
  '<div id="siteNotice">'+
  '</div>'+
  '<h1 id="firstHazeHeading" class="firstHazeHeading">' +
  'Air Quality '+region+
  '</h1>'+
  '<div id="bodyHazeContent" class="bodyHazeContent">'+
  '<b>PSI</b>: '+ values.psi+
  '</div>'+
  '</div>';

  var infowindow = new google.maps.InfoWindow({
  content: contentString
  });
  
	google.maps.event.addListener(map, "click", function(event) {
		infowindow.close();
	});

  var icon = {
    url: "https://image.flaticon.com/icons/png/512/182/182266.png",
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};

  var marker = new google.maps.Marker({
  position: position,
  map: map,
  icon: icon,
  title: 'Air Quality '+ region
  });
  gmarkers.push(marker);
  marker.addListener('click', function() {
    infowindow.open(map, this);
    });
}

function addWeather(condition, region, position){
  var contentString = '<div id="content">'+
  '<div id="siteNotice">'+
  '</div>'+
  '<h1 id="firstHazeHeading" class="firstHazeHeading">' +
  'Weather in '+region+
  '</h1>'+
  '<div id="bodyHazeContent" class="bodyHazeContent">'+
  '<b>Condition</b>: '+ condition+
  '</div>'+
  '</div>';

  var infowindow = new google.maps.InfoWindow({
  content: contentString
  });
  
	google.maps.event.addListener(map, "click", function(event) {
		infowindow.close();
	});

  var icon = weatherIcons(condition);

  if(region=="Sembawang" || region=="Central Water Catchment" || region=="Bukit Merah" || region=="Jalan Bahar" || region=="Pasir Ris") {
	  var marker = new google.maps.Marker({
		  position: position,
		  map: map,
		  icon: icon,
		  title: 'Weather in ' + region
	  });
	  gmarkers.push(marker);
	  marker.addListener('click', function () {
		  infowindow.open(map, this);
	  });
  }
}

async function initMap() {
  await getCrisisList();
map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: 1.3516, lng: 103.808},
  zoom: 11.2
});

var id = document.getElementById('userId').value;
if (id == null || id === "")
	console.log("Public");
else {
  console.log("Logged in");
  loggedIn=true;
}


dataLayer = new google.maps.Data(); // Initialise data layer
var rbCrises = document.getElementById('rbCrises');
chkSevere.checked = false;
chkSevere.onchange = function() {checkSevere()};

whichLayerToShow();
rbCrises.click();
rbCrises.focus();
}

function checkSevere() {
	if(currentLayer === "crises") {
		clearMap();
		crises(chkSevere.checked);
	}
}

function clearMap() {
	for(i=0; i<gmarkers.length; i++){
		  gmarkers[i].setMap(null);
	}
	dataLayer.setMap(null);
}

// Function to decide which overlay to show
function whichLayerToShow() {
	var rbDengue = document.getElementById('rbDengue');
	var rbHaze = document.getElementById('rbHaze');
	var rbCrises = document.getElementById('rbCrises');
	var rbWeather = document.getElementById('rbWeather');
	rbDengue.onclick = function() {
		currentLayer = "dengue";
		clearMap();
		dengue();
	}
	rbHaze.onclick = function() {
		currentLayer = "haze";
		clearMap();
		haze();
	}
	rbCrises.onclick = function() {
		currentLayer = "crises";
		clearMap();
		crises(chkSevere.checked);
  }
  rbWeather.onclick = function() {
		currentLayer = "weather";
		clearMap();
		weather();
	}
}

function dengue() {
	dataLayer.loadGeoJson('https://gist.githubusercontent.com/DCHIA017/4566728dd72b3c537c3128e81134cbe4/raw/80f2c6b238d50cf1debf27c088d05eaf208116d6/dengue-clusters-geojson.geojson');
	dataLayer.setMap(map);
}

function haze() {
  // Data in console
  var hazeData;
	let xhr = new XMLHttpRequest;
	xhr.open('GET', 'https://api.data.gov.sg/v1/environment/psi', true)
	xhr.onload = function() 
		{
			if (this.status === 200) 
			{
        hazeData=JSON.parse(this.responseText);
        console.log("The haze data retrieved is "+hazeData);
        var psi = hazeData.items[0].readings.psi_twenty_four_hourly;
        var latlong = hazeData.region_metadata;
          addHaze({psi: psi.west}, 'west', {lat: latlong[0].label_location.latitude, lng: latlong[0].label_location.longitude});
          addHaze({psi: psi.north}, 'north', {lat:latlong[5].label_location.latitude, lng: latlong[5].label_location.longitude});
          addHaze({psi: psi.east}, 'east', {lat: latlong[2].label_location.latitude, lng: latlong[2].label_location.longitude});
          addHaze({psi: psi.south}, 'south', {lat: latlong[4].label_location.latitude, lng: latlong[4].label_location.longitude});
          addHaze({psi: psi.central}, 'central', {lat: latlong[3].label_location.latitude, lng: latlong[3].label_location.longitude});
      
			}
		}
  xhr.send();
}

function weather() {
  var weatherData;
	let xhr = new XMLHttpRequest;
	xhr.open('GET', 'https://api.data.gov.sg/v1/environment/2-hour-weather-forecast', true)
	xhr.onload = function() 
		{
			if (this.status === 200) 
			{
        weatherData=JSON.parse(this.responseText);
        var areas =weatherData.area_metadata;
        for(var i=0; i<areas.length; i++){
          var condition=weatherData.items[0].forecasts[i].forecast;
          var region=weatherData.items[0].forecasts[i].area;
          var lat=weatherData.area_metadata[i].label_location.latitude;
          var long=weatherData.area_metadata[i].label_location.longitude;
          addWeather(condition, region, {lat: lat, lng: long});
        }
			}
		}
  xhr.send();
  
}

function crises(checked) {
	if (checked) {
		for (var i=0; i<crisisList.length; i++){
			if(crisisList[i].status ==="open" && crisisList[i].IsSevere === "true"){
			  addCrisis(crisisList[i]);
			}
		}
	}
	else {
		for (var i=0; i<crisisList.length; i++){
			if(crisisList[i].status ==="open"){
			  addCrisis(crisisList[i]);
			}
		}
	}
}

function weatherIcons(condition) {
	var icon;
	var url;
	
	if(condition.toLowerCase().includes("fair")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-sunny-512.png";
	}
	
	else if(condition.toLowerCase().includes("cloudy")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-cloudy-512.png";
	}
	else if(condition.toLowerCase().includes("hazy")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-fog-512.png";
	}
	else if(condition.toLowerCase().includes("windy")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-windy-512.png";
	}
	else if(condition.toLowerCase().includes("mist")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-cloudy-fog-512.png";
	}
	else if(condition.toLowerCase().includes("thunder")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-thunder-rainy-h-512.png";
	}
	else if(condition.toLowerCase().includes("rain") || condition.toLowerCase().includes("showers")) {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-rainy-h-512.png";
	}
	else {
		url = "https://cdn3.iconfinder.com/data/icons/weather-icons-8/512/weather-partlycloudy-512.png";
	}
	 
	icon = {
    url: url,
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
	}
	return icon;
}