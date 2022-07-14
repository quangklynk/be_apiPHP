<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../config/UpLoadFile.php';

$data = json_decode(file_get_contents("php://input"), true);

$fileName = $_FILES['image']['name'];
$tempPath = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$path = "../../storage/image/";

$uploadfile = new UpLoadFile();
$uploadfile->upload($fileName, $tempPath, $fileSize, $path);


// if (!isset($errorMSG)) {
    // code ở đây
// }
