<?php
    /*
     *发起人 放弃任务， 传入 任务标识ID，从 taskinfo 表中删除 对应任务,并将 悬赏金退回给 用户
     * 删除成功:返回1 ;
     *    
     */
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    $taskid = $_GET['taskid'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    
    $sql = "select asker,reward from taskinfo where Id='$taskid'";
    if( $result = mysql_query($sql,$con) ){
        $row = mysql_fetch_array($result);
        $reward = $row['reward'];
        $asker = $row['asker'];

        $sql1="delete from taskinfo where Id='$taskid'";
        $sql2="update userinfo set money=money+'$reward' where user='$asker'";
        $result1 = mysql_query($sql1,$con);
        $result2 = mysql_query($sql2,$con);
        if($result1 && $result2){
            echo 1;
        }
    }else{
        echo 0;
    }
    
    mysql_close($con);
    return;
?>