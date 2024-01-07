<?php
include('config.php');
$key = Music_key;
$id = $_GET['id'];
$type = Music_type;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, Music_host."/open/music/pic?key={$key}&id={$id}&type={$type}");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 6);
$output = curl_exec($ch);
curl_close($ch);
$output = json_decode($output, true);
if($output['code'] == 1){
    if(!empty($output['data'])){
        header("Location:".(str_replace('150x150', '300x300', str_replace('150y150', '300y300', str_replace('stdmusic/150', 'stdmusic/400', $output['data'])))), true, 302);
    }else{
        header("Location:".Music_host."/player/err.jpg", true, 302);
    }
}else{
    header("Location:".Music_host."/player/err.jpg", true, 302);
}
