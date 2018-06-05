<?php
header('content-type:text/html;charset=utf-8');

$xml_tmp = [
    'text' => '<xml>
			 <ToUserName><![CDATA[%s]]></ToUserName>
			 <FromUserName><![CDATA[%s]]></FromUserName>
			 <CreateTime>%d</CreateTime>
			 <MsgType><![CDATA[text]]></MsgType>
			 <Content><![CDATA[%s]]></Content>
			 </xml>',
    'img'  => '<xml>
			 <ToUserName><![CDATA[%s]]></ToUserName>
			 <FromUserName><![CDATA[%s]]></FromUserName>
			 <CreateTime>%d</CreateTime>
			 <MsgType><![CDATA[image]]></MsgType>
			 <Image>
			 <MediaId><![CDATA[%s]]></MediaId>
			 </Image>
			 </xml>',
];
