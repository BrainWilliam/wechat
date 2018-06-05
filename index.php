<?php

/*$echostr = $_GET['echostr'];

echo $echostr;die;*/

include 'function.php';
include 'tmp.php';

diaodiao;

$data = file_get_contents('php://input');

if($data){
	libxml_disable_entity_loader(true);
	$xml_obj = simplexml_load_string($data,'SimpleXMLElement');
	$self = $xml_obj->toUserName.'';
	$her = $xml_obj->FromUserName.'';
	$type = $xml_obj->MsgType.'';
	switch ($type) {
		case 'text':
			$content = $xml_obj->Content.'';
			echo echoText($her,$self,$content);
			break;
		case 'image':
			$media_id = $xml_obj->MediaId.'';
			echo echoImg($her,$self,$media_id);
			break;	
		default:
			echo '';
			break;
	}
}


?>