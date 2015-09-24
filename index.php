<?php
error_reporting(0);
header('Content-type: application/json');
$url=g_contents('http://v.qq.com/live/tv/list.html');
preg_match_all('|_hot="live.tvlist.programlist" href="http://v.qq.com/live/tv/(\d+).html|',$url,$id);
$playListInfo=array();
foreach($id[1] as $k=>$ids){
    $data=g_contents('http://v.qq.com/live/tv/'.$ids.'.html');
    preg_match("|playid:'(\d+)'|",$data,$pid);
    preg_match("|channelname:'([^']+)'|",$data,$cname);
    $xml.='<m type="2" label="'.$cname[1].'" src="http://zb.v.qq.com:1863/?progid='.$pid[1].'&ostype=pc&channel_id='.$ids.'"/>'."\n";
	$playListInfo['live'][] = array(
		'cname'=>$cname[1],
		'src'=>"http://zb.v.qq.com:1863/?progid=".$pid[1]."&ostype=pc&channel_id=$ids"
	);
}
echo json_encode($playListInfo);
function g_contents($url) {
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,30);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_ENCODING ,'');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    @$data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>
