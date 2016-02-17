<?php 
// phpinfo();die;
header("Content-type: text/html; charset=utf-8"); 
$url = 'http://10.10.0.18/proxy.dat';
$ipD = file_get_contents($url);
$arr = explode("\n",$ipD);
$r = array_rand($arr);
echo $ip = $arr[$r];