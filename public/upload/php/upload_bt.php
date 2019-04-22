<?php
    header("Content-type: text/html; charset=utf-8");

    //用户是否登陆
    // session_start();
    // if(!isset($_SESSION['user'])){
    //     echo '请先登陆....';
    //     header("refresh:3;url=../html/login.html");
    //     return;
    // }
    $conn = new mysqli("localhost", "root", "545411", "nyf");
    if (! $conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    /**
     * 获得登陆的用户名
     */
    $sql = "select id from sessions order by last_activity desc";//降序
    $result = mysqli_query($conn, $sql);
    if( !$result ){
        die("Connection failed: " . mysqli_connect_error());
    }
    $row =  mysqli_fetch_assoc($result);
    $user = $row['id'];//最后登陆的id
    if($user == null || $user == ""){//未登陆
        echo '请先登陆....';
        //header("refresh:3;url=../html/login.html");
        return;
    }

    //允许上传的文件后缀:zip ,并且限制文件大小为 : 10M
    $pattern1 = '/.zip/';

    $str = $_FILES['file']['name'];
    if( preg_match($pattern1,$str) && ($_FILES['file']['size']<10485760) ){

        //获得文件名后缀 $extension
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);  

        if($_FILES['file']['error'] > 0){
            echo '错误：'.$_FILES['file']['error'].'</br>';
        }else{

            /* 上传正确
            * 往 torrent 表中插入数据
            */
            //$con = mysql_connect("localhost","root","");


            //mysql_select_db('wissen',$con);
            //mysql_query('SET NAMES UTF8'); //避免数据库返回中文时出现乱码
            //种子信息和用户名
            //$user = $_SESSION['user'];
            $bt_name = $_POST['name'];
            $bt_describe = $_POST['des'];
            $type = $_POST['type'];


            //将种子信息和上传用户名保存到数据库
            $sql="insert into source(user,bt_name,bt_describe,type)
                values
                ('$user' , '$bt_name' , '$bt_describe' , '$type');";
            
            if( !mysqli_query($conn, $sql) ){
                die("Connection failed: " . mysqli_connect_error());
            }

            //根据数据 id 储存在服务器中，避免文件名重复
            $sql= "select id from source where bt_name='$bt_name';";
            $result = mysqli_query($conn, $sql);
            while($row =  mysqli_fetch_assoc($result) ){
                
                $store_id = $row['id'];
                move_uploaded_file($_FILES['file']['tmp_name'] , '../source/' . $store_id .'.' . $extension);
                echo "文件存储在: " . "../source/" . $store_id . "." . $extension;
            }

            
            //关闭数据库
            mysqli_close($conn);
        }

    }else{
        echo '只允许上传zip文件，并且文件不得大于10M！三秒后返回上传页面~';
        header("refresh:3;url=../html/uploadPage.html");
    } 
    
   
?>
