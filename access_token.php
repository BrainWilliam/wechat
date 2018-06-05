<?php
include 'curl.php';
/*$appid = 'wx34ef3f1782342e42';
$appsecret = 'cefb146f72dd85aa0e5180bf53bdf4f8';
$url = "api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$res = httpGetRequest($url,true);
var_dump($res);*/

/*string(194) "{"access_token":"10_SJAZROolI6Pc0PYTq3dtl-iUvh3zIIqtJlRw9tMJMaww42V8QSPmhn3tVduFv5aH-IXzp-8I0fc650HQQiPAKVpReMEQtL5mq0tJUVQXnL-UKJNKnnhZgd8bc5723UqdOYKGkL06kXHe-MZeDJXaAEAOUI","expires_in":7200}"

10_SJAZROolI6Pc0PYTq3dtl-iUvh3zIIqtJlRw9tMJMaww42V8QSPmhn3tVduFv5aH-IXzp-8I0fc650HQQiPAKVpReMEQtL5mq0tJUVQXnL-UKJNKnnhZgd8bc5723UqdOYKGkL06kXHe-MZeDJXaAEAOUI

*/
$access_token = "10_SJAZROolI6Pc0PYTq3dtl-iUvh3zIIqtJlRw9tMJMaww42V8QSPmhn3tVduFv5aH-IXzp-8I0fc650HQQiPAKVpReMEQtL5mq0tJUVQXnL-UKJNKnnhZgd8bc5723UqdOYKGkL06kXHe-MZeDJXaAEAOUI";
$type = "image";
$url = "api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=$type";
$data = 'image/001.jpg';
$res = httpPostRequest($url, $data, 'file', true);
//JljSGVgrF5mWhtp0Uet3_uoR12fnK-TrAa98MZy5FIlkEZtqNJbLOo2K7Yw_c9YF
var_dump($res);