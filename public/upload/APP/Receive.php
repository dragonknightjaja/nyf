<?php
    /*
     *接任务功能：改变任务表 taskinfo 的 helper 与 status 字段
     *  成功:返回1，并修改字段;
     *  任务已被领取:返回2;
     *  失败:返回0;
     *  任务的 asker 与 helper 为同一个人 : 返回-1.
     */
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    $username = $_GET['username'];
    $taskid = $_GET['taskid'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    
    $sql="select * from taskinfo where Id='$taskid'";
    if( $result = mysql_query($sql,$con) ){
        $row = mysql_fetch_array($result);
        if( $row['status']!=0 ){
            //任务已被领取
            echo 2;
            return;
        }else if($row['asker']==$username){
            //asker 与 helper 为同一个人
            echo -1;
            return;
        }   
        //任务可以被领取
        $sql = "update taskinfo set status=1,helper='$username' where id='$taskid'";
        if($result=mysql_query($sql,$con)){
            //领取成功
            echo 1;
        }
    }
    

    mysql_close($con);

?>