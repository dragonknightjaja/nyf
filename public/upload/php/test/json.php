<?php
    header("Content-type: text/html; charset=utf-8");
    $cars = array
  (   "status"=>1,
      "result"=>array(
            array("branch"=>"BMW","price"=>150,"color"=>"black"),
            array("branch"=>"Audi","price"=>150,"color"=>"green"),
            array("branch"=>"BMW","price"=>200,"color"=>"blue"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
            array("branch"=>"BMW","price"=>350,"color"=>"red"),
        )
  );
  
    echo (json_encode($cars));  


?>