<?php
    class User{
        public $name = "";
        public $passw = "";
        public  $sex = "";
        public  $area = "";
        public $img="";
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername,$username,$password);

    if(!$conn){
        die("wampserver连接失败：请确定是否连接wampserver".mysqli_connect_error());
    }else if(mysqli_select_db($conn,"firstproject"))                     //连接firstproject数据库
    {
        $sql = "SELECT *FROM user_info1 WHERE id = 1";
        $result = $conn->query($sql);
        $user_info = new User();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $user_info->name = $row["Name"];
                $user_info->passw = $row["Password"];
                $user_info->sex = $row["Sex"];
                $user_info->area = $row["University"];
                $user_info->img=$row["user_IMG"];
                echo json_encode($user_info);
            }
        }else{echo"0结果";}
        $conn->close();
    }else{echo "数据库连接失败";}

    mysqli_free_result($result);//释放内存
    //mysqli_close($conn); //结束连接数据库
?>