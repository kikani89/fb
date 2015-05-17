<?php
	error_reporting(0);
	include('lib/config.php');
	$response['status']=false;
	$zip_name = $_SESSION['fbuser'];
	$zip_name=basename(str_replace(' ', '_', $zip_name));
	$zip_name = "./$zip_name.zip";
	unlink($zip_name);
?>