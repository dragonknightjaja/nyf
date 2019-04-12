<?php
    //打开 admin.html 触发该服务器

    
    /* page : 表示正在浏览第几页，由用户决定
     * pageSize : 每页显示几条记录，由服务器决定
     * pageCount : 表示共有多少页
     * rowCount : 数据库中共有多少条记录
     */
    //检查page是否为空
    if($_GET['page']!=null){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    
    $pageSize = 10;
    $pageCount = null;
    $rowCount = null;

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
    
        die('连接失败:'.mysql_error());
    
    }
    mysql_select_db('wissen',$con);
    
    //一共有多少条数据并计算有多少页
    $sql="select * from userinfo";
    $result = mysql_query($sql,$con);
    $rowCount = mysql_num_rows($result);
    $pageCount = ceil($rowCount/$pageSize);

    //计算从第几行数据开始提取，并提取10行数据
    $start = ($page-1)*$pageSize;
    $sql="select * from userinfo limit ".$start.",10;";
        
    $result = mysql_query($sql,$con);
    $out = "";

    //如果查询信息不为空,返回10条用户数据(用 '&' 分割用户名与密码)
    while($row = mysql_fetch_array($result)){
        
        $out = $out.$row['user'].'&'.$row['password'].'&';

    }

    //将 $out 中最后一个 '&' 删掉
    $out[strlen($out)-1] = "";
    echo $out;

    mysql_close($con);

?>