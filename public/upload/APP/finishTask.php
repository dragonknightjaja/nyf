<?php
    /*
     *接收人 完成任务， 传入 任务标识ID，将 taskinfo 的 status字段 修改为 2, 提醒任务发出人 进行结果的审核
     *  成功:返回1 ;
     *  提示“请勿重复操作” :返回-1;
     *  失败:返回0.
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
    $sql = "select status from taskinfo where Id=$taskid";
    if( $result = mysql_query($sql,$con) ){
        $row = mysql_fetch_array($result);
        $status = $row['status'];
        if($status==0){
            echo 0;
            return;
        }else if($status==2){
            echo -1;
            return;
        }
    }else{
        echo 0;
        return;
    }
    
    //当且仅当status=1时, 更新 status字段为2
    $sql = "update taskinfo set status=2 where Id='$taskid'";
    if( $result = mysql_query($sql,$con) ){
        echo 1;
    }else echo 0;
    
    mysql_close($con);
    return;
?>