<?php
	session_start();
	error_reporting(null);
	date_default_timezone_set('Asia/Shanghai');
	include("./medoo.min.php");
	$database = new medoo();
	if(isset($_POST['uid']) && isset($_POST['qid'])){
		$database->insert("who",array(
			"qid"=>$_POST['qid'],
			"uid"=>$_POST['uid']
		));
		$database->update("question",array(
			"isreply"=>1
			),array(
			"id"=>$_POST['qid']
		));
		header("Location: manager.php");
	}
	
?>