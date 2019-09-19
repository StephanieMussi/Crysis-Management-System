<?php
	include('../classes/pmoController.php');
	include('../classes/cmoController.php');

	if($_GET['confirmAccept'] != "true"){
		header("Location: pmo_approve_incident.php");
		exit();
	}
	

	session_start();
	$pmo_username = $_SESSION['username'];
	$incidentId = $_GET['incidentId'];

	$pmo_severeCase = new severeIncident();
	$pmo_severeCase->setPmoUsername($pmo_username);
	$pmo_severeCase->setIncidentId($incidentId);

	$pmoController = new pmoController();
	$result = $pmoController->updatePmoAccept($pmo_severeCase);

	if($result == 'success'){
		//if successfully updated the severecase for the pmo db, do the same for cmo db so that they can see the response
		$cmoController = new cmoController();
		$cmoController->updatePmoAccept($pmo_severeCase);

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