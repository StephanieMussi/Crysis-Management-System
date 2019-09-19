<?php
	include('../classes/agencyController.php');
	include('../classes/cmoController.php');

	if($_GET['confirmUpdate'] != "true"){
		header("Location: agency_view_incident_list.php");
		exit();
	}
	

	session_start();
	$agency_username = $_SESSION['username'];
	$incidentId = $_GET['incidentId'];
	$status = $_GET['status'];
	$msg = $_GET['msg'];
	$numDeath = 0;
	$numInjured = 0;

	if($status == "Resolved"){
		$numDeath = $_GET['death'];
		$numInjured = $_GET['injured'];
	}

	$updatesObj = new updates();
	$updatesObj->setAgencyUsername($agency_username);
	$updatesObj->setMsg($msg);
	$updatesObj->setUpdateStatus($status);
	$updatesObj->setIncidentId($incidentId);
	$updatesObj->setNumDeaths($numDeath);
	$updatesObj->setNumInjured($numInjured);
	
	$agencyController = new agencyController();
	$cmoController = new cmoController();
	$updateResult = $agencyController->insertUpdateInformation($updatesObj);
	$updateResultCmo = $cmoController->insertUpdateInformation($updatesObj);

	if($updateResult == 'success' && $updateResultCmo == 'success'){
		//if successfully updated, 
		header("Location: ../agency/agency_view_incident_list.php?result=".$updateResult);
		exit();
	}
	else if($result == 'sqlError'){
		header("Location: ../agency/agency_view_incident_list.php?error=sqlError&incidentId=".$incidentId);
		exit();
	}
	else{
		header("Location: ../agency/agency_view_incident_list.php?error=insertError&incidentId=".$incidentId);
		exit();
	} 
	?>