<?php


//include('../classes/incident.php');
include('../classes/cmoController.php');


$incidentController = new cmoController();
$result = $incidentController->getResponsePMO();

if($result!=null)
{
    echo json_encode($result);
}else{
    echo "NIL";
}

?>