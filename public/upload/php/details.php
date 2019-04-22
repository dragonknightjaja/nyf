<?php
    header("Content-type: text/html; charset=utf-8");
    //连接数据库
    $conn = new mysqli("localhost","root","545411","nyf");
    if (! $conn) {
        die('连接失败:'.mysqli_connect_error());
    } 

    //获取资源对应的id
    $id = $_GET['id'];
    $sql = "select bt_describe from source where id=$id;";
    
    //返回数据库中对应id的资源的描述细节
    $result = mysqli_query($conn,$sql);
    if($row = mysqli_fetch_assoc($result)){
        echo $row['bt_describe'];
    }
?>
