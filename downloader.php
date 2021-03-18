<?php

$song_data = json_decode(file_get_contents("php://input"));

$path = $song_data->mp3;

// File to download.
$file = 'songs/' . $path;

echo $file;

if (!file_exists($file)) {
    http_response_code(404);
    die();
}

header("Cache-Control: private");
header("Content-type: audio/mpeg3");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=".$fileName);
//So the browser can display the download progress
header("Content-Length: ".filesize($file));

readfile($file);
?>
