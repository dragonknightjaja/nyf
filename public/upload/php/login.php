<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    mysql_select_db('wissen',$con);

    //获得登陆用户名和密码
    $username = $_POST['username'];
    $password = $_POST['password'];

    //验证用户名密码是否正确
    //php字符串与变量的拼接方式...
    $sql="select * from userinfo where user='$username'";

    $result = mysql_query($sql,$con);
    //如果查询信息不为空
    while( $row = mysql_fetch_array($result) ){
     
        if($row['user'] == trim($username)){

            if($row['password'] == $password){
                echo '登陆成功!';
                session_start();
                $_SESSION['user'] = $username;
                return;
            }else{
                echo '密码错误.请检查你的登陆信息.3秒后返回登陆页面';
                header("refresh:3;url=../html/login.html");
                return;
            }
        }else{
            echo '该用户不存在.请检查你的登陆信息.3秒后返回登陆页面';
            header("refresh:3;url=../html/login.html");
            return;
        }
        
    }
    echo '该用户不存在.请检查你的登陆信息.3秒后返回登陆页面';
    header("refresh:3;url=../html/login.html");
    
    mysql_close($con);
?>