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
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>编号</th>
						<th>标题</th>
						<th>时间</th>
						<th>分配</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$list = $database->select("question", "*", array(
						"isreply"=>0,
						"ORDER"=>"time DESC"
					));
					for($i=0; $i<count($list); ++$i){
						echo '<tr class="success">';
						echo '<form action="ajax_manager.php" method="post">';
							echo '<input type="hidden" name="qid" value="'.$list[$i]['id'].'">';
							echo '<td>'.($i+1).'</td>';
							echo '<td>'.$list[$i]['title'].'</td>';
							echo '<td>'.$list[$i]['time'].'</td>';
							echo '<td>';
								echo '<select class="form-control" name="uid">';
							         echo '<option value="1">创新创业与就业服务联盟</option>';
							         echo '<option value="2">素质拓展服务联盟</option>';
							         echo '<option value="3">维权服务联盟</option>';
							         echo '<option value="4">青年志愿服务联盟</option>';
							         echo '<option value="5">青年教师服务联盟</option>';
							    echo '</select>';
							echo '</td>';
							echo '<td><button class="btn" type="submit" name="submit">确定</button></td>';
						echo '</form>';
						echo '</tr>';
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>