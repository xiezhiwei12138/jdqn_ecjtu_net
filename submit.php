<?php
	session_start();
	error_reporting(null);
	date_default_timezone_set('Asia/Shanghai');
	include("./medoo.min.php");
	$database = new medoo();
	if(isset($_POST['title'])){
		$database->insert("question",array(
			"name"=>$_POST['user'],
			"title"=>$_POST['title'],
			"content"=>$_POST['des'],
			"call"=>$_POST['call'],
			"isreply"=>0,
			"isanswer"=>0
		));
		$result = array();
		$result['status']= "success";
		echo json_encode($result);
	}else{
		$result = array();
		$result['status']= "wrong";
		echo json_encode($result);
	}

?>