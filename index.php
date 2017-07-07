<?php
/**
 * Created by PhpStorm.
 * User: Azad
 * Date: 07/07/2017
 * Time: 01:08
 */
//ini_set('max_execution_time', 3000);


require_once ('phpQuery/phpQuery.php');

$url_video = 'https://www.pornhub.com/video?page=1';
$user_agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36';
$ch = curl_init($url_video);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_USERAGENT, $user_agent);
$result = curl_exec($ch);
curl_close($ch);




$elements = \phpQuery::newDocument($result);


$video_data = $elements->find('ul.videos li.videoblock');

$i = 0;
foreach ($video_data as $v_d){
    $videos = pq($v_d);
    $url_for_video = $videos->find('.phimage a:first-child')->attr('href');
    $title = $videos->find('.phimage img')->attr('alt');
    $urls[$i] =array('url'=>'https://www.pornhub.com'.$url_for_video, 'title' =>$title);
    $i++;
}

echo '<pre>';
var_dump($urls); die;


\phpQuery::unloadDocuments();
gc_collect_cycles();
