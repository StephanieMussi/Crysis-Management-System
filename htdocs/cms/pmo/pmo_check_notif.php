<?php


include('../classes/incident.php');
include('../classes/pmoController.php');

$incidentController = new pmoController();
$result = $incidentController->getNotifySevereIncident();


if(sizeof($result)>0)
{
    echo json_encode($result);
}else{
    echo "NIL";
}

?>