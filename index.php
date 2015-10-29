<?php
    session_start();
    // error_reporting(null);
    date_default_timezone_set('Asia/Shanghai');
    include "./medoo.min.php";
    $database = new medoo();
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <link href="css/style_two.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="w_w">
    <div class="header">
        <img src="images/header.png" width="100%" height="100%" style="position:relative">
    </div>

    <div class="wrapper" id="show">
        <div class="top">
            <ul style="width:100%;height:10%;display:block; position:relative; float:left;">
                <ul>
                <li class="list">
                    <a href="index.php">查看问题</a>
                </li>
                <li class="list">
                   <a href="question.php">我要提问</a>
                </li>
            </ul>
            </ul>
        </div>
<?php
    
    $list = $database->select("question", "*", array(
        "ORDER"=>"time DESC"
    ));
    for($i=0; $i<count($list); ++$i){
        echo '<div class="window1">';
            echo '<div class="question">';
                echo '<img src="images/pic'.rand(1,3).'.png" class="photo" width="40" height="40">';
                echo '<div class="line1">';
                    if($list[$i]['name'] == ""){
                       echo '<span>匿名:</span> ';
                    }else{
                        echo '<span>'.$list[$i]['name'].':</span> ';
                    }
                echo '</div>';
                echo '<div class="line2">';
                    echo '<span>'.$list[$i]['title'].'</span>';
                echo '</div>';
                echo '<div class="line3">';
                    echo '<span>'.$list[$i]['content'].'</span>';
                echo '</div>';
                echo '<div class="zan">';
                    echo '<div class="zan2">';
                        echo '<span>提问时间：'.$list[$i]['time'].'</span>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            $reply = $database->select("answer", "*", array(
                "qid"=>$list[$i]['id']
            ));
            for($j=0; $j<count($reply); $j++){
                echo '<div class="answer">';
                    echo '<img src="images/pic'.rand(1,3).'.png" class="photo" width="40" height="40">';
                    echo '<div class="line1">';
                        if($reply[$j]['name'] == ""){
                           echo '<span>匿名回复:</span>'; 
                       }else{
                        echo '<span>'.$reply[$j]['name'].'回复:</span>';
                       }
                    echo '</div>';
                    echo '<div class="line3">';
                        echo '<span>'.$reply[$j]['content'].'</span>';
                    echo '</div>';
                    echo '<div class="zan">';
                        echo '<div class="zan2">';
                            echo '<span>回复时间：'.$reply[$j]['time'].'</span>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        echo '</div>';
    }
        

?>
    </div>
</div>
</body>
</html>
