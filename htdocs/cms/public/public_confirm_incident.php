<html>
<head>
	<?php include('public_header.php');?>
</head>
<body onload="fillFunction()">
	<!-------------------Navigation bar---------------->
	<section id = "nav-bar">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="public_main.php">Unknown Crysis</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link" href="public_login.php">Login</a>
				<a class="nav-item nav-link" href="public_view_map.php">View Map</a>
				<a class="nav-item nav-link active" href="public_file_accident.php">File Incident</a>
			</div>
		</div>
		</nav>
	</section>
	
	<!------------------------Form------------------------->
	<section>
	<div class = "main-content">
		<div class="container">
		<div class="row">
		<div class="col-md-6">
		<h3 class="label">Confirm Incident</h3>

		<?php
			if(isset($_GET['error'])){
				if($_GET['error'] == "insertError"){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database execution error. Please try again later
						</div>';
				}
				else if($_GET['error'] == "sqlError"){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database connection error. Please try again later
						</div>';
				}
			}
			else if(isset($_GET['result'])){
				if($_GET['result'] == 'success'){
					echo '<div class="alert alert-success" role="alert">
  							Incident has been submitted successfully.
						</div>';
				}
			}
			else if(isset($_GET['submit'])){
				if($_GET['submit'] != 'true'){ //if this page is not a result of clicking submit button on public file accident page
					header("Location: public_file_accident.php");
					exit();
				}
			}
			else{
				header("Location: public_file_accident.php");
				exit();
			}
		?>
		<form name="form" method="post" action="..\script\incident_filing.php">
			<table class="table table-borderless">
			<div class="form-group">
				<tr>
					<td>
						<label for="name" class="confirm_label">Name:</label>
					</td>
					<td>
						<input type="hidden" id="nameInput" name="name"></input><!---input type so that can be passed to server. label cannot be read by server--->
						<label id="lblNameInput"></label>
					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="mobileNo" class="confirm_label">Mobile Number:</label>
					</td>
					<td>
						<input type="hidden" id="mobileNoInput" name="mobileNo"></input>
						<label id="lblMobileNoInput"></label>
					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="location" class="confirm_label">Location:</label>
					</td>
					<td>
						<input type="hidden" id="locationInput" name="location"></input>
						<label id="lblLocationInput"></label>
						<input type="hidden" id="lat" name="lat"></input>
						<input type="hidden" id="lng" name="lng"></input>

					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="unitNo" class="confirm_label">Unit Number:</label>
					</td>
					<td>
						<input type="hidden" id="unitNoInput" name="unitNo"></input>
						<label id="lblUnitNoInput"></label>
					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="emergency_type" class="confirm_label">Types of Emergency:</label>
					</td>
					<td>
						<input type="hidden" id="emergency_typeInput" name="emergencyType"></input>
						<label id="lblEmergency_typeInput"></label>
					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="assistanceType" class="confirm_label">Type of Assistance:</label>
					</td>
					<td>
						<input type="hidden" id="fireFighting" name="fireFighting"></input>
						<input type="hidden" id="emergencyAmbulance" name="emergencyAmbulance"></input>
						<input type="hidden" id="rescueAndEvacuation" name="rescueAndEvacuation"></input>
						<input type="hidden" id="gasLeakControl" name="gasLeakControl"></input>
						<label id="lblAssistanceTypeInput"></label>
					</td>
				</tr>
			</div>
			<div class="form-group">
				<tr>
					<td>
						<label for="remarks" class="confirm_label">Remarks:</label>
					</td>
					<td>
						<input type="hidden" id="remarksInput" name="remarks"></input>
						<label id="lblRemarksInput"></label>
					</td>
				</tr>
			</div>
			<tr>
				<td>
					<button type="button" id="btn_edit" class="btn btn-light" onclick="edit()">Edit</button>
				</td>
				<td>
					<button type="submit" id="btn_confirm" name="btn_confirm" class="btn btn-primary float-right">Confirm</button>
					
				</td>
			</tr>
			<tr>
				<td>
					<button type="button" id="btn_back" class="btn btn-light" onclick="back()">Back</button>
				</td>
			</tr>
		</table>
		</form>
		</div>
		</div>
		</div>
		</div>
	</section>
	
	<!----------Footer----------->
	<div class = "main-content">
		<?php include('../includes/footer.php');?>
	</div>
</body>
</html>

<!---------------Client-side Validation----------------->
<script>
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&]*)|&|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

