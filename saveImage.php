<?php
$filename = uniqid() . '.jpg';
$path = __DIR__."/images/".$filename;
move_uploaded_file($_FILES['webcam']['tmp_name'], $path);
$imageUrl = "http://damf.sayiwen.com/images/".$filename;
echo file_get_contents("http://damf.sayiwen.com/getSong.php?from=web&psrc=".urlencode($imageUrl));