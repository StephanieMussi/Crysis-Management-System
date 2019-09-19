<?php
	include('../classes/cmoController.php');
	include('../classes/pmoController.php');

	if($_GET['confirmReject'] != "true"){
		header("Location: pmo_approve_incident.php");
		exit();
	}

	session_start();
	$pmo_username = $_SESSION['username'];
	$incidentId = $_GET['incidentId'];

	//get the proposed suggestion from confirmReject page:
	$proposedSuggestion = $_GET['proposedSuggestion'];
	
	$pmo_severeCase = new severeIncident();
	$pmo_severeCase->setPmoUsername($pmo_username);
	$pmo_severeCase->setIncidentId($incidentId);
	//add the pmo proposed suggestion to the db
	$pmo_severeCase->setProposedSuggestion($proposedSuggestion);

	$pmoController = new pmoController();
	$result = $pmoController->updatePmoReject($pmo_severeCase);

	if($result == 'success'){
		//if update on pmo severe case db is successful, do the same for updating at cmo severe case db
		$cmoController = new cmoController();
		$cmoController->updatePmoReject($pmo_severeCase);


		header("Location: ../pmo/pmo_approve_incident_list.php?result=success&incidentId=".$incidentId);
		exit();
	}
	else if($result == 'sqlError'){
		header("Location: ../pmo/pmo_view_more_info.php?error=sqlError&incidentId=".$incidentId);
		exit();
	}
	else{
		header("Location: ../pmo/pmo_view_more_info.php?error=insertError&incidentId=".$incidentId);
		exit();
	}
?>