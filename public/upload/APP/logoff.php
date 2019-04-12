<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    mysql_select_db('ruangong',$con);
    //获得要注销的用户名
    $username = $_GET['username'];
    $sql="update userinfo set loginstatus=0 where user='$username'";

    mysql_query($sql,$con);
    
    mysql_close($con);

    ?>