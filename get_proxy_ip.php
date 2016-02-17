<?php 
// phpinfo();die;
header("Content-type: text/html; charset=utf-8"); 
/***
  *  采集xxhh.com
  *
  * */
ignore_user_abort(1);
include_once('./config.php');
include ('./snoopy.class.php');
set_time_limit(0);
include 'simple_html_dom.php';
// 新建一个Dom实例
$html = new simple_html_dom();


$snoopy = new Snoopy();


// ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
ini_set('user_agent','Sosospider+(+http://help.soso.com/webspider.htm)');





for($i=1;$i<7;$i++){
	// $i = 0;
	$contentUrl = "http://www.xicidaili.com/nn/".$i;
	$html =file_get_html($contentUrl);
	//获取所有的img元素 
	foreach($html->find('#ip_list tr') as $element) {
		// echo   strip_tags($element->find('td',2)).':';
		
		$s =  $element->find('.bar',0)->title."\n";

		$s = floatval($s)."\n";
		if($s<= 4.5 && $s>0){
			$str .= strip_tags($element->find('td',2)).':'.strip_tags($element->find('td',3)) . "\n";
		}
		
	}
	// echo strlen($str);
	
	
}
// echo strlen($str);
if(strlen($str)>5000){
	file_put_contents('/home/wwwroot/proxy.dat', trim($str));
} else {
	file_put_contents('/home/wwwroot/proxy-over.dat', 'die'.date('Y-m-d H:i:s')."\n");
}
