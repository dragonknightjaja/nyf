<?php
header("Content-type: text/html; charset=utf-8");
    /* page : 表示正在浏览第几页，由用户决定
     * pageSize : 每页显示几条记录，由服务器决定
     * pageCount : 表示共有多少页
     * rowCount : 数据库中共有多少条记录
     */

    //检查page是否为空,为空就默认 page=1 即跳到第一页
    if($_GET['page']!=null){
        $page = $_GET['page'];
    }else{
        $page=1;
    }
    $pageSize = 8;
    $pageCount = null;
    $rowCount = null;

    //连接数据库
    $con = mysql_connect("localhost","root","");
    if (! $con) {
    
        die('连接失败:'.mysql_error());
    
    }
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db('wissen',$con);
    
    //一共有多少条数据并计算有多少页
    $sql="select null from source";
    $result = mysql_query($sql,$con);
    $rowCount = mysql_num_rows($result);
    $pageCount = ceil($rowCount/$pageSize);

    //计算从第几行数据开始提取，并提取8行数据
    $start = ($page-1)*$pageSize;
    $sql="select * from source limit ".$start.",$pageSize";
        
    $result = mysql_query($sql,$con);


?>







<!DOCTYPE HTML >
<html>
	<head>
        <meta charset="utf-8"/>
        <script src="../jquery/jquery-3.3.1.min.js"></script>    
        <script src="../js/bootstrap.min.js"></script>    
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/download.css"/>
        <title>资源下载页面</title>
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Wissen</a>
              </div>
          
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="#">首页</a></li>
                  <li><a href="#">资源区</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                  <li><a id="user" href="#">欢迎您</a></li>
                  <li><a href="#">注销</a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>

          <h1><b>资源区</b></h1>
          <div class="container">

            <div class="filter">
                <span class="label label-default">电影</span>
                <span class="label label-primary">电视剧</span>
                <span class="label label-success">学习资料</span>
                <span class="label label-info">动漫</span>
                <span class="label label-warning">游戏</span>
                <span class="label label-danger">其他</span>
                
                <span>
                  <input type="text" name="search" placeholder="搜索关键字" style="width: 20%;margin-left:15%;"/>
                  <input type="button" value="搜索" />
                </span>
            </div>

            <div>
              <table class="table" id="sourceTable">
                
                  
                    <?php
                      while($row = mysql_fetch_array($result)){

                        $id = $row['id'];
                        $id2 = $row['id'].'.zip';
                        $user = $row['user'];
                        $bt_name = $row['bt_name'];
                        $type = $row['type'];
                        echo "<tr><td><div class='source'>
                        <p><b><a href='../source/$id2'>$bt_name</a></b></p>
                        <span>上传者：$user</span>
                        &nbsp&nbsp&nbsp
                        <span>资源类型: $type</span>
                        &nbsp&nbsp&nbsp&nbsp
                        <a href='javascript:void(0)' class='describe' onclick='showDetail($id,this)'>上传者介绍</a>
                        </div></td><tr/>";  

                      }
                    ?>
                  
                
              </table>
            </div>

        <!--分页-->
            <nav aria-label="Page navigation" >
             <ul class="pagination" >
               <li>
                  <a href="./download.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li >
            
                <li class="page"><a href="./download.php?page=1">1</a></li>
            
                <li>
                  <a href="./download.php?page=<?php echo $pageCount;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                
                <span class="fenye"></span>
                
              </ul>
              
            </nav>
          </div>

      
    </body>
    <script>

      //该方法可以获得给定参数名的cookie
      function getCookie(c_name)
      {
        if (document.cookie.length>0)
        {
          c_start=document.cookie.indexOf(c_name + "=")
          if (c_start!=-1)
          { 
            c_start=c_start + c_name.length+1 
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
              return unescape(document.cookie.substring(c_start,c_end))
          } 
        }
        return ""
      }        

        //显示对应资源描述细节
      var detail=null;
      function showDetail(id,node){


        $.ajax({
        url:"../php/details.php",
	      type:"get",
	      data:"id=" + id,
	      success:function (data) {
          //data:返回的资源信息，node:点击的a标签
          /*
          * 将node对象转成 jquery 对象
          */ 
          $(node).parent().parent().children('.detail').html(data).slideToggle();
	      }
      });


      }
      var pagenum = null;
      function addPage(){
      //根据需要 动态 生成对应多少个 分页标签
        pagenum = <?php echo $pageCount;?>;
        if(pagenum>1){
          //将 a 标签封装到以获得的 li 标签内
          for(var i = pagenum;i>1;i--){
            //用 jquery 的 after 方法添加元素
            $('.page').after("<li><a href='./download.php?page=" + i + "'>" + i + "</a></li>");
          }
        }
      }

        $(document).ready(function(){

            addPage();
            //正在浏览第2/123123页
            $('span.fenye').html('正在浏览第'+<?php echo $page; ?>+'/'+pagenum+'页');

            if(getCookie("user") != ""){
                $('#user').append(',' + getCookie("user"));
            }
            
            $('td').append('<div class="detail"></div>');

        });
        
        
     
      



    </script>
</html>