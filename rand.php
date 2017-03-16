<?php
require_once 'Get.php';
$get = new Get();
//$list_id = $get->getSong(50,30);
$songList = $get->getList(6186912);
$index = rand(0,count($songList)-1);
$data["age"] = "";
$data["smile"] = "";
$data["song"]["name"] = $songList[$index]->name;
$data["song"]["mp3Url"] = $songList[$index]->mp3Url;
echo json_encode($data);