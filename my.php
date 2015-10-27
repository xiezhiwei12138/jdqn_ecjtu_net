<meta charset="utf-8">
<?php
	session_start();
    // error_reporting(null);
    date_default_timezone_set('Asia/Shanghai');
    if(!isset($_SESSION['uid'])){
    	header("Location: login.php");
    	exit;
    }
    include "./medoo.min.php";
    $database = new medoo();

?>
<html>
<head>
<link href="./bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="http://www.francescomalagrino.com/BootstrapPageGenerator/3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							标题
						</th>
						<th>
							时间
						</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$list = $database->select("who", "qid", array(
						"uid"=>$_SESSION['uid'],
						"ORDER"=>"id DESC"
					));
					for($i=0; $i<count($list); $i++){
						$info = $database->select("question", array("id","title","time"), array(
							"AND"=>array(
								"id"=>$list[$i],
								"isanswer"=>0
							),
							"ORDER"=>"time DESC"
						));
						if(count($info)>0){
							echo '<tr class="success">';
							echo '<td>'.($i+1).'</td>';
							echo '<td><a href="answer.php?qid='.$list[$i].'">'.$info[0]['title'].'</a></td>';
							echo '<td>'.$info[0]['time'].'</td>';
							echo '</tr>';
						}
					}	
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>