//fill in label with values based on querystring passed
function fillFunction(){
	//name
	var name = document.getElementById('nameInput'); //input type:hidden for passing to server
	var lblName = document.getElementById('lblNameInput'); //label for display
	name.value = getParameterByName('name');
	lblName.innerText = getParameterByName('name');
	
	//mobileNo
	var mobileNo = document.getElementById('mobileNoInput'); //for input type
	var lblMobileNo = document.getElementById('lblMobileNoInput'); //for label
	mobileNo.value = getParameterByName('mobileNo');
	lblMobileNo.innerText = getParameterByName('mobileNo');
	
	//location
	var location = document.getElementById('locationInput'); //for input type
	var lblLocation = document.getElementById('lblLocationInput'); //for label
	location.value = getParameterByName('location');
	lblLocation.innerText = getParameterByName('location');

	//unitNo
	var unitNo = document.getElementById('unitNoInput'); //for input type
	var lblUnitNo = document.getElementById('lblUnitNoInput'); //for label
	unitNo.value = getParameterByName('unitNo');
	lblUnitNo.innerText = getParameterByName('unitNo');
	if (unitNo.value == 'nil'){
		unitNo.value = "-";
		lblUnitNo.innerText = '-';
	}


	//latitude and longitude
	var lat = document.getElementById('lat');
	var lng = document.getElementById('lng');
	lat.value = getParameterByName('lat');
	lng.value = getParameterByName('lng');
	
	//emergencyType for input type
	var emergencyType = document.getElementById('emergency_typeInput');
	emergencyType.value = getParameterByName('emergencyType');
	if (emergencyType.value == 'Others'){
		emergencyType.value = getParameterByName('others');
	}
	
	//emergencyType for label
	var lblEmergencyType = document.getElementById('lblEmergency_typeInput');
	lblEmergencyType.innerText = getParameterByName('emergencyType');
	if (lblEmergencyType.innerText == 'Others'){
		lblEmergencyType.innerText = getParameterByName('others');
	}
	
	//assistanceType for input type
	var fireFighting = document.getElementById('fireFighting');
	var emergencyAmbulance = document.getElementById('emergencyAmbulance');
	var rescueAndEvacuation = document.getElementById('rescueAndEvacuation');
	var gasLeakControl = document.getElementById('gasLeakControl');
	
	fireFighting.value = getParameterByName('fireFighting');
	emergencyAmbulance.value = getParameterByName('emergencyAmbulance');
	rescueAndEvacuation.value = getParameterByName('rescueAndEvacuation');
	gasLeakControl.value = getParameterByName('gasLeakControl');

	//assistanceType for label
	var lblAssistanceType = document.getElementById('lblAssistanceTypeInput');

	var msg = "";
	var i = 0;
	if(getParameterByName('fireFighting') == 'checked'){
		msg += "Fire-Fighting";
		i++;
	}
	if(getParameterByName('emergencyAmbulance') == 'checked'){
		if(i > 0){
			msg += ", Emergency Ambulance";
		}
		else{
			msg += "Emergency Ambulance";
		}
		i++;
	}
	if(getParameterByName('rescueAndEvacuation') == 'checked'){
		if(i > 0){
			msg += ", Rescue and Evacuation";
		}
		else{
			msg += "Rescue and Evacuation";
		}
		i++;
	}
	if(getParameterByName('gasLeakControl') == 'checked'){
		if(i > 0){
			msg += ", Gas Leak Control";
		}
		else{
			msg += "Gas Leak Control";
		}
		i++;
	}
	lblAssistanceType.innerText = msg;

	//remarks
	var lblRemarks = document.getElementById('lblRemarksInput');
	lblRemarks.innerText = getParameterByName('remarks');
	var remarks = document.getElementById('remarksInput'); //for input type
	remarks.value = getParameterByName('remarks');
	if (remarks.value == 'nil'){
		remarks.value = "-";
		lblRemarks.innerText = "-";
	}

	btn_back.style.visibility='hidden';


	//hide buttons if insert successfully
	var btn_confirm = document.getElementById('btn_confirm');
	var btn_edit = document.getElementById('btn_edit');
	if(getParameterByName('result')=='success'){
		btn_confirm.style.visibility='hidden';
		btn_edit.style.visibility='hidden';
		btn_back.style.visibility='visible';
	}
}

//when user clicks the edit button
function edit(){
	var name = document.getElementById('nameInput').value;
	var mobileNo = document.getElementById('mobileNoInput').value;
	var location = document.getElementById('locationInput').value;
	var unitNo = document.getElementById('unitNoInput').value;
	if(unitNo == '-'){
		unitNo = 'nil';
	}
	
	var emergencyType = document.getElementById('emergency_typeInput').value;
	var others = 'nil';
	if(!(emergencyType == 'Fire' || emergencyType == 'Gas Leak' || emergencyType == 'Terrorist Attack' || emergencyType == 'Traffic Accident' || emergencyType == 'Natural Disaster')){
		others = emergencyType;
		emergencyType = 'Others';
	}
	
	var fireFighting = document.getElementById('fireFighting').value;
	var emergencyAmbulance = document.getElementById('emergencyAmbulance').value;
	var rescueAndEvacuation = document.getElementById('rescueAndEvacuation').value;
	var gasLeakControl = document.getElementById('gasLeakControl').value;
	
	var remarks = document.getElementById('remarksInput').value;
	if(remarks == '-'){
		remarks = 'nil';
	}
	
	url = "public_file_accident.php?edit=true&name="+name+"&mobileNo="+mobileNo+"&location="+location+"&unitNo="+unitNo+"&emergencyType="+emergencyType+"&others="+others+"&fireFighting="+fireFighting+"&emergencyAmbulance="+emergencyAmbulance+"&rescueAndEvacuation="+rescueAndEvacuation+"&gasLeakControl="+gasLeakControl+"&remarks="+remarks;
	window.location.assign(url);
}

function back(){
	url = "public_main.php";
	window.location.assign(url);	
}
</script>