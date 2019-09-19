<?php
	if(isset($_POST['btn_submit'])){
		include('../classes/cmoController.php');
		include('../classes/pmoController.php');
		include('../classes/locationController.php');
		
		$cmo_severeCase = new severeIncident();

		$cmo_severeCase->setIncidentId($_POST['incidentId']);
		$cmo_severeCase->setSuggestionOnAction($_POST['suggestionOnAction']);
		$cmo_severeCase->setSeverityLevel($_POST['severityLevel']);

		session_start();
		$username = $_SESSION['username'];
		$cmo_severeCase->setCmoUsername($username);
		
		$cmoController = new cmoController();

		$result = $cmoController->insertSevereIncidentDetails($cmo_severeCase);

		if($result == "sqlError"){
			header("Location: ../cmo/cmo_send_request.php?error=sqlError&incidentId=".$cmo_severeCase->getIncidentId()."&suggestionOnAction=".$cmo_severeCase->getSuggestionOnAction()."&severityLevel=".$cmo_severeCase->getSeverityLevel());
			exit();
		}
		
		else if($result == 'insertError'){ //insertError
			header("Location: ../cmo/cmo_send_request.php?error=insertError&incidentId=".$cmo_severeCase->getIncidentId()."&suggestionOnAction=".$cmo_severeCase->getSuggestionOnAction()."&severityLevel=".$cmo_severeCase->getSeverityLevel());
			exit();
		}

		else{ //insert success
			//insert the severe case into pmo db
			//1st, retrieve the incident info of this severe case
            $pmoController = new pmoController();
			$incidentObj = $cmoController->getSpecificIncident($_POST['incidentId']);
        
			//2nd, update "IsSevere" attribute
			$cmoController->updateSeverity($_POST['incidentId']);
			$incidentObj->setIsSevere("true");

			//3rd, insert this incident into pmo's incident table
            $test = $pmoController->insertDetails($incidentObj);

			//4th, insert into pmo's location table
			$locationObj = $cmoController->getSpecificIncidentLatLng($_POST['incidentId']);
			
			$pmoController->insertLatLngDetails($locationObj);

			//3rd, insert pmo severe case db
			$pmoController->insertSevereIncidentDetails($cmo_severeCase);
			header("Location: ../cmo/cmo_view_incident_list.php?result=success");
			exit();
		}
	}
	else{
		header("Location: ../cmo/cmo_view_incident_list.php");
	}
?>