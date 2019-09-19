<?php
//echo $_SESSION['username']; $scope.bool = true;
?>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function($scope) {
        <?php
        if(isset($_SESSION['username']) && $_SESSION["username"]=="pmo1") {
        ?>
        $scope.user = "pmo1";

        <?php } elseif (isset($_SESSION['username']) && $_SESSION["username"]=="cmo1") { ?>

        $scope.user = "cmo1";

        <?php } elseif (isset($_SESSION['username']) && $_SESSION["username"]=="cco1") {?>

        $scope.user = "cco1";

        <?php } elseif (isset($_SESSION['username']) && $_SESSION["username"]=="agency1") { ?>

        $scope.user = "agency1";

        <?php } ?>

    });



</script>
	<!----------Side Navigation Bar-------->

<div ng-app="myApp"  ng-controller="myCtrl">
	<div class="sidenav p-3 mb-2 bg-light text-dark" ng-show="user=='pmo1'">
  		<a class="nav-item nav-link" href="pmo_main.php">
			<span><i class="fas fa-home"></i></span>
			<span>Dashboard</span>
		</a>
  		<a class="nav-item nav-link active" href="pmo_view_map.php">
			<span><i class="fas fa-map-marker-alt"></i></span>

			<span>View Map</span>
		</a>
		<a class="nav-item nav-link" href="../cmo/test.pdf">
			<i class="fas fa-file"></i>
			<span>View Report</span>
		</a>
		<a class="nav-item nav-link" href="pmo_approve_incident_list.php">
			<i class="fas fa-exclamation-triangle"></i>
			<span>Approve Incident List</span>
		</a>
		<a class="nav-item nav-link" href="pmo_view_resolved_list.php">
            <i class="fas fa-check-square"></i>
            <span>Ongoing Resolved List</span>
        </a>
        <a class="nav-item nav-link" href="pmo_view_archive.php">
            <i class="fas fa-archive"></i>
            <span>Archive</span>
        </a>
	</div>
    <div class="sidenav p-3 mb-2 bg-light text-dark" ng-show="user=='cmo1'">
        <a class="nav-item nav-link" href="cmo_main.php">
            <span><i class="fas fa-home"></i></span>
            <span>Dashboard</span>
        </a>
        <a class="nav-item nav-link active" href="cmo_view_map.php">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <span>View Map</span>
        </a>
        <a class="nav-item nav-link" href="cmo_view_incident_list.php">
            <span><i class="fas fa-clipboard-list"></i></span>
            <span>View Incident List</span>
        </a>
        <a class="nav-item nav-link" href="cmo_publish_incident.php">
            <i class="fas fa-upload"></i>
            <span>Publish Incident</span>
        </a>
        <a class="nav-item nav-link" href="cmo_update_incident_status.php">
            <i class="fas fa-window-close"></i>
            <span>Close Incident</span>
        </a>
    </div>
    <div class="sidenav p-3 mb-2 bg-light text-dark" ng-show="user=='cco1'">
        <a class="nav-item nav-link" href="cco_main.php">
            <span><i class="fas fa-home"></i></span>
            <span>Dashboard</span>
        </a>
        <a class="nav-item nav-link active" href="cco_view_map.php">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <span>View Map</span>
        </a>
        <a class="nav-item nav-link" href="cco_file_accident.php">
            <span><i class="fas fa-clipboard-list"></i></span>
            <span>File Incident</span>
        </a>
    </div>
    <div class="sidenav p-3 mb-2 bg-light text-dark" ng-show="user=='agency1'">
        <a class="nav-item nav-link" href="agency_main.php">
            <span><i class="fas fa-home"></i></span>
            <span>Dashboard</span>
        </a>
        <a class="nav-item nav-link active" href="agency_view_map.php">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <span>View Map</span>
        </a>
        <a class="nav-item nav-link" href="agency_view_incident_list.php">
            <span><i class="fas fa-clipboard-list"></i></span>
            <span>View Incident List</span>
        </a>
    </div>
</div>
</html>