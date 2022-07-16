<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';
include_once '../../config/UpLoadFile.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);
$uploadfile = new UpLoadFile();

// $data = json_decode(file_get_contents("php://input"), true);

$fileName = $_FILES['image']['name'];
$tempPath = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$path = "../../storage/image/";

$ch->MaCH = $_POST['MaCH'];
$ch->LoaiCuaHang = $_POST['LoaiCuaHang'];
$ch->Ten = $_POST['Ten'];
$ch->HinhAnh = $fileName;


if ($ch->update()) {
    echo json_encode(
        array(
            'message' => "Sua thanh cong"
        )
    );
    die();
} else {
    echo json_encode(
        array('message' => "Sua that bai")
    );
    die();
}
