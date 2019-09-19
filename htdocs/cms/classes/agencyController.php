<?php
    include_once ('incident.php');
    include_once ('updates.php');
    include_once ('dispatch.php');
    class agencyController
    {

        protected $accesstoken;
        protected $scriptname;

        function __construct() {
            $this->scriptname =  "../script/agency_dbh.php";
        }

        /*public function setAccessToken($token)
        {
            $this->accesstoken = $token;
            switch ($this->accesstoken) {
                case "cco":
                    {
                        $this->scriptname = "../script/cco_dbh.php";
                        break;
                    }

                case "pmo":
                    {
                        $this->scriptname =  "../script/pmo_dbh.php";
                        break;
                    }

                case "agency":
                    {
                        $this->scriptname =  "../script/agency_dbh.php";
                        break;
                    }

                case "cmo":
                    {
                        $this->scriptname =  "../script/cmo_dbh.php";
                        break;
                    }
                default:
                    echo "Invalid Session Token found";
            }

        }
        */

        //other methods
        public function getSpecificIncident($incidentId)
        {
            include ($this->scriptname);
            //query to get all incidents
            $sql = "SELECT * FROM incident WHERE incidentId=?;";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if ($row != NULL) { //there is such incidentId
                $incident = new incident();

                $incident->setIncidentId($row["incidentId"]);
                $incident->setName($row["name"]);
                $incident->setMobileNo($row["mobileNo"]);
                $incident->setLocation($row["location"]);
                $incident->setEmergencyType($row["emergencyType"]);
                $incident->setTypeOfAssistance($row["typeOfAssistance"]);
                $incident->setRemarks($row["remarks"]);
                $incident->setFileDateTime($row["fileDateTime"]);
                $incident->setCcoUsername($row["cco_username"]);
                $incident->setStatus($row["status"]);
                $incident->setStatusDateTime($row["statusDateTime"]);
                $incident->setIsSevere($row["IsSevere"]);
                $incident->setUnitNo($row["unitNo"]);
                return $incident; //return incident obj
            } else {
                return "viewSentRequestError";
            }
        }

        public function getAllIncidentsByEmergencyType($emergencyType)
        {
            include ($this->scriptname);

            $sql = "SELECT * FROM incident WHERE status = 'open' AND emergencyType = ?;";

            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "s", $emergencyType);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            //stores number of rows in results
            //$resultCheck = mysqli_num_rows($result);

            return $result;
        }

        public function getOtherIncidents()
        {
            //query to get all other open incidents
            include ($this->scriptname);

            $sql = "SELECT * FROM incident WHERE emergencyType != 'Terrorist Attack' AND emergencyType != 'Natural Disaster' AND emergencyType != 'Fire'AND emergencyType != 'Traffic Accident' AND emergencyType != 'Gas Leak';";

            //run query
            $result = mysqli_query($conn, $sql);
            return $result;
        }

        public function getAllClosedIncidents()
        {
            //query to get all closed incidents
            include ($this->scriptname);

            $sql = "SELECT * FROM incident WHERE status = 'closed';";

            //run query
            $result = mysqli_query($conn, $sql);
            return $result;
        }


        public function getAllOpenIncidents(){ 
            //query to get all open incidents
            include ($this->scriptname);

            $sql = "SELECT * FROM incident WHERE status = 'open';";
        
            //run query
            $result = mysqli_query($conn, $sql);
    
            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);
            return $result;
        }

        public function getAllIncidents(){ 
            //query to get all incidents
            include ($this->scriptname);

            $sql = "SELECT * FROM incident;";
        
            //run query
            $result = mysqli_query($conn, $sql);
            return $result;
        }

        public function closeIncident($incident){
            include($this->scriptname);

            $sql = "UPDATE incident SET statusDateTime=CURRENT_TIMESTAMP,status='closed' WHERE incidentId=?";
            
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }
    
            mysqli_stmt_bind_param($stmt, "s", $incident->getIncidentId());
            
            $result = mysqli_stmt_execute($stmt);
            if($result == true){ //update success
                return "success";
            }
            else{
                return "updateError";
            }
        }

        public function updateSeverity($incidentId){
            include($this->scriptname);

            $sql = "UPDATE incident SET IsSevere='true' WHERE incidentId=?";
            
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }
    
            mysqli_stmt_bind_param($stmt, "s", $incidentId);
            
            $result = mysqli_stmt_execute($stmt);
            if($result == true){ //update success
                return "success";
            }
            else{
                return "updateError";
            }
        }

        public function insertDetails($incident){ //pass incident obj
            include($this->scriptname);
            //query to insert record into incident db

            if ($incident->getIncidentId() != null) {
                $sql = "INSERT INTO incident(incidentId,name,mobileNo,location,emergencyType,typeOfAssistance,remarks,fileDateTime,cco_username,IsSevere,unitNo) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    return "sqlError";
                }

                mysqli_stmt_bind_param($stmt, "sssssssssss", $incident->getIncidentId(), $incident->getName(), $incident->getMobileNo(), $incident->getLocation(), $incident->getEmergencyType(), $incident->getTypeOfAssistance(), $incident->getRemarks(), $incident->getFileDateTime(), $incident->getCcoUsername(), $incident->getIsSevere(), $incident->getUnitNo());

                $result = mysqli_stmt_execute($stmt);
                if ($result == true) { //insert success
                    return "success";
                    //return mysqli_insert_id($conn);
                } 
                else {
                    return "insertError";
                }
            } 
            else {
                $sql = "INSERT INTO incident(name,mobileNo,location,emergencyType,typeOfAssistance,remarks,cco_username,unitNo) VALUES(?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    return "sqlError";
                }

                mysqli_stmt_bind_param($stmt, "ssssssss", $incident->getName(), $incident->getMobileNo(), $incident->getLocation(), $incident->getEmergencyType(), $incident->getTypeOfAssistance(), $incident->getRemarks(), $incident->getCcoUsername(), $incident->getUnitNo());

                $result = mysqli_stmt_execute($stmt);
                if ($result == true) { //insert success
                    return mysqli_insert_id($conn);
                } 
                else {
                    return "insertError";
                }
            }
        }

        public function getSpecificIncidentLatLng($incidentId){
            //include('../script/cmo_dbh.php');
            include ($this->scriptname);
            //query to get all incidents
            $sql = "SELECT * FROM location WHERE incidentId=?;";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt,$sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if($row != NULL){ //there is such incidentId

                $incident = new incident();

                $incident->setIncidentId($row["incidentId"]);
                $incident->setLatitude($row["latitude"]);
                $incident->setLongitude($row["longitude"]);
                return $incident; //return location obj
            }
            else{
                return "viewError";
            }
        }

        public function getAllIncidentsLatLng(){
            //query to get all incidents
            //include('../script/cmo_dbh.php');
            include($this->scriptname);

            $sql = "SELECT * FROM location;";

            //run query
            $result = mysqli_query($conn, $sql);

            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            //$locationArray = array();

            $m = 0;

            /*if($result->num_rows> 0){
                /*while($rows = mysqli_fetch_row($result)){
                /* From location db table
                0: incidentId, 1: latitude, 2: longitude
                    $locationArray[$m] = array();
                    for($i=0; $i< 3; $i++){
                        $locationArray[$m][$i] = $rows[$i];
                    }
                    $m++;
                }
            }*/
            return $result;
        }

        public function insertLatLngDetails($incident)
        { //pass location obj
            //include('../script/cmo_dbh.php');
            include ($this->scriptname);

            //query to insert record into location db
            $sql = "INSERT INTO location(incidentId,latitude,longitude) VALUES(?,?,?)";


            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_bind_param($stmt, "sss", $incident->getIncidentId(), $incident->getLatitude(), $incident->getLongitude());

            $result = mysqli_stmt_execute($stmt);
            if($result == true)
            { //insert success
                return "Success";
            }
            else
            {
                return "insertError";
            }
        }

        public function insertDispatchDetails($dispatch){ //pass dispatch obj
            include($this->scriptname);
            //query to insert record into dispatch db
            $sql = "INSERT INTO dispatch(cmo_username, incidentId, dispatchUnits) VALUES(?,?,?)";

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_bind_param($stmt, "sss", $dispatch->getCmoUsername(), $dispatch->getIncidentId(), $dispatch->getDispatchUnits());

            $result = mysqli_stmt_execute($stmt);
            if($result == true){ //insert success
                return mysqli_insert_id($conn);
            }
            else{
                return "insertError";
            }
        }

        public function hasDispatched($incidentId){ //this function checks if msg has been dispatched previously
            include($this->scriptname);
            //query to get all incidents
            $sql = "SELECT * FROM dispatch WHERE incidentId=?;";

            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt,$sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if($row != NULL){
                //i.e.: means there is record in dispatch db with this incidentId. so, it has already been dispatched
                return true;
            }
            else{
                return false;
            }
        }

        public function getAllDispatched(){ //get all incidents that has been dispatched/notified
            include($this->scriptname);

            $sql = "SELECT * FROM dispatch NATURAL JOIN incident;";

            //run query
            $result = mysqli_query($conn, $sql);

            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            return $result;
        }

        public function getSpecificDispatchDetails($incidentId)
        {
            include ($this->scriptname);

            $sql = "SELECT * FROM dispatch WHERE incidentId = ?;";

            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            //stores number of rows in results
            //$resultCheck = mysqli_num_rows($result);
            if ($row != NULL) { //there is such incidentId
                $dispatch = new dispatch();

                $dispatch->setIncidentId($row["incidentId"]);
                $dispatch->setCmoUsername($row["cmo_username"]);
                $dispatch->setDispatchUnits($row["dispatchUnits"]);
                $dispatch->setDispatchDateTime($row["dispatchDateTime"]);
                
                return $dispatch; //return dispatch obj
            } else {
                return "viewSentRequestError";
            }
        }

        public function isResolved($incidentId){
            include($this->scriptname);
            //query to get all incidents
            $sql = "SELECT * FROM updates WHERE incidentId=? AND updateStatus='Resolved';";

            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt,$sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if($row != NULL){ //i.e.: it is resolved
                return true;
            }
            else{
                return false;
            }
        }


        //Method 1 : Insert Into Updates Table
        public function insertUpdateInformation($updates){ //pass update obj
            include($this->scriptname);
            //query to insert record into updates db
            $sql = "INSERT INTO updates(incidentId,msg,agency_username,updateStatus,numDeaths,numInjured) VALUES(?,?,?,?,?,?)";

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_bind_param($stmt, "ssssss", $updates->getIncidentId(), $updates->getMsg(), $updates->getAgencyUsername(), $updates->getUpdateStatus(), $updates->getNumDeaths(), $updates->getNumInjured());

            $result = mysqli_stmt_execute($stmt);
            if($result == true){ //insert success
                return "success";
            }
            else{
                return "insertError";
            }

        }

        //Method 2: Retrieve all msg and time stamp of the incident
        public function getAllMsg($incidentId){
            include($this->scriptname);
            //query to get all incidents
            $sql = "SELECT msg, updateDateTime,numDeaths,numInjured, updateStatus FROM updates WHERE incidentId=? ORDER BY updateDateTime;";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt,$sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                return $result;
            }
            return false;
        }

        //Method 3: Retrieve status of the incident
        public function getStatus($incidentId){
            include($this->scriptname);
            //query to get all incidents
            $sql = "SELECT updateStatus FROM updates WHERE incidentId=? AND updateStatus='Resolved'";

            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt,$sql);

            mysqli_stmt_bind_param($stmt, "s", $incidentId);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if($row != NULL){

                return true;
            }
            else{
                return false;
            }
        }

        public function getNumberOfFire(){
            include($this->scriptname);
            $fireCount = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType = 'Fire';";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $fireCount = $resultCheck['COUNT(*)'];

            }

            return $fireCount;

        }

        //Gas Leak
        public function getNumberOfGasLeak(){
            include($this->scriptname);
            $count = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType = 'Gas Leak';";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $count = $resultCheck['COUNT(*)'];

            }

            return $count;

        }

        //Terrorist Attack
        public function getNumberOfTerroristAttack(){
            include($this->scriptname);
            $count = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType = 'Terrorist Attack' ;";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $count = $resultCheck['COUNT(*)'];

            }

            return $count;

        }

        //Traffic Accident
        public function getNumberOfTrafficAccident(){
            include($this->scriptname);
            $count = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType = 'Traffic Accident' ;";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $count = $resultCheck['COUNT(*)'];

            }

            return $count;

        }

        //Natural Disaster
        public function getNumberOfNaturalDisaster(){
            include($this->scriptname);
            $count = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType = 'Natural Disaster' ;";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $count = $resultCheck['COUNT(*)'];

            }

            return $count;

        }

        //Others

        public function getNumberOfOthers(){
            include($this->scriptname);
            $count = 0;

            $sql = "SELECT COUNT(*) FROM incident WHERE emergencyType != 'Terrorist Attack' AND emergencyType != 'Natural Disaster' AND emergencyType != 'Fire'AND emergencyType != 'Traffic Accident' AND emergencyType != 'Gas Leak';";
            //run query
            $result = mysqli_query($conn, $sql);


            //stores number of rows in results
            $resultCheck = mysqli_num_rows($result);

            while ($resultCheck = mysqli_fetch_assoc($result)) {
                $count = $resultCheck['COUNT(*)'];

            }

            return $count;

        }

        //Get the number of deaths in a month
        public function getNumberOfDeath($month){
            include($this->scriptname);

            $count = 0;
            $sql = "SELECT SUM(numDeaths) FROM updates WHERE MONTHNAME(updateDateTime) = ?";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "s", $month);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if ($row != NULL) {
                $count = $row['SUM(numDeaths)'];
            }
            return $count;
        }

        //Get the number of injuries in a month
        public function getNumberOfInjuries($month){
            include($this->scriptname);

            $count = 0;
            $sql = "SELECT SUM(numInjured) FROM updates WHERE MONTHNAME(updateDateTime) = ?";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return "sqlError";
            }

            mysqli_stmt_prepare($stmt, $sql);

            mysqli_stmt_bind_param($stmt, "s", $month);

            //run query
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if ($row != NULL) {
                $count = $row['SUM(numInjured)'];
            }
            return $count;
        }
    }
?>