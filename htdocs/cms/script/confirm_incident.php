<?php
	if(isset($_POST['btn_submit'])){
		session_start();
		$name = $_POST['name'];
		$mobileNo = $_POST['mobileNo'];
		$location = $_POST['location'];
		$unitNo = $_POST['unitNo'];
		if($unitNo == NULL){
			$unitNo = "nil";
		}

		$latitude = $_POST['lat'];
		$longitude = $_POST['lng'];
		
		$emergencyType = $_POST['emergencyType'];
		if($emergencyType == 'Others'){
			$others = $_POST['others_option']; 
		}
		else{
			$others = "nil";
		}

		$assistanceType = $_POST['assistanceType'];

		$assistanceTypeArray = array();
		$i = 0;

		foreach($_POST['assistanceType'] as $selected){
			echo $selected."<br/>";
			$assistanceTypeArray[$i] = $selected;
			$i++;
		}

		$fireFighting = 'unchecked';
		$emergencyAmbulance = 'unchecked';
		$rescueAndEvacuation = 'unchecked';
		$gasLeakControl = 'unchecked';

		for($m=0; $m < $i; $m++){
			if($assistanceTypeArray[$m] == 'Fire-Fighting'){
				$fireFighting='checked';
			}
			else if($assistanceTypeArray[$m] == 'Emergency Ambulance'){
				$emergencyAmbulance='checked';
			}
			else if($assistanceTypeArray[$m] == 'Rescue and Evacuation'){
				$rescueAndEvacuation='checked';
			}
			else if($assistanceTypeArray[$m] == 'Gas Leak Control'){
				$gasLeakControl='checked';
			}
		}

		$remarks = $_POST['remarks'];
		if($remarks == NULL){
			$remarks = "nil"; 
		}
        echo $_SESSION['username'];

		if($_SESSION['username'] == NULL)
		{
			header("Location: ../public/public_confirm_incident.php?submit=true&name=".$name."&mobileNo=".$mobileNo."&location=".$location."&unitNo=".$unitNo."&lat=".$latitude."&lng=".$longitude."&emergencyType=".$emergencyType."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$remarks);
		}
		else if($_SESSION['type'] == "cco"){
			header("Location: ../cco/cco_confirm_incident.php?submit=true&name=".$name."&mobileNo=".$mobileNo."&location=".$location."&unitNo=".$unitNo."&lat=".$latitude."&lng=".$longitude."&emergencyType=".$emergencyType."&others=".$others."&fireFighting=".$fireFighting."&emergencyAmbulance=".$emergencyAmbulance."&rescueAndEvacuation=".$rescueAndEvacuation."&gasLeakControl=".$gasLeakControl."&remarks=".$remarks);
		}
	}
	else{
		if($_SESSION['username'] == NULL){
			header("Location: ../public/public_file_accident.php");
		}
		else if($_SESSION['type'] == "cco"){
			header("Location: ../cco/cco_file_accident.php");
		}
	}
?>