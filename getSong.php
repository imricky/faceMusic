<?php
if(!isset($_GET["psrc"])){
    echo "psrc is required";
    exit;
}
require_once 'facepp_sdk.php';
require_once 'Get.php';
########################
###     example      ###
########################
$facepp = new Facepp();
$facepp->api_key       = 'Up4r2DH89S_1317vWYIN4GlWvw-njt8f';
$facepp->api_secret    = 'ZTBmwlZ4gygzUTJSVgBT2FiojoIWFqRE';

$params['url']          = urldecode($_GET['psrc']);
$response               = $facepp->execute('/detection/detect',$params);
$face = json_decode($response["body"]);
$smile = $face->face[0]->attribute->smiling->value;
$age = $face->face[0]->attribute->age->value;
$get = new Get();
$list_id = $get->getSong($age*(2/3),$smile);
$songList = $get->getList($list_id);
if(isset($_GET["from"]) && $_GET["from"] == "wx"){
    $index = rand(0,count($songList)-1);
    $data["age"] = number_format($age*(2/3),0);
    $data["smile"] = $smile;
    $data["song"]["name"] = $songList[$index]->name;
    $data["song"]["mp3Url"] = $songList[$index]->mp3Url;
    echo json_encode($data);
    exit;
}else if(isset($_GET["from"]) && $_GET["from"] == "web"){
    $data["age"] = number_format($age*(2/3),0);
    $data["smile"] = $smile;
    foreach ($songList as $song) {
        $songs[] = ["name"=>$song->name,"mp3Url"=>$song->mp3Url];
    }
    $data["songs"] = $songs;
    echo json_encode($data);exit;
}
echo "Age:".$age."<br>";
echo "Smile:".$smile."<br>";
echo "<hr>";
foreach ($songList as $song) {
    echo "<h3>".$song->name."</h3>";
    echo "<audio preload='none' controls src='".$song->mp3Url."'></audio>";
    echo "<hr>";
}


