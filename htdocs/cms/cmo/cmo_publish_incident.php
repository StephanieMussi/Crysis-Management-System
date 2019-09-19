<html>
<head>
	<!----------Header----------->
	<?php include('../classes/cmoController.php'); ?>
	<?php include('cmo_header.php');?>
</head>
<body>
	<!----------Top Navigation Bar-------->
	<?php include('cmo_top_nav_bar.php');?>

	<!----------Side Navigation Bar-------->
	<?php include('../script/side_nav_bar.php');?>

	<!----------------Publish Incident-------------->
	<div class = "main-content">
	<div class="container">
	<div class="col-md-12">
	<div class="row">
		<h3 class="label">Publish Incident</h3>
	</div>
	<div class="row">
		<p>Select an incident to publish to Facebook or Twitter</p>
	</div><br/>
	<div class="row">
	<table class="table" id="table">
		<thead class="thead-light">
			<tr>
				<th scope="col" width="10%">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Location</th>
				<th scope="col">Emergency Type</th>
				<th scope="col">Assistance Type</th>
				<th scope="col" width="15%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$incidentController = new cmoController();
				//$incidentController->setAccessToken("cmo");
				$allIncidentArray = $incidentController->getAllOpenIncidents();
				/* From incident db table
				0: incidentId, 1: name, 2: mobileNo, 3: location, 4: emergencyType, 5: typeOfAssistance, 6: remarks, 7: fileDateTime, 8: cco_username, 9: status, 10: statusDateTime, 11: IsSevere, 12: unitNo
				*/

				foreach($allIncidentArray as $row ){
					$hasPmoResponded = $incidentController->hasPmoResponded($row['incidentId']);
					$hasDispatched = $incidentController->hasDispatched($row['incidentId']);
					if(($row['IsSevere'] == "false" &&  $hasDispatched == true) || ($row['IsSevere'] == "true" && $hasPmoResponded == true)){
					/* i.e.: 1) not severe (notified agency) OR 
							 2) severe but pmo has already responded
					*/
			?>
					<tr>
						<th scope="row"><?php echo $row['incidentId']; ?></th>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td><?php echo $row['emergencyType']; ?></td>
						<td><?php echo $row['typeOfAssistance']; ?></td>
						<td><a href="cmo_publish_incident_page.php?publishIncident=true&incidentId=<?php echo $row['incidentId'];?>"><i class="fas fa-eye"></i></a></td>	
			<?php
					}
				}
			?>
			</tr>
		</tbody>
	</table>
	</div>
	</div>
	</div>
	</div>

	<!----------Footer----------->
	<div class = "main-content">
		<?php include('../includes/footer.php');?>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable( {
                "order": [[ 0, "asc" ]]
            } );
        } );
    </script>

</body>
</html>