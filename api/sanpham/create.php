<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';
include_once '../../model/User.php';
include_once '../../config/UpLoadFile.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);
$user = new User($db);
$uploadfile = new UpLoadFile();

$data = json_decode(file_get_contents("php://input"));

$fileName = $_FILES['image']['name'];
$tempPath = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$path = "../../storage/image/";

$sp->GiaSP = $data->GiaSP;
$sp->MoTa = $data->MoTa;
$sp->NgaySanXuat = $data->NgaySanXuat;
$sp->TenSP = $data->TenSP;
$sp->HinhAnh = $path;

if ($user->checkShop()) {
    if ($sp->create()) {
        $uploadfile->upload($fileName, $tempPath, $fileSize, $path);
        echo json_encode(
            array(
                'message' => "Tao thanh cong"
            )
        );
    }
    echo json_encode(
        array('message' => "Tao that bai")
    );
} else {
    echo json_encode(
        array('message' => "Khong quyen truy cap!")
    );
}