<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';
include_once '../../model/User.php';
include_once '../../config/UpLoadFile.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);
$user = new User($db);
$uploadfile = new UpLoadFile();

// $data = json_decode(file_get_contents("php://input"), true);

$fileName = $_FILES['image']['name'];
$tempPath = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$path = "../../storage/image/";

$ch->LoaiCuaHang = $_POST['LoaiCuaHang'];
$ch->MaUser = $_POST['MaUser'];
$ch->Ten = $_POST['Ten'];
$ch->TrangThai = 0;
$ch->HinhAnh = $fileName;

$user->token = $_POST['token'];


if ($user->checkShop()) {
    if ($ch->create()) {
        $uploadfile->upload($fileName, $tempPath, $fileSize, $path);
        echo json_encode(
            array(
                'message' => "Tao thanh cong"
            )
        );
        die();
    }
    echo json_encode(
        array('message' => "Tao that bai")
    );
} else {
    echo json_encode(
        array('message' => "Khong quyen truy cap!")
    );
}