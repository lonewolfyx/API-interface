<?php
//id=1500969;
error_reporting(0);
define('API_ROOT', dirname(__FILE__));
$video_id=addslashes($_GET['id']);
$hunan_json=file_get_contents("http://v.api.hunantv.com/player/video?video_id=$video_id");
$hunan=json_decode($hunan_json);
$imgo=array(
	'type'=>$hunan->data->info->root_name,
	'name'=>$hunan->data->info->collection_name,
	'title'=>$hunan->data->info->title,
	'series'=>$hunan->data->info->series,
	'url'=>$hunan->data->info->url,
	'thumb'=>$hunan->data->info->thumb,
	'desc'=>$hunan->data->info->desc,
	'stream'=>array(
		'0'=>array(
			'url'=>$hunan->data->stream[0]->url,
			'name'=>'标清',
		),
		'1'=>array(
			'url'=>$hunan->data->stream[1]->url,
			'name'=>'高清',
		),
		'2'=>array(
			'url'=>$hunan->data->stream[2]->url,
			'name'=>'超清',
		),
	),
);
header('Content-type: application/json');
echo json_encode($imgo);
