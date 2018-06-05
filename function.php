<?php

	function echoText($her,$self,$content)
	{
	   global $xml_tmp;
	   $time = time();
	   if($content == '图片'){
	   	 $media_id = "JljSGVgrF5mWhtp0Uet3_uoR12fnK-TrAa98MZy5FIlkEZtqNJbLOo2K7Yw_c9YF";
	   	  return echoImg($her,$self,$media_id);
	   }
	   return  sprintf($xml_tmp['text'],$her,$self,$time,$content);
	}
	function echoImg($her,$self,$media_id){
	   global $xml_tmp;
	   $time = time();
	   return  sprintf($xml_tmp['img'],$her,$self,$time,$media_id);
	}
	