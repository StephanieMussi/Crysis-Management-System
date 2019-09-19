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

	<!-----Fixed content for view incident page------->
	<?php include('cmo_view_incident_list_header.php');?>
	
	<!------------Incident table--------------->
	<div class = "main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">	
	<table class="table" id="table">
		<thead class="thead-light">
			<tr>
				<th scope="col" width="5%">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Location</th>
				<th scope="col">Emergency Type</th>
				<th scope="col">Assistance Type</th>
                <th scope="col">Status</th>
				<th scope="col" width="10%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$incidentController = new cmoController();

				$closedIncidentArray = $incidentController->getAllClosedIncidents();
				/* From incident db table
				0: incidentId, 1: name, 2: mobileNo, 3: location, 4: emergencyType, 5: typeOfAssistance, 6: remarks, 7: fileDateTime, 8: cco_username, 9: status, 10: statusDateTime, 11: IsSevere, 12: unitNo
				*/	
				foreach($closedIncidentArray as $row ){
			?>
			<tr>
				<th scope="row"><?php echo $row["incidentId"]; ?></th>
				<td><?php echo $row["name"] ?></td>
				<td><?php echo $row["location"]; ?></td>
				<td><?php echo $row["emergencyType"]; ?></td>
				<td><?php echo $row["typeOfAssistance"]; ?></td>
					<td><span class="btn btn-secondary disabled">Closed</span></td>
					<td><a href="cmo_view_more.php?viewMore=true&incidentId=<?php echo $row["incidentId"];?>"><i class="fas fa-eye"></i></a></td>		
			<?php
				}
			?>

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
                "order": [[ 5, "asc" ]]
            } );
        } );
    </script>
</body>
</html>