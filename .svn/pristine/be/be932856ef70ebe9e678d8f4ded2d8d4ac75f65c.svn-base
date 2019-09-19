<?php
	if(isset($_POST['btn_submit'])){
		$incidentId = $_POST['incidentId'];
		$emergencyType = $_POST['emergencyType'];
		$assistanceType = $_POST['assistanceType'];
		$remarks = $_POST['remarks'];

		$dispatchArray = array();
		$i = 0;

		foreach($_POST['dispatch'] as $selected){
			echo $selected."<br/>";
			$dispatchArray[$i] = $selected;
			$i++;
		}

		$scdf = 'unchecked';
		$spf = 'unchecked';
		$sof = 'unchecked';
		$_995 = 'unchecked';
		$sp = 'unchecked';

		for($m=0; $m < $i; $m++){
			if($dispatchArray[$m] == 'SCDF'){
				$scdf='checked';
			}
			else if($dispatchArray[$m] == 'SPF'){
				$spf='checked';
			}
			else if($dispatchArray[$m] == 'SOF'){
				$sof='checked';
			}
			else if($dispatchArray[$m] == '995'){
				$_995='checked';
			}
			else if($dispatchArray[$m] == 'Singapore Power'){
				$sp='checked';
			}
		}
		
		header("Location: ../cmo/cmo_confirm_sms.php?preview=true&incidentId=".$incidentId."&emergencyType=".$emergencyType."&assistanceType=".$assistanceType."&remarks=".$remarks."&scdf=".$scdf."&spf=".$spf."&sof=".$sof."&995=".$_995."&sp=".$sp);
	}
	else{
		header("Location: ../cmo/cmo_send_sms.php");
	}
?>