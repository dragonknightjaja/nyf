<?php
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
            
    } 
    //选择数据库
    mysql_select_db('wissen',$con);

    //获取前端发送的要删除的用户名
    $username = $_GET['username'];

    //删除对应用户的所有资料
    $sql="delete from userinfo where user='$username'";
    if(mysql_query($sql,$con)){
        echo true;
    }else{
        echo false;
    }

    mysql_close($con);
?>