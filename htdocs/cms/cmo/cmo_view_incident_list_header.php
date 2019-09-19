<html>
<body>
	<!----------------View Incident List-------------->
	<div class = "main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
		<br/>
		<?php
			if(isset($_GET['result'])){
				if($_GET['result'] == 'success'){
					echo '<div class="alert alert-success" role="alert">
  							Request has been submitted successfully.
						</div>';
				}
				else if($_GET['result'] == 'dispatchSuccess'){
					echo '<div class="alert alert-success" role="alert">
  							Incident has been dispatched to agencies.
						</div>';
				}
			}
			else if(isset($_GET['error'])){
				if($_GET['error'] == 'sqlError'){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database connection error. Please try again later
						</div>';
				}
				else if($_GET['error'] == 'viewSentRequestError'){
					echo '<div class="alert alert-danger" role="alert">
 	 						Database execution error. Please try again later
						</div>';
				}
			}
		?>
		<h3 class="label">Incident List</h3>
		<!--------Table Filter----------->
		<center>
			<a href="cmo_view_incident_list.php" class="btn btn-outline-primary">All</a>
			<a href="cmo_view_incident_list_view_pending.php" class="btn btn-outline-info">Pending</a>
			<a href="cmo_view_incident_list_view_notified.php" class="btn btn-outline-success">Notified</a>
			<a href="cmo_view_incident_list_view_closed.php" class="btn btn-outline-secondary">Closed</a>
		</center>
	</div>
	</div>
	</div>
	</div>
</body>
</html>