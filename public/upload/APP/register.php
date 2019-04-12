<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
            
    } 

    //选择数据库
    mysql_select_db('ruangong',$con);
    
    //获得注册的用户名与密码
    $username = $_GET['username'];
    $password = $_GET['password'];

    /*
    用户名存在，返回 -1;
    注册失败，返回 0;
    注册成功，发挥 1;
    */ 
    //用户名或密码为空
    if( ($username == null) || ($password == null) ){
        echo 0;
        return;
    }

    //检测数据库中是否有该用户名
    $sql="select * from userinfo where user='$username';";
    $result = mysql_query($sql,$con);
    while($row = mysql_fetch_array($result) ){

        
        echo -1;
        return;
    }

    //如果该用户名未被创建,就向数据库插入新用户数据
    $sql="insert into userinfo(user,password)
    values
    ('$username','$password');";
    
    if( !mysql_query($sql,$con) ){
        echo 0;
        die('Error:'.mysql_error());
    }
    echo 1;
    //关闭数据库
    mysql_close($con);
?>