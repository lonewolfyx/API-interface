<?php
error_reporting(0);
//?id=3469754
define('API_ROOT', dirname(__FILE__));
header('Content-type: application/json');
$file=file_get_contents('http://player.kuwo.cn/webmusic/st/getNewMuiseByRid?rid=MUSIC_'.$_GET['id']); 
preg_match_all("|<name>(.+?)<\/name>|i", $file, $name);
preg_match_all("|<singer>(.+?)<\/singer>|i", $file, $singer);
preg_match_all("|<mp3dl>(.+?)<\/mp3dl>|i", $file, $dz_a);
preg_match_all("|<mp3path>(.+?)<\/mp3path>|i", $file, $dz_b);
preg_match_all("|<artist_pic>(.+?)<\/artist_pic>|i", $file, $artist_pic);
$music=array(
	'title'=>substr($name[0][0],6,-7),
	'singer'=>substr($singer[0][0],8,-9),
	'mp3'=>"http://".substr($dz_a[0][0],7,-8)."/resource/".substr($dz_b[0][0],9,-10),
	'artist_pic'=>substr($artist_pic[0][0],12,-13),
);
echo json_encode($music);
