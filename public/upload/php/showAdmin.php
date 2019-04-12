<?php
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
    $sql="select * from userinfo limit ".$start.",10";
        
    $result = mysql_query($sql,$con);
    $out = "";

    //如果查询信息不为空,返回10条用户数据(用 '&' 分割用户名与密码)
    while($row = mysql_fetch_array($result)){
        
        $out = $out.$row['user'].'&'.$row['password'].'&';

    }

    //将 $out 中最后一个 '&' 删掉
    $out[strlen($out)-1] = "";
    

    mysql_close($con);
    
    //将 $out 放置在html中处理并显示
?>














<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <title>用户管理系统</title>
    <style type="text/css">
  
      th,td{
        padding:8px;
        text-align: left;
        }
        
      ul{
        position: absolute;
        left:40%
      }
		</style>
  </head>
  <body>
    <h1>用户管理系统</h1>
      <table class="table table-striped" id="mytable">
          <tr>
            <th>id</th>
            <th>username</th>
            <th>password</th>
            <th>操作</th>
          </tr>
        </table>

        <!--分页-->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li>
              <a href="../php/showAdmin.php?page=1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li >
            
            <li class="page"><a href="../php/showAdmin.php?page=1">1</a></li>
            
            <li>
              <a href="../php/showAdmin.php?page=<?php echo $pageCount;?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
        
      </body>
      <script>

            $(document).ready(function(){
              addData();
              
            }); 
    
  
            
    var id = 1;
    /*
     *将返回的数据切割并加到表格中
     */
    function addData(){

        //根据需要 动态 生成对应多少个 分页标签
        var pagenum = <?php echo $pageCount;?>;
        if(pagenum>1){

            
            //将 a 标签封装到以获得的 li 标签内
            for(var i = pagenum;i>1;i--){
                
                //用 jquery 的 after 方法添加元素
                $('.page').after("<li><a href='../php/showAdmin.php?page=" + i + "'>" + i + "</a></li>");

            }
        }
        





        //用 php 将用户信息 $out 接收
        //默认用"&"分隔数据,并将用户名与密码分开
        var datas = "<?php echo $out;?>";
        datas = datas.trim().split("&");
        var users = new Array();
        var passwords = new Array();
        for(var i=0,j=0;i<datas.length; i=i+2 ){
            
            users[j] = datas[i];
            passwords[j] = datas[i+1];
            j++;
    
        }
          
          var otable = document.getElementById("mytable");
          //往 table 中添加数据
          for(var i = 0 ; i<users.length ; i++){
            
            //将 td 加到 tr 中
            var otr = document.createElement("tr");
            var otd1 = document.createElement("td");
            var otd2 = document.createElement("td");
            var otd3 = document.createElement("td");
            var otd4 = document.createElement("td");
            
            otd1.innerHTML = id;
            otd2.innerHTML = users[i];
            otd3.innerHTML = passwords[i];
            otd4.innerHTML = "<a onclick=\"deleteUser(this)\" href=\"javascript:void(0)\">删除用户</a>";
            
            otr.appendChild(otd1);
            otr.appendChild(otd2);
            otr.appendChild(otd3);
            otr.appendChild(otd4);
            
            otable.appendChild(otr);
            id++;
          }

        }
        
      
      
    
    /*
     *删除对应行并在数据库中删除对应的用户所有信息
     */
    function deleteUser(node){
      
      var username = node.parentNode.parentNode.childNodes[1].innerHTML;


      //删除数据库用户信息
      $.ajax({
        url:"../php/deleteUser.php",
	      type:"get",
	      data:"username=" + username,
	      success:function (data) {
          
          //数据库操作成功返回true
          if(data){

            //删除对应行
            node.parentNode.parentNode.remove();
          
          }
	      }
      });
    }
  </script>
</html>