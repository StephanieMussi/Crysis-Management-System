<html>
<head>
	<?php include('../classes/cmoController.php'); ?>

	<!----------Header----------->
	<?php include('cmo_header.php');?>
</head>
<body onload="fillFunction()">
	<!----------Top Navigation Bar-------->
	<?php include('cmo_top_nav_bar.php');?>

	<!----------Side Navigation Bar-------->
	<?php include('../script/side_nav_bar.php');?>

	<!----------------View Sent Request-------------->
	<section>
		<div class = "main-content">
		<div class="container">
		<div class="row">
		<div class="col-md-8">
		<h3 class="label">Preview Message</h3>
		<?php
			if(isset($_GET['preview'])!= true){
				header("Location: cmo_send_sms.php");
				exit();
			}

			$incidentController = new cmoController();
			//$incidentController->setAccessToken("cmo");
			$incidentId = $_GET['incidentId'];
			$result = $incidentController->getSpecificIncident($incidentId);

			if($result == 'viewSentRequestError'){
				echo '<div class="alert alert-danger" role="alert">
 	 						Database execution error. Please try again later
						</div>';
			}
			else if($result == 'sqlError'){
				echo '<div class="alert alert-danger" role="alert">
 	 						Database connection error. Please try again later
						</div>';
			}
	?>
	</section>
	<div class = "main-content">
	<div class="col-md-12">	
	<form name="form" method="post" action="..\script\incident_bot.php">
		<table class="table table-borderless">
			<col class="wide">
			<tr>
				<td>
					<label for="incidentId" class="boldlbl">Incident ID:</label>
				</td>
				<td>
					<?php echo($incidentId); ?>
					<input type="hidden" id="incidentId" name="incidentId"></input><!---input type so that can be passed to server. label cannot be read by server--->
				</td>
			</tr>
			<tr>
				<td>
					<label for="emergencyType" class="boldlbl">Incident Type:</label>
				</td>
				<td>
					<label id="lblEmergencyType"></label>
					<input type="hidden" class="form-control" id="emergencyType" name="emergencyType">
				</td>
			</tr>
			<tr>
				<td>
					<label for="assistanceType" class="boldlbl">Type of Assistance:</label>
				</td>
				<td>
					<label id="lblAssistanceType"></label>
					<input type="hidden" class="form-control" id="assistanceType" name="assistanceType">
				</td>
			</tr>
			<tr>
				<td>
					<label for="dateTime" class="boldlbl">Date and Time:</label>
				</td>
				<td>
					<?php echo($result->getFileDateTime()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="location" class="boldlbl">Location:</label>
				</td>
				<td>
					<?php echo($result->getLocation()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="dispatchUnit" class="boldlbl">Dispatch Unit:</label>
				</td>
				<td>
					<label id="lblDispatchUnit"></label>
					<input type="hidden" class="form-control" id="scdf" name="scdf">
					<input type="hidden" class="form-control" id="spf" name="spf">
					<input type="hidden" class="form-control" id="sof" name="sof">
					<input type="hidden" class="form-control" id="995" name="995">
					<input type="hidden" class="form-control" id="sp" name="sp">
				</td>
			</tr>
			<?php
				if($result->getUnitNo() != "" && $result->getUnitNo() != "-"){
			?>
					<tr>
						<td>
							<label class="boldLbl">Unit Number:</label>
						</td>
						<td>
							<?php echo($result->getUnitNo()); ?>
						</td>
					</tr>
			<?php		
				}
			?>
			<tr>
				<td>
					<label for="name" class="boldlbl">Witness:</label>
				</td>
				<td>
					<?php echo($result->getName()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="mobileNo" class="boldlbl">Witness's Mobile No.:</label>
				</td>
				<td>
					<?php echo($result->getMobileNo()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="remarks" class="boldlbl">Remarks:</label>
				</td>
				<td>
					<label id="lblRemarks"></label>
					<input type="hidden" class="form-control" rows="3" id="remarks" name="remarks">
				</td>
			</tr>

			<!-----------------button----------------->
			<tr>
				<td>
					<button type="button" id="btn_edit" class="btn btn-light" onclick="edit()">Edit</button>
				</td>
				<td>
					<!------TO CALL TELEGRAM SCRIPT-------->
					<button type="submit" name="btn_submit" class="btn btn-primary">Send</button>
				</td>
			</tr>
		</table>
	</form>
	</div>
	</div>
	
	<!----------Footer----------->
	<div class = "main-content">
		<?php include('../includes/footer.php');?>
	</div>
</body>
</html>

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

function fillFunction(){

    startTime();
	var lblEmergencyType = document.getElementById('lblEmergencyType');
	var lblAssistanceType = document.getElementById('lblAssistanceType');
	var lblRemarks = document.getElementById('lblRemarks');
	var lblDispatchUnit = document.getElementById('lblDispatchUnit');

	lblEmergencyType.innerText = getParameterByName('emergencyType');
	lblAssistanceType.innerText = getParameterByName('assistanceType');
	lblRemarks.innerText = getParameterByName('remarks');
	
	var msg = "";
	var i = 0;
	if(getParameterByName('scdf') == 'checked'){
		msg += "SCDF";
		i++;
	}
	if(getParameterByName('spf') == 'checked'){
		if(i > 0){
			msg += ", SPF";
		}
		else{
			msg += "SPF";
		}
		i++;
	}
	if(getParameterByName('sof') == 'checked'){
		if(i > 0){
			msg += ", SOF";
		}
		else{
			msg += "SOF";
		}
		i++;
	}
	if(getParameterByName('995') == 'checked'){
		if(i > 0){
			msg += ", 995";
		}
		else{
			msg += "995";
		}
		i++;
	}
	if(getParameterByName('sp') == 'checked'){
		if(i > 0){
			msg += ", Singapore Power";
		}
		else{
			msg += "Singapore Power";
		}
		i++;
	}
	lblDispatchUnit.innerText = msg;

	//for input type = hidden
	var incidentId = document.getElementById('incidentId');
	var emergencyType = document.getElementById('emergencyType');
	var assistanceType = document.getElementById('assistanceType');
	var remarks = document.getElementById('remarks');
	var scdf = document.getElementById('scdf');
	var spf = document.getElementById('spf');
	var sof = document.getElementById('sof');
	var _995 = document.getElementById('995');
	var sp = document.getElementById('sp');

	incidentId.value = getParameterByName('incidentId');
	emergencyType.value = getParameterByName('emergencyType');
	assistanceType.value = getParameterByName('assistanceType');
	remarks.value = getParameterByName('remarks');
	scdf.value = getParameterByName('scdf');
	spf.value = getParameterByName('spf');
	sof.value = getParameterByName('sof');
	_995.value = getParameterByName('995');
	sp.value = getParameterByName('sp');

}

function edit(){ //pass back incidentId, emergency type, type of assistance and remarks and dispatch units
	var incidentId = document.getElementById('incidentId').value;
	var emergencyType = document.getElementById('emergencyType').value;
	var assistanceType = document.getElementById('assistanceType').value;
	var remarks = document.getElementById('remarks').value;
	var scdf = document.getElementById('scdf').value;
	var spf = document.getElementById('spf').value;
	var sof = document.getElementById('sof').value;
	var _995 = document.getElementById('995').value;
	var sp = document.getElementById('sp').value;

	url = "cmo_notify.php?edit=true&incidentId="+incidentId+"&emergencyType="+emergencyType+"&assistanceType="+assistanceType+"&remarks="+remarks+"&scdf="+scdf+"&spf="+spf+"&sof="+sof+"&995="+_995+"&sp="+sp;
	window.location.assign(url);
}
</script>