<meta charset="utf-8">
<?php

  session_start();
  error_reporting(null);
  date_default_timezone_set('Asia/Shanghai');
  if(isset($_SESSION['uid'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">
  </head>

  <body>
   
    <div class="container">
     <?php

            include "./medoo.min.php";
            $database = new medoo();
            if($_POST['username'] && $_POST['password']){
              $info = $database->select("user", "*", array(
                "AND"=>array(
                  "name"=>$_POST['username'],
                  "password"=>$_POST['password']
                )
              ));
              if(count($info)>0){
                $_SESSION['uid'] = $info[0]['id'];
                $_SESSION['name'] = $info[0]['name'];
                $_SESSION['admin'] = $info[0]['admin'];
                if($info[0]['id']<100){
                  header("Location: my.php");
                }else{
                  header("Location: manager.php");
                }
              }else{
                echo "<h1>用户名或密码错误</h1>";
              }
            }
      ?>
      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">登录</h2>
        <label for="inputEmail" class="sr-only">用户名</label>
        <input type="text" id="inputEmail" name="username" class="form-control" placeholder="登录名" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword"  name="password" class="form-control" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">登录</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
