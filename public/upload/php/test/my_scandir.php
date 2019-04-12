<?php
/*
 *scandir($dir): 浅遍历，非深度遍历
 *readdir(): 返回目录中下一个文件的文件名.
 *
*/ 

function my_scandir($dir){
    
    $files = array();
    if(is_dir($dir)){
        //打开目录
        if($handle = opendir($dir)){
            //while 读取dir目录下的 文件/文件夹
            while(($file = readdir($handle)) != false){
                
                if($file != "." && $file != ".."){
                    if(is_dir($dir."/".$file)){
                        $files[$file] = my_scandir($dir."/".$file);
                    }else{
                        $files[] = $dir."/".$file;
                    }

                }
            }
        }
    }
    closedir($handle);
    return $files;
}

$files = my_scandir("D:/have fun/movie/");
print_r($files);


?>