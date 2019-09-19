<html>
<head>
	<?php include('../classes/pmoController.php'); ?>

	<!----------Header----------->
	<?php include('pmo_header.php');?>
</head>
<body onload="fillFunction()">
	<!----------Top Navigation Bar-------->
	<?php include('pmo_top_nav_bar.php');?>

	<!----------Side Navigation Bar-------->
	<?php include('../script/side_nav_bar.php');?>

	<!----------------Approve incident list-------------->
	<div class = "main-content">
	<div class="container">
	<div class="col-md-12">
	<div class="row">
		<h3 class="label">Resolved Incident Detail</h3>
	</div>
	</div>
	</div>
	</div>
	<!------------Incident Info--------------->

	<?php
		if(isset($_GET['action'])!='true'){
			header("Location: pmo_view_resolved_list.php");
			exit();
		}
		else if($_GET['action'] != 'viewMoreResolved'){
			if($_GET['action'] != 'viewArchive'){
				header("Location: pmo_view_resolved_list.php");
				exit();
			}
		}

		$incidentController = new pmoController();
		//$incidentController->setAccessToken("pmo");
		$incidentId = $_GET['incidentId'];
		$result = $incidentController->getSpecificIncident($incidentId);

		//$severeCaseController = new severeIncidentController();
		//$severeCaseController->setAccessToken("pmo");
		$result1 = $incidentController->getSpecificSevereCase($incidentId);

		if($result == 'viewSentRequestError'){
			echo '<p class="viewSentRequestError" style="color:red">Database execution error. Please try again later</p>';
		}
		else if($result == 'sqlError'){
			echo '<p class="sqlError" style="color:red">Database connection error. Please try again later</p>';
		}
	?>

	<div class = "main-content">
	<div class="col-md-10">	
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
					<label for="name" class="boldlbl">Name:</label>
				</td>
				<td>
					<?php echo($result->getName()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="mobileNo" class="boldlbl">Mobile No.:</label>
				</td>
				<td>
					<?php echo($result->getMobileNo()); ?>
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
					<label for="emergencyType" class="boldlbl">Type of Emergency:</label>
				</td>
				<td>
					<?php echo($result->getEmergencyType()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="assistanceType" class="boldlbl">Type of Assistance:</label>
				</td>
				<td>
					<?php echo($result->getTypeOfAssistance()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="remarks" class="boldlbl">Remarks:</label>
				</td>
				<td>
					<?php echo($result->getRemarks()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="dateTime" class="boldlbl">File Date Time:</label>
				</td>
				<td>
					<?php echo($result->getFileDateTime()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="filedBy" class="boldlbl">Filed By:</label>
				</td>
				<td>
					<?php 
						if($result->getCcoUsername() == ""){
							echo "Public";
						}
						else{
							echo ($result->getCcoUsername());
						}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="severityLevel" class="boldlbl">Severity Level:</label>
				</td>
				<td>
					<?php echo($result1->getSeverityLevel()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="suggestion" class="boldlbl">Suggestion on Action:</label>
				</td>
				<td>
					<?php echo($result1->getSuggestionOnAction()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="requestSentBy" class="boldlbl">Request Sent By:</label>
				</td>
				<td>
					<?php echo($result1->getCmoUsername()); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="requestSentBy" class="boldlbl">PMO Proposed Suggestion:</label>
				</td>
				<td>
					<?php 
						if($result1->getProposedSuggestion() == ""){ //means accept
							echo($result1->getSuggestionOnAction()); 
						}
						else{
							echo($result1->getProposedSuggestion());
						}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<button class="btn btn-basic" onclick="backBtn()">Back</button>
				</td>
			</tr>
		</table>
	</div>
	</div>






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
	//incidentId
	var incidentId = document.getElementById('incidentId');
	incidentId.value = getParameterByName('incidentId');
}

function backBtn(){
	var prev = getParameterByName('action');
	if(prev == 'viewMoreResolved'){
		url = "pmo_view_resolved_list.php";
		window.location.assign(url);
	}
	else if(prev == 'viewArchive'){
		url = "pmo_view_archive.php";
		window.location.assign(url);
	}
}


</script>