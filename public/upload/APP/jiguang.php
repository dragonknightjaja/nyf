<?php
// 这只是使用样例,不应该直接用于实际生产环境中 !!

require 'config.php';

// 简单推送示例
// 这只是使用样例,不应该直接用于实际生产环境中 !!

$push_payload = $client->push()
    ->setPlatform('all')
    ->addAllAudience()
    ->setNotificationAlert('Hi, JPush');
try {
    $response = $push_payload->send();
    print_r($response);
} catch (Exception $e){
    print $e;
}
?>