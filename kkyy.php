<?php 
	header("Content-type: text/html; charset=utf-8"); 
	include './simple_html_dom.php';
	include './config.php';
	// 新建一个Dom实例
	$html = new simple_html_dom();
	ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
	$table = 'kkyy';
	$html = file_get_html('http://www.kekenet.com/kouyu/primary/chuji/');
	foreach($html->find('#menu-list h2 a') as $element) {
		$data['title'] = strip_tags($element->innertext)."\n";
		$data['href'] = strip_tags($element->href)."\n";
		$html2 = file_get_html(trim($data['href']));
		// echo $html2;
		foreach ($html2->find('#article') as  $value) {
			# code...
			$data['content'] =  strip_tags($value->innertext);
		}
		//执行添加操作 返回1 插入成功
		$r = $db->insert($table,$data);
		die;
	}