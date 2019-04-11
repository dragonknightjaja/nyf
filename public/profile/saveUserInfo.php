<?php
/**
 * Created by IntelliJ IDEA.
 * User: rkchen
 * Date: 2018/10/21
 * Time: 16:04
 */
    header("Content-type:text/html;Charset=utf-8");
    class User{
        public $name = "";
        public $passw = "";
        public $sex = "";
        public $area = "";
        public $img="";
    }
    //json头
    header("Content-type: application/json");
    //跨域
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin:*");
    //CORS实现跨域访问
    header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
    header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername,$username,$password);
    mysqli_query($conn,'SET NAMES utf8');
    if(!$conn){
        die("wampserver连接失败：请确定是否连接wampserver".mysqli_connect_error());
    }else if(mysqli_select_db($conn,"firstproject")) //连接firstproject数据库
    {
        $user = new User();
//        $method = $_POST['method'];
        $user->name = $_POST['name'];
//        $user->sex = $_GET['sex'];
//        $user->area = $_GET['location'];

        //$sql = "UPDATE user_info1 SET Name = $user->name, Sex = $user->sex, University = $user->area WHERE id = 1";
        $sql = "UPDATE user_info1 SET Name = $user->name WHERE id = 1";
        mysqli_query($conn,$sql);
        $conn->close();
    }else{echo "数据库连接失败";}
?>