<?php
	require "vendor/autoload.php";
	include('../classes/cmoController.php');

	use Abraham\TwitterOAuth\TwitterOAuth;
 
	define('CONSUMER_KEY', 'KyGfC0ocuSg4ofYwVmNLPZhgd');
	define('CONSUMER_SECRET', '4tgHCJGdv9cQeTUeBqcU9HHAL79T3TYBdpslgb43tuEsHHp1iN');
	define('ACCESS_TOKEN', '1109003141230395393-ZMzMJZGDH8yGOabkvazyqSZRea92mi');
	define('ACCESS_TOKEN_SECRET', 'wGtTSkCXlemoqlFB6aGhluFRIeEYsZ6zb2xsHxnzn8A89');
 
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
	$status = $_POST["infoInput"]; //text for tweet.
	$post_tweets = $connection->post("statuses/update", ["status" => $status]);
	
		define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/Facebook/');
	require_once(__DIR__.'/Facebook/autoload.php');

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

	session_start();
	$cmo_username = $_SESSION['username'];

	//insert into publish db
	$fb_publish = new publish();
	$fb_publish->setIncidentId($incidentId);
	$fb_publish->setMsg($status);
	$fb_publish->setType('facebook');
	$fb_publish->setCmoUsername($cmo_username);


	$twitter_publish = new publish();
	$twitter_publish->setIncidentId($incidentId);
	$twitter_publish->setMsg($status);
	$twitter_publish->setType('twitter');
	$twitter_publish->setCmoUsername($cmo_username);


	$cmoController = new cmoController();

	$cmoController->insertPublishDetails($fb_publish);
	$cmoController->insertPublishDetails($twitter_publish);

	$incidentId = $_POST['incidentId'];
	$emergencyType = $_POST['emergencyType'];
	$location = $_POST['location'];
	header("Location: ../cmo/cmo_confirm_publish_incident.php?incidentId=".$incidentId."&emergencyType=".$emergencyType."&location=".$location);



	header("Location: ../cmo/cmo_confirm_publish_incident.php?incidentId=".$incidentId."&emergencyType=".$emergencyType."&location=".$location);
?>