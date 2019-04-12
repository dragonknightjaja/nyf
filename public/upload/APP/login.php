<?php
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 

    mysql_select_db('ruangong',$con);

    //获得登陆用户名和密码
    $username = $_GET['username'];
    $password = $_GET['password'];

    //验证用户名密码是否正确
    //php字符串与变量的拼接方式...
    $sql="select * from userinfo where user='$username'";

    $result = mysql_query($sql,$con);
    //如果查询信息不为空
    while( $row = mysql_fetch_array($result) ){
     
        if($row['user'] == trim($username)){

            if($row['password'] == $password){
                //登陆状态改为1
                $sql="update userinfo set loginstatus=1 where user='$username'";
                if($result = mysql_query($sql,$con)){echo 1; return;}
                else{
                    echo 0;
                    return;
                }
                
            }else{
                echo 0;
                return;
            }
        }else{
            echo 0;
            return;
        }
        
    }
    echo 0;
    
    mysql_close($con);
?>