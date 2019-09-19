<?php
	session_start();
	$username = $_SESSION['username'];
	
	if(isset($_POST['btn_confirm'])){
		include('../classes/cmoController.php');
		
		$incident = new incident();

		$incident->setName($_POST['name']);
		$incident->setMobileNo($_POST['mobileNo']);
		$incident->setLocation($_POST['location']);
		$incident->setEmergencyType($_POST['emergencyType']);
		
		$fireFighting = $_POST['fireFighting'];
		$emergencyAmbulance = $_POST['emergencyAmbulance'];
		$rescueAndEvacuation = $_POST['rescueAndEvacuation'];
		$gasLeakControl = $_POST['gasLeakControl'];
		$msg = "";
		$i = 0;
		if($fireFighting == 'checked'){
			$msg .= "Fire-Fighting";
			$i++;
		}
		if($emergencyAmbulance == 'checked'){
			if($i > 0){
				$msg .= ", Emergency Ambulance";
			}
			else{
				$msg .= "Emergency Ambulance";
			}
			$i++;
		}
		if($rescueAndEvacuation == 'checked'){
			if($i > 0){
				$msg .= ", Rescue and Evacuation";
			}
			else{
				$msg .= "Rescue and Evacuation";
			}
			$i++;
		}
		if($gasLeakControl == 'checked'){
			if($i > 0){
				$msg .= ", Gas Leak Control";
			}
			else{
				$msg .= "Gas Leak Control";
			}
			$i++;
		}

		$incident->setTypeOfAssistance($msg);
		$incident->setLatitude($_POST['lat']);
		$incident->setLongitude($_POST['lng']);
		
		if($_POST['unitNo'] == 'nil'){
			$incident->setUnitNo('');
		}
		else{
			$incident->setUnitNo($_POST['unitNo']);
		}

		if($incident->getRemarks()){
			$incident->setRemarks('');
		}
		else{
			$incident->setRemarks($_POST['remarks']);
		}
		echo($msg);

		
		$incident->setCcoUsername($username);

		$cmoController = new cmoController();
		$result = $cmoController->insertDetails($incident);


		if($result == 'sqlError'){
			//convert back to the right format be passed back as querystrings
			if(!($incident->getEmergencyType() == 'Fire' || $incident->getEmergencyType() == 'Terrorist Attack' || $incident->getEmergencyType() == 'Gas Leak' || $incident->getEmergencyType() == 'Natural Disaster' || $incident->getEmergencyType() == 'Traffic Accident')){
				$others = $incident->getEmergencyType();
				$incident->setEmergencyType('Others');
			}

			if($incident->getUnitNo() == ''){
				$incident->setUnitNo('nil');
			}

			if($incident->getRemarks() == ''){
				$incident->setRemarks('nil');
			}

			if($username == NULL){
				header("Location: ../public/public_confirm_incident.php?error=sqlError&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
				exit();
			}
			else{
				header("Location: ../cco/cco_confirm_incident.php?error=sqlError&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
				exit();
			}
		}

		else if($result == 'insertError'){
			//convert back to the right format be passed back as querystrings
			if(!($incident->getEmergencyType() == 'Fire' || $incident->getEmergencyType() == 'Terrorist Attack' || $incident->getEmergencyType() == 'Gas Leak' || $incident->getEmergencyType() == 'Natural Disaster' || $incident->getEmergencyType() == 'Traffic Accident')){
				$others = $incident->getEmergencyType();
				$incident->setEmergencyType('Others');
			}

			if($incident->getUnitNo() == ''){
				$incident->setUnitNo('nil');
			}

			if($incident->getRemarks() == ''){
				$incident->setRemarks('nil');
			}


			if($username == NULL){
				header("Location: ../public/public_confirm_incident.php?error=insertError&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
				exit();
			}
			else{
				header("Location: ../cco/cco_confirm_incident.php?error=insertError&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
				exit();
			}
		}
		
		else { //insert success returns incident id of the incident that just got created.
			//location obj to be created only upon successfully insertion of incident into incident db
            $incident->setIncidentId($result);
			$cmoController ->insertLatLngDetails($incident);

			if($username == NULL){
				header("Location: ../public/public_confirm_incident.php?result=success&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
			}
			else{
				header("Location: ../cco/cco_confirm_incident.php?result=success&name=".$incident->getName()."&mobileNo=".$incident->getMobileNo()."&location=".$incident->getLocation()."&lat=".$lat."&lng=".$lng."&unitNo=".$incident->getUnitNo()."&emergencyType=".$incident->getEmergencyType()."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$incident->getRemarks());
			}
		}
	}
	else{
		if($username == NULL){
			header("Location: ../public/public_file_accident.php");
		}
		else{
			header("Location: ../cco/cco_file_accident.php");
		}
	}
?>