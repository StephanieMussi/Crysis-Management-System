<?php

	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/Facebook/');
	require_once(__DIR__.'/Facebook/autoload.php');
	include('../classes/cmoController.php');

	$fb = new Facebook\Facebook([
 		'app_id' => '430422817500262',
 		'app_secret' => '9a07cf04348fb53cb97d4fb6cfb5be76',
 		'default_graph_version' => 'v3.2',
	]);

	//Post property to Facebook
	$linkData = [
 		'message' => $_POST['infoInput']
	];

	$pageAccessToken ='EAAGHd58j7GYBABPwUM1JUcg43GclDyoU7iKriCJcLTMIuYkHBXf9uusZBialCI5yM4M7ZBndNk7wIDQfw8WBZCwUXWzZAGWrCa0Ah9543yUbinOhWgb62Tn73bsazI8OAZC5Erv5WXCxCOaBCnZAPFo6hlBDVs9eZAcAohbHn10RmsEy3CQzyFq';

	try {
 		$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
 		echo 'Graph returned an error: '.$e->getMessage();
 		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
 		echo 'Facebook SDK returned an error: '.$e->getMessage();
 		exit;
	}
	$graphNode = $response->getGraphNode();

	$incidentId = $_POST['incidentId'];
	$emergencyType = $_POST['emergencyType'];
	$location = $_POST['location'];
	

	//insert into publish db
	$publish = new publish();
	$publish->setIncidentId($incidentId);
	$publish->setMsg($_POST['infoInput']);
	$publish->setType('facebook');

	session_start();
	$cmo_username = $_SESSION['username'];
	$publish->setCmoUsername($cmo_username);

	$cmoController = new cmoController();
	
	$cmoController->insertPublishDetails($publish);


	header("Location: ../cmo/cmo_confirm_publish_incident.php?incidentId=".$incidentId."&emergencyType=".$emergencyType."&location=".$location);
?>