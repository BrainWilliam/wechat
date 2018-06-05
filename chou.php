<?php

include 'curl.php';
include 'redis.php';

$dir = 'image';
define('IMAGE','wx:image');
$img_name_arr = getDirInImageName($dir);

$img_name_json = json_encode($img_name_arr);

var_dump($img_name_json);

$redis->set(IMAGE,$img_name_json);
