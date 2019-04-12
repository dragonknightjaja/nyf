<?php
    header("Content-type: text/html; charset=utf-8");

    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);  
    echo $extension;
    echo $_FILES['file']['size'];
?>