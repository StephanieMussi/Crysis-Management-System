<?php
	include('../classes/cmoController.php');
	include('../classes/pmoController.php');
	include('../classes/agencyController.php');

	if($_GET['confirmClose'] != "true"){
		header("Location: cmo_update_incident_status.php");
		exit();
	}
	

	session_start();
	//for cmo, pmo and agency db, update statusDateTime and status in incident table
	$incidentId = $_GET['incidentId'];

	$cmo_incident = new incident();
	$cmo_incident->setStatus("closed");
	$cmo_incident->setIncidentId($incidentId);

	$cmoController = new cmoController();
	$result = $cmoController->closeIncident($cmo_incident);

	echo($result);

	if($result == 'success'){
		//if successfully updated the incident table for cmo db, do the same for pmo and agency
		$pmoController = new pmoController();
		$pmoController->closeIncident($cmo_incident);

		$agencyController = new agencyController();
		$agencyController->closeIncident($cmo_incident);

		header("Location: ../cmo/cmo_update_incident_status.php?result=success&incidentId=".$incidentId);
		exit();
	}
	else if($result == 'sqlError'){
		header("Location: ../cmo/cmo_update_incident_status.php?error=sqlError&incidentId=".$incidentId);
		exit();
	}
	else{
		header("Location: ../cmo/cmo_update_incident_status.php?error=insertError&incidentId=".$incidentId);
		exit();
	}
?>