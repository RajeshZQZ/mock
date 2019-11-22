<?php

class common_curl_help{

	//连接超时
	private static $connect_timeout = 20;
	//错误编码
	public static $err_code = 0;
	//错误信息,无错误为''
	public static $err_msg = '';
	public static $http_info;
	public static $http_code;
	public static $http_header;
	private static $begin_time = 0;

	/**
	 * 初始化信息
	 */
	private static function init()
	{
	    self::$err_code = 0;
	    self::$err_msg = '';
	    self::$http_code = 200;
	    self::$http_header = array();
	    self::$http_info = array();
	}

	//get调用接口：
	public static function curlGet($url ,$param = [] ,$timeout = 2 , $json = true)
	{
	    echo "03:call_curlGet========<br>";
	    if(!empty($url)){
            //先生成接口http——url：
            $url = self::generalHttpUrl($url,$param);
        echo "05：call_curlget========<br>".$url."<br>";
            //初始化
            $ch = curl_init();
            // 请求头，可以传数组
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // 执行后不直接打印出来
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 不从证书中检查SSL加密算法是否存在
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            $output = curl_exec($ch); //执行并获取HTML文档内容
            curl_close($ch); //释放curl句柄
            return $json ? @json_decode($output , true) : $output;
        }else{
	        die("Url地址为空~！");
        }

	}

    //生成http请求地址
    public static function generalHttpUrl($base_url,$params){
	    echo "04:call_CurlGet_general<br>";
        $url_array = parse_url($base_url);
        if ($url_array){
            if(empty($params)){
                return $base_url;
            }
            $params_string = http_build_query($params);
            if (!empty($url_array['query'])){
                $return_url = $base_url . '&' . $params_string;
            }else {
                $return_url = $base_url.'?'.$params_string;
            }
            return $return_url;
        }else {
            die("url 不合法");
        }
    }

	//post调用第三方接口:
    public static function cURLHTTPPost($url, $post_data, $timeout = 3, $host = '', $header_append = array(), $failOnError = true)
    {
        if (is_array($post_data)) {//$post_data为数组时，即上传文件时
            $data_len = count($post_data);
            $header = array();
        } else {
            $data_len = strlen($post_data);
            $header = array('Content-transfer-encoding: text', 'Content-Length: ' . $data_len);
        }

        if (!empty($header_append)) {
            foreach ($header_append as $v) {
                $header[] = $v;
            }
        }
        if (!empty($host)) {
            $header[] = 'Host: ' . $host;
        }

        $curl_handle = curl_init();

        // 连接超时
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, $timeout);
        // 执行超时
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 300);
        // HTTP返回错误时, 函数直接返回错误
        curl_setopt($curl_handle, CURLOPT_FAILONERROR, $failOnError);
        // 允许重定向
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
        // 允许重定向的最大次数
        curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 2);
        // ssl验证host
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, FALSE);
        // 返回为字符串
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        // 设置HTTP头
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
        // 指定请求地址
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        //设置为post方式
        curl_setopt($curl_handle, CURLOPT_POST, TRUE);
        //post 参数
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
        // 执行请求
        $response = curl_exec($curl_handle);
        if ($response === false) {
            self::$err_code = 10616;
            self::$err_msg = 'cURL errno: ' . curl_errno($curl_handle) . '; error: ' . curl_error($curl_handle);
            // 关闭连接
            curl_close($curl_handle);

            return false;
        }
        // 关闭连接
        curl_close($curl_handle);

        return $response;
    }

    public static function curl_get_302($url) {
        $ch = curl_init();
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch,  CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        $data = curl_exec($ch);
        $Headers =  curl_getinfo($ch);
        curl_close($ch);
        if ($data != $Headers)
            return  $Headers["url"];
        else
            return false;
    }

    public static function printNx($arr, $index, $default = ''){

        if (count($index) == 2) {
            return !empty($arr[$index[0]][$index[1]]) ? $arr[$index[0]][$index[1]] : $default;
        } else {
            return !empty($arr[$index[0]]) ? $arr[$index[0]] : $default;
        }
    }

}

?>

