<html>
<head>
    <?php include('../classes/agencyController.php'); ?>
    <!----------Header----------->
    <?php include('cco_header.php');?>
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>
</head>
<body onload="startTime()">
    <!----------Top Navigation Bar-------->
    <?php include('cco_top_nav_bar.php');?>

    <!----------Side Navigation Bar-------->
    <?php include('../script/side_nav_bar.php');?>

    <!------------------Dashboard section------------------>
    <section>
        <div class = "main-content">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
            <h3 class="label">Dashboard</h3>

        <!------------------Date and Time------------------>
            <?php
                date_default_timezone_set("Asia/Singapore");
                echo date("l") . "&nbsp;".date("d/m/Y");
            ?>
            <div id="txt"></div>

        <!------------------Directing title------------------>
            <ul style="list-style-type: none;">
                <li style="float:left;text-align: center;padding: 5px;">
                    <a href="#C1">View Statistics</a>
                </li>
                <li style="float:left;text-align: center;padding: 5px;">
                    <a href="#C2">View Filed Incidents</a>
                </li>
            </ul>

            <p>&nbsp;</p>
            <hr>
        <!------------------Table of incident statistics------------------>
            <h4 class="label" id="C1">Incident Statistics</h4>
            <p>&nbsp;</p>

            <table class="table" style="height: 140px;padding: 2px;" border="5" width="900">

            <tbody>
                <tr style="height: 70px; text-align:center;" >
                    <th scope="col" width="150">Fire</th>
                    <th scope="col" width="150">Gas Leak</th>
                    <th scope="col" width="150">Natrual Disaster</th>
                    <th scope="col" width="150">Traffic Accident</th>
                    <th scope="col" width="150">Terrorist Attack</th>
                    <th scope="col" width="150">Others</th>
                </tr>


                <tr style="height: 70px;text-align:center;">
                    <td title="Total number of fire">
                    <?php
                        $incidentController = new agencyController();
                        $count1 = $incidentController->getNumberOfFire();
                        echo $count1;
                        
                    ?></td>
                    <td title="Total number of gas leak">
                    <?php
                        $count2 = $incidentController -> getNumberOfGasLeak();
                        echo $count2;
                    ?></td>
                    <td title="Total number of natural disaster">
                    <?php
                        $count3 = $incidentController -> getNumberOfNaturalDisaster();
                        echo $count3;
                    ?></td>
                    <td title="Total number of traffic accident">
                    <?php
                        $count4 = $incidentController -> getNumberOfTrafficAccident();
                        echo $count4;
                    ?></td>
                    <td title="Total number of terrorist attack">
                    <?php
                        $count5 = $incidentController -> getNumberOfTerroristAttack();
                        echo $count5;
                    ?></td>
                    <td title="Total number of other incidents">
                    <?php
                        $count6 = $incidentController->getNumberOfOthers();
                        echo $count6;
                    ?></td>
                </tr>
            </tbody>
            </table>


            <p>&nbsp;</p>
            <hr>

        <!------------------Filed incidents by cco1------------------>
            <h4 class="label" id="C2">Filed Incidents</h4>
            <p>&nbsp;</p>

            <table class="table" style="height: 140px;padding: 2px;" border="5" width="910">
            <tbody>
                <tr style="height: 70px;text-align:center;">
                    <th scope="col" width="130">ID</th>
                    <th scope="col" width="130">Name</th>
                    <th scope="col" width="130">Mobile No.</th>
                    <th scope="col" width="130">Location</th>
                    <th scope="col" width="130">Emergency Type</th>
                    <th scope="col" width="130">Assistance Type</th>
                    <th scope="col" width="130">File Date Time</th>
                </tr>

            <?php
                $username = "cco1";
                $allIncidentArray = $incidentController->getAllIncidents();
                foreach($allIncidentArray as $row ){
                     if($row["cco_username"] == $username){
            ?>
                <tr style="height: 70px;text-align:center;" title="Information of incidents filed by user 'cco1' ">
                    <th scope="row"><?php echo $row["incidentId"]; ?></th>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["mobileNo"];  ?></td>
                    <td><?php echo $row["location"]; ?></td>
                    <td><?php echo $row["emergencyType"]; ?></td>
                    <td><?php echo $row["typeOfAssistance"]; ?></td>
                    <td><?php echo $row["fileDateTime"]; ?></td>
            <?php
                }
                }
            ?>
                </tr>
            </tbody>
            </table>

            <p>&nbsp;</p>
            <hr>
    <!------------------ ------------------>
        </div>
        </div>
        </div>
        </div>
    </section>


    <!----------Footer----------->
    <div class = "main-content">
        <?php include('../includes/footer.php');?>
    </div>
</body>
</html>
