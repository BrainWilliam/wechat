<?php

$redis = new redis();
$redis->connect('192.168.244.128',6379);
$redis->auth('aabbcc');

?>