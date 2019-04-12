<?php
    /*
     *主页面 返回余额
     *    
     */
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    $username = $_GET['username'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    
    $sql = "select money from userinfo where user='$username'";
    if( $result = mysql_query($sql,$con) ){
        $row = mysql_fetch_array($result);
        $money = $row['money'];
        echo $money;
    }else{
        echo 0;
    }
    
    mysql_close($con);
    return;
?>