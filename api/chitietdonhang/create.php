<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/ChiTietDonHang.php';

$database = new Database();
$db = $database->connect();

$ctdh = new ChiTietDonHang($db);

$data = json_decode(file_get_contents("php://input"));

$ctdh->GiaTien = $data->GiaTien;
$ctdh->MaDH = $data->MaDH;
$ctdh->MaSP = $data->MaSP;
$ctdh->SoLuong = $data->SoLuong;


if ($ctdh->create()) {
    echo json_encode(
        array(
            'message' => "Tao thanh cong"
        )
    );
} else {
    echo json_encode(
        array('message' => "Tao that bai")
    );
}
