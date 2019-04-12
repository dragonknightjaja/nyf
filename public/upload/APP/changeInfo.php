<?php
    /*
     *修改个人资料
     * 成功:返回1 ;
     * 姓名重复:返回2;
     * 电话号码重复：返回-1；
     * 失败：返回0；
     */
    header("Content-type: text/html; charset=utf-8");

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
        
        die('连接失败:'.mysql_error());
        
    } 
    $old_name = $_GET['oldname'];
    $username = $_GET['username'];
    $phone = $_GET['phone'];

    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);
    
    $sql2 = "select id from userinfo where user='$username'";
    $sql1 = "select id from userinfo where phone=$phone";
    $sql3 = "";
    $sql4 = "";
    $sql5 = "";
    $sql6 = "";
    if($phone!=null){
        if($result = mysql_query($sql1,$con)){
            $row = mysql_fetch_array($result);
            if($row['id']!=null){
                //电话已被注册
                echo -1;
                return;
            }else{
                $sql3 = "update userinfo set phone=$phone where user='$old_name'"; 
            }   
        }
    }

    if($username!=null){
        if($result = mysql_query($sql2,$con)){
            $row = mysql_fetch_array($result);
            if($row['id']!=null){
                //用户名已被注册
                echo 2;
                return;
            }else{
                $sql4 = "update userinfo set user='$username' where user='$old_name'"; 
                $sql5 = "update taskinfo set asker='$username' where asker='$old_name'";
                $sql6 = "update taskinfo set helper='$username' where helper='$old_name'";
            }   
        }
    }

    //执行修改
    if(($sql3!="") || ($sql4!="") ){
        mysql_query($sql3,$con);
        mysql_query($sql5,$con);
        mysql_query($sql4,$con);
        mysql_query($sql6,$con);
        echo 1;
    }else echo 0;

    
    mysql_close($con);
    return;
?>