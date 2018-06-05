<?php

/**
	 * GET请求处理
	 * @param  string  $url   请求的URL，不包含协议头
	 * @param  boolean $https 请求的协议，默认http。true使用https
	 * @return string         返回URL请求结果
	 */
	function httpGetRequest($url, $https = false){
		if( !is_string($url) ){
			return 'URL is not string!';
		}

		$ch = curl_init();			//创建一个新cURL资源

		if($https === true) {
			$url = 'https://' . $url;
			// 设置证书不验证
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		} else {
			$url = 'http://' . $url;
		}

		//设置URL和相应的选项
		curl_setopt($ch, CURLOPT_URL, $url);				//设置URL
		curl_setopt($ch, CURLOPT_HEADER, 0);				//设置：true时会将头文件的信息作为数据流输出；false反之
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);				//设置：超时时间，单位（秒）
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		//返回值：true字符串返回; false（默认）直接输出

		$ret = curl_exec($ch);								//抓取URL并把它传递给浏览器

		//检查是否有错误发生：线上环境，要关闭错误直接输出，应该记住到系统文件
		if(curl_errno($ch)){
		    echo 'Curl error: ' . curl_error($ch);
		}

		curl_close($ch);									//关闭cURL资源，并且释放系统资源
		return $ret;
	}

	/**
	 * POST请求处理
	 * @param  string  $url    请求的URL，不包含协议头
	 * @param  [type]  $data   POST数据
	 * @param  string  $d_type POST数据发送方式
	 * @param  boolean $https  请求的协议，默认http。true使用https
	 * @return string          返回URL请求结果
	 */
	function httpPostRequest($url, $data, $d_type = 'json', $https = false, $video = null){
		if( !is_string($url) ){
			return 'URL is not string!';
		}

		if($d_type === 'file') {
			// 版本判断：当前版本大于5.5.0时
			if( version_compare( PHP_VERSION, '5.5.0', '>') ){
				$file = new CURLFile($data);	//该类5.5.0版本以上可使用
			} else {	
				$file = '@' . $data;
			}
			// $post_data = array('media' => $file);
			$post_data['media'] = $file;

			if($video !== null) {
				// $post_data = array('media' => $file, 'description' => $video);
				$post_data['description'] = $video;
			}
		} else {
			$post_data = $data;
		}

		$ch = curl_init();			//创建一个新cURL资源
		
		if($d_type === 'json') {
			//设置header信息
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
			    'Content-Length: ' . strlen($post_data))
			);	
		}

		if($https === true) {
			$url = 'https://' . $url;

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		} else {
			$url = 'http://' . $url;
		}

		//设置URL和相应的选项
		curl_setopt($ch, CURLOPT_URL, $url);				//设置URL
		curl_setopt($ch, CURLOPT_HEADER, 0);				//设置：true时会将头文件的信息作为数据流输出；false反之
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);				//设置：超时时间，单位（秒）
		curl_setopt($ch, CURLOPT_POST, 1);					//设置：post请求方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);	//设置：请求数据
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		//返回值：true字符串返回; false（默认）直接输出

		$ret = curl_exec($ch);								//抓取URL并把它传递给浏览器

		//检查是否有错误发生：线上环境，要关闭错误直接输出，应该记住到系统文件
		if(curl_errno($ch)){
		    echo 'Curl error: ' . curl_error($ch);
		}

		curl_close($ch);									//关闭cURL资源，并且释放系统资源
		return $ret;
	}

	/**
	 * 获取当前目录下jpg图片文件名称，不包含文件后缀
	 * @param  string $dir 图片目录地址
	 * @return array       图片名称数组
	 */
	function getDirInImageName($dir){
		if(!is_dir($dir)) return false;				//判断参数是否为目录

		$files = array();							//初始化结果集数组

		if($dh = opendir($dir)){					//打开目录，获得资源句柄
			//循环目录里面的文件
			while( false !== ($file = readdir($dh))){
				if($file === '.' || $file === '..')  continue;

				$last = strstr($file, '.');			//获取文件名的后缀：包含[.]
				//判断是否是需要的图片
				if(in_array($last, array('.jpg'))){
					//获取文件名，不包含后缀。保存进数组
					$files[] = strstr($file, '.', true);
				}
				//---------------递归目录的写法【面试会问】-----------
				// $path = $dir . '/' . $file;
				// if(is_dir($path)){
				// 	$files[] = getDirInImageName($path);
				// } else {
				// 	$files[] = $path;
				// }
			}
			closedir($dh);									//关闭目录资源
		}
		return $files;
	}