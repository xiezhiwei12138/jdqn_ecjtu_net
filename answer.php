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
<!doctype html>
<html lang="zn-CN">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <link href="css/style_four.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="wrapper">
        <div class="content">
        <?php
            $info = $database->select("question", "*", array(
                "id"=>$_GET['qid']
            ));
            if(count($info)>0){
                echo '<form action="ajax_answer.php?qid='.$_GET['qid'].'" method="post">';
                echo '<div class="photo">';
                    echo '<img src="images/pic'.rand(1,3).'.png" width="100" height="100">';
                echo '</div>';
                echo '<div class="que">';
                    echo '<span>'.$info[0]['name'].'：</span>';
                echo '</div>';
                echo '<div class="time">';
                    echo '<span>提问时间：'.$info[0]['time'].'</span>';
                echo '</div>';
                echo '<div class="que">';
                    echo '<span>问题描述：</span>';
                echo '</div>';
                echo '<div class="que_content">';
                    echo '<span>'.$info[0]['content'].'</span>';
                echo '</div>';
                echo '<div class="answer">';
                    echo '<textarea type="text" class="answer_input" cols="80" rows="8" name="reply"></textarea>';
                echo '</div>';
                echo '<div class="sub">';
                    echo '<input type="submit" value="提交" class="submit">';
                echo '</div>';
            echo '</form>';
            }
        ?>
        </div>
    </div>
</body>
</html>