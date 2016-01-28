<?php

// 获取session

$url = "http://www.google.com/";

$url = "http://www.baidu.com/";
$cookie_jar = dirname(__FILE__)."/pic.cookie";

$proxy = "10.128.22.32";
$proxyport = "443";


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1); 
        // 伪装浏览器
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        // 保存到字符串而不是输出
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//curl_setopt($ch,CURLOPT_PROXY,$proxy);
//curl_setopt($ch,CURLOPT_PROXYPORT,$proxyport);


curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);

$content = curl_exec($ch);
echo $content;
curl_close($ch);

?>