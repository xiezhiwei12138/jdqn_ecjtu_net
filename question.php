<?php
    session_start();
    error_reporting(null);
    date_default_timezone_set('Asia/Shanghai');
    include("./medoo.min.php");
    $database = new medoo();
?>
<!doctype html>
<html lang="zh-CN">
<head>
	<title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <link href="css/style_one.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="header">
        <img src="images/header.png" width="100%" height="100%" style="position:relative">
    </div>
    <div class="wrapper">
        <div class="top">
            <ul>
                <li class="list">
                    <a href="index.php">查看问题</a>
                </li>
                <li class="list">
                   <a href="question.php">我要提问</a>
                </li>
            </ul>
        </div>
    <form id="question" method="post" action="submit.php">
        <div class="box">
            <span class="tips">标题</span>
            <label>
                <input type="text" class="title_content" name="title">
            </label>
        </div>

        <div class="box">
            <span class="tips">问题描述</span>
            <label>
                <input type="textarea" class="description_content" name="description">
            </label>
        </div>

        <div class="box">
            <span class="tips">姓名</span>
            <label>
                <input type="text" class="title_content" name="user">
            </label>
        </div>

        <div class="box">
            <span class="tips">联系方式</span>
            <label>
                <input type="text" class="title_content" name="call">
            </label>
        </div>
</form>
        <div class="sub">
            <label>
                <input class="sub_button" type="button" value="提交" name="validate">
            </label>
        </div>
        <div id="msg"></div>
    </div>
	<script type="text/javascript">

    $(document).ready(function(){
        $('input[name="validate"]').click(function(){
	    //清除msg里内容
	    $('#msg').html('');

	    //获取各个输入框的值
	    // var userName = $('input[name="userName"]').val();
	    var title = $('input[name="title"]').val(),
	        des = $('input[name="description"]').val(),
	        user = $('input[name="user"]').val(),
	        call=$('input[name="call"]').val();

	    //不允许出现空值
	    var hasValue = title&&des&&user&&call;
	    if(!hasValue){
	       alert("请输入完整的信息！");
	       return false;
	    }
        $.ajax({
          type: 'POST',
          url: "./submit.php",
          data: {"title": title, "des": des, "user": user, "call": call},
          dataType: "json",
          success: function(data){
            if(data.status == "success"){
                alert("提交成功！");
                window.location.href="index.php";
            }
          },
          error: function(){
            alert("程序发生错误了！请重试");
          }
        });

    });
});
	</script>
</body>
</html>