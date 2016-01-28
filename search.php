<?php

$ch = curl_init();
//$fp = fopen("example_homepage.txt", "w");


curl_setopt ($ch, CURLOPT_URL, "http://www.baidu.com/"); 
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 


//curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_NOBODY, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;
curl_close($ch);
//fclose($fp);




?>