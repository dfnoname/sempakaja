<?php
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
@ini_set('display_errors', 0);
header('Access-Control-Allow-Origin: *');
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
				header('HTTP/1.1 304 Not Modified');
				die();
			} 
/* HEADER CACHE */	
header('Cache-control: public, max-age=622080000');
header('Expires: '.gmdate(DATE_RFC1123,time()+622080000));
header('Last-Modified: '.gmdate(DATE_RFC1123,time()));
header('Vary: Accept');
header('Accept-Encoding: gzip, deflate');
/* END HEADER CACHE */	


if(!isset($_GET['url']) || empty($_GET['url'])){
echo ":(";
	exit();
}	


$result= ffffffS($_GET['url']);


if(isset($_GET['replace'])){
	if(!empty($_GET['replace'])){
		if(isset($_GET['merchant'])){
			if(!empty($_GET['merchant'])){
				if($_GET['merchant'] == 'aliexpress'){
$result= preg_replace_callback('~href="\K.*(?=")~Uis', function ($matches) { return 'http://s.click.aliexpress.com/deep_link.htm?aff_short_key=vFYFqba&dl_target_url='.urlencode($matches[0]).'&dp=algisenjaya'; }, $result);					
				}	
			}	
		}	
	}	
}



echo str_replace(array("window.productDescription='",">';"), array('','>'), $result);


function ffffffS($url){
		$filecached= "cache/".md5($url).".cache";
if(file_exists($filecached)){
	return unserialize(file_get_contents($filecached));
}	
			$referer= "https://www.google.com/";
	$data = curl_init();
	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Keep-Alive: 300";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Pragma: "; // browsers keep this blank.

     curl_setopt($data, CURLOPT_SSL_VERIFYHOST, FALSE);
     curl_setopt($data, CURLOPT_SSL_VERIFYPEER, FALSE);
     curl_setopt($data, CURLOPT_URL, $url);
	 curl_setopt($data, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
	 curl_setopt($data, CURLOPT_HTTPHEADER, $header);
	 curl_setopt($data, CURLOPT_REFERER, $referer);
	 curl_setopt($data, CURLOPT_ENCODING, 'gzip,deflate');
	 curl_setopt($data, CURLOPT_AUTOREFERER, true);
	 curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($data, CURLOPT_CONNECTTIMEOUT, 60);
	 curl_setopt($data, CURLOPT_TIMEOUT, 60);
	 curl_setopt($data, CURLOPT_MAXREDIRS, 7);
	 curl_setopt($data, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($data, CURLOPT_COOKIEJAR, dirname(__FILE__).'/devtemps/cookies.txt');
curl_setopt($data, CURLOPT_COOKIEFILE, dirname(__FILE__).'/devtemps/cookies.txt');
     $hasil = curl_exec($data);
     curl_close($data);
     @file_put_contents($filecached, serialize($hasil));
return $hasil;
}
