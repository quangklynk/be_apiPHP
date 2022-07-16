<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/CuaHangSanPham.php';

$database = new Database();
$db = $database->connect();

$chsp = new CuaHangSanPham($db);

$data = json_decode(file_get_contents("php://input"));

$chsp->MaCH = $data->MaCH;
$chsp->MaSP = $data->MaSP;
$chsp->SoLuong = $data->SoLuong;


if ($chsp->create()) {
    echo json_encode(
        array(
            'message' => "Tao thanh cong"
        )
    );
    die();
} else {
    echo json_encode(
        array('message' => "Tao that bai")
    );
}
