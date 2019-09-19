<?php


include('../classes/incident.php');
include('../script/cmo_dbh.php');

$sql = "SELECT * FROM incident NATURAL JOIN location WHERE status = 'open';";
$result2 = mysqli_query($conn, $sql);
$dbdata = array();


while ( $row = $result2->fetch_assoc())  {
    $dbdata[]=$row;
}

$fp = fopen('results1.json', 'w');
fwrite($fp, json_encode($dbdata));
fclose($fp);


//echo "Hi";

?>