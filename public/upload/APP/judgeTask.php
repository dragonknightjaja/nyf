<?php
    /*
     * 对方提交任务后，发出人进行审核，判断任务是否成功. 传入 任务标识ID，如果传来的result=1，则任务成功，将金额转账并删除任务;
     * 否则任务失败 ，修改 taskinfo 表中 status字段 为 0(转为未领取状态),  并将 helper 字段设置为 null.
     *  成功:返回1 ;
     *  任务未被提交:返回-1;
     *  失败:返回0.
     */
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    $taskid = $_GET['taskid'];
    $re = $_GET['result'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    $sql = "select status from taskinfo where Id=$taskid";
    if($result = mysql_query($sql,$con)){
        $row = mysql_fetch_array($result);
        $status = $row['status'];
        if($status!=2){
            echo -1;
            return;
        }
    }


    if($re!=1){
        //判断为任务失败
        header("location: ./giveup.php?taskid=$taskid");
        echo 1;
    }else{
        //判断为任务成功 ：删除任务并转账
        $sql = "select helper,reward from taskinfo where Id='$taskid'";
        if( $result = mysql_query($sql,$con) ){
            $row = mysql_fetch_array($result);
            $reward = $row['reward'];
            $helper = $row['helper'];

            $sql1="delete from taskinfo where Id='$taskid'";
            $sql2="update userinfo set money=money+'$reward' where user='$helper'";
            $result1 = mysql_query($sql1,$con);
            $result2 = mysql_query($sql2,$con);
            if($result1 && $result2){
                echo 1;
            }else echo 0;
        }else{
            echo 0;
        }
    }
    
    mysql_close($con);
    return;
?>