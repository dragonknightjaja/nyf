<?php
/*
    添加任务成功：返回1
    添加任务失败或信息填写不完整：返回0
    账户余额不足：返回-1
    回滚：返回2

*/
header("Content-type: text/html; charset=utf-8");
    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) { 
        die('连接失败:'.mysql_error());
    } 
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('ruangong',$con);

    $title = $_GET['title'];
    $cotent = $_GET['content'];
    $reward = $_GET['reward'];
    $username = $_GET['username'];
    if($reward == null){$reward = 0;}

    $sql="select * from userinfo where user='$username'";
    if($result = mysql_query($sql,$con)){
        //登陆状态 为1
        $row = mysql_fetch_array($result);
        if($row['loginstatus']==1){
            $money = $row['money'];
        }else{
            //未登录
            echo 0;
            return;
        }
    }else{
        //用户不存在
        echo 0;
        return;
    }
    //session_start();
    //$username = $_SESSION['user'];
    //$money = $_SESSION['money'];
    if( ($title == null) || ($content == null) ||($username == null)){    
        echo 0;
        return;
    }else if($reward>$money){
        echo -1;
        return;
    }

    $money = $money - $reward;
    mysql_query("START TRANSACTION");               //开启一个事务
    mysql_query("SET AUTOCOMMIT=0");                //设置mysql不自动提交
    $sql1 = "update userinfo set money='$money' where user='$username'"; //发出人账号扣除10金币
    $sql2 = "insert into taskinfo(title,content,reward,asker)   
    values('$title','$content','$reward','$username')";     
    $res1 = mysql_query($sql1,$con);
    $res2 = mysql_query($sql2,$con);
    if($res1 && $res2)
    {   
        mysql_query("COMMIT");
        echo 1;
    }else{
        echo 2;
        mysql_query("ROLLBACK");
        die('Error:'.mysql_error());
    }
    
    mysql_close($con);
?>