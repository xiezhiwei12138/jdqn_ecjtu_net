<?php
	session_start();
	// error_reporting(null);
	if(!isset($_SESSION['uid'])){
		header("Location: login.php");
		exit;
	}
	date_default_timezone_set('Asia/Shanghai');
	include("./medoo.min.php");
	$database = new medoo();
	if(isset($_GET['qid']) && isset($_POST['reply'])){
		$name = $database->select("user", "name", array(
			"id"=>$_SESSION['uid']
		));
		$database->insert("answer",array(
			"qid"=>$_GET['qid'],
			"name"=>$name[0],
			"content"=>$_POST['reply']
		));
		$database->update("question",array(
			"isanswer"=>1
			),array(
			"id"=>$_GET['qid']
		));
		header("Location: my.php");
	}
	
?>