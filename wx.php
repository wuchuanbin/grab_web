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

// $type = 18;

// $sourceURL = "http://www.3jy.com/tag/12/2.html";
// $sourceURL = "http://weixin.sogou.com/pcindex/pc/pc_5/pc_5.html";
$i = 0;
$contentUrl = "http://www.xicidaili.com/nn/".$i;
// $sourceList = 'http://weixin.sogou.com/pcindex/pc/pc_'.$type.'/';
// $contentUrl = "http://weixin.sogou.com/gzh?openid=oIWsFt9eVugAjPSViucxPUMqZRTc&ext=lA5I5al3X8BYrtW1H7KizeSlxz3j7jXNbhYq5hHUiK3kRa_38c2fM0YicIPGGskc";

 //$snoopy->fetchlinks($contentUrl);
// $snoopy->fetchtext($sourceURL);
//$snoopy->fetch($contentUrl);
//$return = $snoopy->results;
// ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
ini_set('user_agent','Sosospider+(+http://help.soso.com/webspider.htm)');





// print_r($context);die;

// print_r($html);die;

// //var_dump($html);

// $logo = $html->find('div.img-box img',0);

// $wxName = $html->find('h3',0)->innertext;
// $wxID = $html->find('label[name=em_weixinhao]',0)->innertext;
// $sp = $html->find('span.sp-txt',0)->innertext;
// $auto = $html->find('span.sp-txt',1)->innertext;
// $qr_img = $html->find('div.v-box img',0);



// echo "logo:".$logo->src;
// echo "<br />";
// echo "wxname:".($wxName);
// echo "<br />";
// echo "wxID:".$wxID;
// echo "<br />";
// echo "descript:".$sp;
// echo "<br />";
// echo "auto:".$auto;

// echo "<br />";
// echo "qr_path:".$qr_img->src;
// echo "<br />";

//文章信息


$arr = array();
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
	file_put_contents('/home/wwwroot/proxy1.dat', trim($str));
} else {
	file_put_contents('/home/wwwroot/proxy-over.dat', 'die'.date('Y-m-d H:i:s')."\n");
}


       


// foreach($html->find('.txt-box h3') as $element) 
//       $arr['name'][]  =  strip_tags($element->innertext) . "\n";

// foreach($html->find('.txt-box h4 span') as $element) 
//        $arr['weixinhao'][]  =  strip_tags($element->innertext) . "\n";

//    foreach($html->find('.txt-box .s-p3') as $element) 
//        $arr['desc'][]  =  strip_tags($element->innertext) . "\n";

//    // foreach($html->find('.txt-box .s-p3',1) as $element) 
//    //     $arr['sign'][]  =  strip_tags($element->innertext) . "\n";

//    // foreach($html->find('.txt-box .s-p3',2) as $element) 
//    //     $arr['article'][]  =  strip_tags($element->innertext) . "\n";

//    foreach($html->find('.txt-box a') as $element) 
//        $arr['link'][]  =  strip_tags($element->href) . "\n";

// $i = 0;
//    foreach ($arr['desc'] as $key => $value) {
   	
//    	# code...
//    	$arr['desc2'][$i][] = $value;
//    	if($key%3==2){
//    		$i++;
//    	}
//    }
//    unset($arr['desc']);

print_r($arr);
// 获取所有的a链接 
// foreach($html->find('._item') as $element) 
       // echo $element->href .  "\n";

die;
// $titleObj = $html->find('._item');
// print_r($titleObj);die;
//var_dump($titleObj);
$title  = $titleObj->innertext;
$link = $titleObj->href;
$head_pic = $html->find('div.img_box2',0);
echo $title;
echo "<br />";
echo $link;
echo "<br />";
echo $head_pic->src;
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";

// print_r($return);
exit();
for($i=2;$i<15;$i++){
	$return = array();
	$sourceList1 = $sourceList.$i.'.html';
	// echo "<br>";
	// $snoopy->fetchlinks($sourceList1);
	// $return = $snoopy->results;
	$html = file_get_html($sourceList1);
	$return = $html->find('a');
	foreach ($return as $key => $value) {
		if(checkUrl($value->href)){
			//echo $value."<br />";
			$wxIdArr[] = $value;
			saveInfoWx($value->href,$type);
		}else{
			//echo $i.":false url:".$value."<br />";
		}
	}
	sleep(3);
}

function saveInfoWx($url,$type){
	echo $url."<br />";
	$html = file_get_html($url);
	$logo = $html->find('div.img-box img',0);
	$wxName = $html->find('h3',0)->innertext;
	$wxID = $html->find('label[name=em_weixinhao]',0)->innertext;
	$sp = $html->find('span.sp-txt',0)->innertext;
	$auto = $html->find('span.sp-txt',0)->innertext;
	$qr_img = $html->find('div.v-box img',0);
	//先保存到本地文件
	//顺序微信id，微信昵称，logo，描述，认证单位，二维码
	$str = $wxID.';'.$wxName.';'.$logo->src.';'.$sp.';'.$auto.';'.$qr_img->src;
	//echo $str."<br />";
	//saveInfoWx($str);
	$savePath = 'data/weixin_'.$type.'.txt';
	$link = $html->find('a');
	foreach ($link as $key => $value) {
		if(checkDetail($value->href)){

		}
	}
	file_put_contents('data/weixin_'.$type.'.txt', $str."\n",FILE_APPEND);
}

function checkUrl($url){
	//echo $url."<br/>";
	 $part = explode('/', $url);
	 $part1 = explode('.', $url);
	if( strpos($url, 'gzh?openid')&& (strlen($url) < 200)){
		
		return true;
	}else{
		return false;
	}
}

function number($str)
 {
    return preg_replace('/\D/s', '', $str);
 }
 function saveSql($sql){
 	file_put_contents('./data/sql_log_wx.txt', $sql.";\n", FILE_APPEND);
 }




 ?>