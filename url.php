<?php
include('config.php');
$key = Music_key;
$id = $_GET['id'];
$type = Music_type;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, Music_host."/open/music/url?key={$key}&id={$id}&type={$type}");
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
        header("Location:".$output['data'], true, 302);
    }
}