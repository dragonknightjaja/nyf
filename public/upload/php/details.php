<?php
    header("Content-type: text/html; charset=utf-8");
    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    mysql_select_db('wissen',$con);
    mysql_query("SET NAMES 'UTF8'");

    //获取资源对应的id
    $id = $_GET['id'];
    $sql = "select bt_describe from source where id=$id;";
    
    //返回数据库中对应id的资源的描述细节
    $result = mysql_query($sql,$con);
    if($row = mysql_fetch_array($result)){
        echo $row['bt_describe'];
    }
?>