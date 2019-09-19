<html>
<head>
	<?php include('../classes/cmoController.php'); ?>
	
	<!----------Header----------->
	<?php include('cmo_header.php');?>
</head>
<body>
	<!----------Top Navigation Bar-------->
	<?php include('cmo_top_nav_bar.php');?>

	<!----------Side Navigation Bar-------->
	<?php include('../script/side_nav_bar.php');?>

	<!----------------Close Incident-------------->
	<div class = "main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<br/>
		<?php
			if(isset($_GET['error'])){
				if($_GET['error'] == "updateError"){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database execution error. Please try again later
						</div>';
				}
				else if($_GET['error'] == "sqlError"){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database connection error. Please try again later
						</div>';
				}
			}
			else if(isset($_GET['result'])){
				if($_GET['result'] == 'success'){
					echo '<div class="alert alert-success" role="alert">
  							Incident has been closed.
						</div>';
				}
			}
		?>
		<h3 class="label">Close Incident</h3>
		<p>These are incidents that have been resolved and can be closed</p>
	<br/>
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
				$allIncidentArray = $incidentController->getAllOpenIncidents();
				/* From incident db table
				0: incidentId, 1: name, 2: mobileNo, 3: location, 4: emergencyType, 5: typeOfAssistance, 6: remarks, 7: fileDateTime, 8: cco_username, 9: status, 10: statusDateTime
				*/

				//1st, check if it has been dispatched to agency
				//2nd, check if agency has already updated the status of this incident has resolved or not
				foreach($allIncidentArray as $row ){
					$hasDispatched = $incidentController->hasDispatched($row['incidentId']);
					$isResolved = $incidentController->isResolved($row['incidentId']);

					if($hasDispatched == true && $isResolved == true){
			?>
					<tr>
						<th scope="row"><?php echo $row['incidentId']; ?></th>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td><?php echo $row['emergencyType']; ?></td>
						<td><?php echo $row['typeOfAssistance']; ?></td>
						<td><a href="cmo_close_incident.php?close=true&incidentId=<?php echo($row['incidentId']); ?>" ><i class="fas fa-eye"></i></a></td>		
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