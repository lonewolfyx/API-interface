<?php
error_reporting(0);
define('API_ROOT', dirname(__FILE__));
//?url=http://v.qq.com/cover/w/w610dzqxeyxk8ym.html
$url=addslashes($_GET['url']);
function curl($url){
  $curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
	$src = curl_exec($curl);
	curl_close($curl);
	return $src;
}
$con=curl($url);
preg_match('|vid:"(.*)"|U', $con, $vid);
preg_match("/<title>(.*?)<\/title>/si", $con, $titleArr);
preg_match('|secTitle : "(.*)"|U', $con, $secTitle);
preg_match('|pic :"(.*)"|U', $con, $pic);
$json_data=curl('http://vv.video.qq.com/geturl?vid='.$vid[1].'&otype=json');
preg_match_all('|"url":"(.+)"|U',$json_data,$v);
$video=array(
	'title '=>$titleArr[1],
	'secTitle'=>$secTitle[1],
	'pic'=>$pic[1],
	'url'=>$v[1][1],
	'key'=>$token,
);
header('Content-type: application/json');
echo json_encode($video);
?>
