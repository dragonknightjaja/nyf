<?php
    /*
     *领取人 放弃任务， 传入 任务标识ID，修改 taskinfo 表中 status字段 为 0(表示未领取状态),  并将 helper 字段设置为 null
     *  成功:返回1 ;
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
    
    $sql="update taskinfo set helper=NULL,status=0 where Id='$taskid'";
    $result = mysql_query($sql,$con);
    if($result){
        echo 1;
    }else echo 0;
    
    
    mysql_close($con);
    return;
?>