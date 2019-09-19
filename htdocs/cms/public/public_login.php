<html>
<head>
	<?php include('public_header.php');?>
</head>
<body onload="autofill()">
	<!---------------Navigation bar--------------->
	<section id = "nav-bar">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="public_main.php">Unknown Crysis</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<a class="nav-item nav-link active" href="public_login.php">Login</a>
				<a class="nav-item nav-link" href="public_view_map.php">View Map</a>
				<a class="nav-item nav-link" href="public_file_accident.php">File Incident</a>
			</div>
		</div>
		</nav>
	</section>
	
	<!--------Form---------->
	<section>
	<div class = "main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-6">
	<h3 class="label">Login</h3>
	<?php
		if(isset($_GET['error'])){
			if($_GET['error'] == "loginError"){
				echo '<div class="alert alert-danger" role="alert">
 	 						Invalid username or password
						</div>';
			}
			else if($_GET['error'] == "sqlError"){
				echo '<div class="alert alert-danger" role="alert">
 	 						Database connection error. Please try again later
						</div>';
			}
		}
	?>
	<form name="form" method="post" action="..\script\login.php" onsubmit="return validateForm()">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" onchange="verifyUsername()">
			<div id="username_error"></div>
		</div>
		
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" onchange="verifyPassword()">
			<div id="password_error"></div>
		</div>
		<button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
		<button type="button" class="btn btn-light" onclick="cancel()">Cancel</button>
	</form>
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

<!------------------Javascript form validation------------------>
<script>
//autofill (e.g.: if login fail, username is being passed back as querystring and this function autofill the username)
function autofill(){
	var username = document.getElementById('username');
	username.value = getParameterByName('username');
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

//validate username input
function verifyUsername()
{
	var username = document.getElementById('username');
	var username_error = document.getElementById('username_error');
	if(username.value != ""){
		username.blur();
		username_error.innerHTML = "";
		return true;
	}
}
//validate password input
function verifyPassword()
{
	var password = document.getElementById('password');
	var password_error = document.getElementById('password_error');
	if(password.value != ""){
		password.blur();
		password_error.innerHTML = "";
		return true;
	}
}
//validate entire form again
function validateForm(){
	// initialize input elements
	var username = document.getElementById('username');
	var password = document.getElementById('password');
	
	// initialize elements for error msges
	var username_error = document.getElementById('username_error');
	var password_error = document.getElementById('password_error');

	//validate username
	if(username.value == ""){
		username_error.textContent = "Please enter a username";
		username.focus();
		username.select();
		return false;
	}
	
	//validate password
	if(password.value == ""){
		password_error.textContent = "Please enter a password";
		password.focus();
		password.select();
		return false;
	}	
	return true;
}
//when cancel button is clicked
function cancel(){
	//set all elements to default state
	document.getElementById('username').value = '';
	document.getElementById('password').value = '';
	
	//remove all error msges
	document.getElementById('username_error').innerHTML = '';
	document.getElementById('password_error').innerHTML = '';

	if(getParameterByName('error') == 'loginError'){
		var loginError = document.getElementById('loginError');
		loginError.innerText = "";
	}

	if(getParameterByName('error') == 'sqlError'){
		var sqlError = document.getElementById('sqlError');
		sqlError.innerText = "";
	}
}
</script>