<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
            
    } 

    //选择数据库
    mysql_select_db('wissen',$con);
    
    //获得注册的用户名与密码
    $username = $_POST['username'];
    $password = $_POST['password'];

    //检测数据库中是否有该用户名
    $sql="select * from userinfo where user='$username';";
    $result = mysql_query($sql,$con);
    while($row = mysql_fetch_array($result) ){

        header("refresh:3;url=../html/register.html");
        echo '该用户名已经被注册...3秒后返回注册页面';
        return;
    }
  /*  if( mysql_query($sql,$con) ){
        header("refresh:3;url=../html/register.html");
        echo '该用户名已经被注册...3秒后返回注册页面';
        return;
    }*/

    //如果该用户名未被创建,就向数据库插入新用户数据
    $sql="insert into userinfo(user,password)
    values
    ('$username','$password');";
    
    if( !mysql_query($sql,$con) ){

        die('Error:'.mysqli_error());
    }
    echo '注册成功！3秒后跳转登陆页面';
    header("refresh:3;url=../html/login.html");
    //关闭数据库
    mysql_close($con);
?>