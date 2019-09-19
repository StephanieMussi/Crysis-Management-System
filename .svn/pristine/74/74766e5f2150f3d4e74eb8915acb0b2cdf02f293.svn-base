<?php


//include('../classes/incident.php');
include('../classes/cmoController.php');

$incidentController = new cmoController();
$result = $incidentController->getUpdateAgency();

if(sizeof($result)>0)
{
    echo json_encode($result);
}else{
    echo "NIL";
}

?>