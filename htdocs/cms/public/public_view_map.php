<html>
<head>
	<?php include('public_header.php');?>
    
</head>
<body>
	<!---------------Navigation bar--------------->
	<section id = "nav-bar">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="public_main.php">Unknown Crysis</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" href="public_login.php">Login</a>
				<a class="nav-item nav-link active" href="public_view_map.php">View Map</a>
				<a class="nav-item nav-link" href="public_file_accident.php">File Incident</a>
			</div>
		</div>
		</nav>
	</section>
	
	<!----------------Map-------------->
	<div class = "main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<h3 class="label">Map</h3>
	<p>Click on the buttons to get latest map of the respective emergencies</p>
	<center>
        <div class="w3-bar">
		<label for="chkSevere">Severe Only</label>
		<input type="checkbox" id="chkSevere" name="chkSevere" value="Severe Only"></input>
		<input type="button" class="btn btn-outline-danger" id="rbCrises" value="Incidents"></input>
		<input type="button" class="btn btn-outline-primary" id="rbWeather" value="Weather"></input>
		<input type="button" class="btn btn-outline-success" id="rbDengue" value="Dengue"></input>
		<input type="button" class="btn btn-outline-secondary" id="rbHaze" value="Haze"></input>
		<input type="hidden" id="userId" value="<?php session_start(); echo isset($_SESSION['username']) ?>"></input>
        </div>
	</center><br/>

	<div id="map" style="height: 70%;width: 80%;margin: 0 auto"></div>
    <script src="../script/map-script.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-QzO882Yq3gtz_m7yjxHXwhJhFMTSW2c&callback=initMap"
    async defer></script>
	</div>

	<!----------Footer----------->
	<div class = "main-content">
		<?php include('../includes/footer.php');?>
	</div>
</body>
</html>