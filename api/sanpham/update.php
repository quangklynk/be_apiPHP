<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->token = $data->token;

$sp->GiaSP = $data->GiaSP;
$sp->MoTa = $data->MoTa;
$sp->NgaySanXuat = $data->NgaySanXuat;
$sp->TenSP = $data->TenSP;
$sp->MaSP = $data->MaSP;

if ($user->checkShop()) {
    if ($sp->update()) {
        // $uploadfile->upload($fileName, $tempPath, $fileSize, $path);
        echo json_encode(
            array(
                'message' => "Sua thanh cong"
            )
        );
    }
    echo json_encode(
        array('message' => "Sua that bai")
    );
} else {
    echo json_encode(
        array('message' => "Khong quyen truy cap!")
    );
}
