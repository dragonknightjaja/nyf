<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    $username = $_GET['username'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    
    $sql="select * from taskinfo where asker='$username'";
    $result = mysql_query($sql,$con);
    $tasks = array();
    $temp = array();
    while( $row = mysql_fetch_array($result) ){
         
        $temp = array('id'=>$row['Id'],'title'=>urlencode($row['title']) );
        //$tasks 加入元素 $temp
        array_push($tasks, $temp);
    }

    $tasks = json_encode($tasks);
    echo (urldecode($tasks));  
    mysql_close($con);

?>