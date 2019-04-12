<?php
/*
    根据任务id 返回任务信息

*/
header("Content-type: text/html; charset=utf-8");
    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) { 
        die('连接失败:'.mysql_error());
    } 
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);

    $taskid = $_GET['taskid'];
    

    $sql="select * from taskinfo where id='$taskid'";
    if($result = mysql_query($sql,$con)){
        $row = mysql_fetch_array($result);
        $username = $row['asker'];
        //获取 发出人的联系电话号码
        $sql1 = "select phone from userinfo where user='$username'";
        $result1 = mysql_query($sql1,$con);
        $row1 = mysql_fetch_array($result1);
        $phone = $row1['phone'];
        $task = array('id'=>$row['Id'],
                        'title'=>urlencode($row['title']),
                        'phone'=>$phone,        
                        'content'=>urlencode($row['content']),   
                        'asker'=>urlencode($username),
                        'helper'=>urlencode($row['helper']),   
                        'reward'=>$row['reward'],   
                    );
    }
  
    $task = json_encode($task);
    echo (urldecode($task));  
    mysql_close($con);
?>