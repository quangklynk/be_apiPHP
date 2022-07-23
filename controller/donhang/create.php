<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/config.inc';
include_once '../../model/DonHang.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);

$data = json_decode(file_get_contents("php://input"));

$dh->DiaChi = $data->DiaChi;
$dh->DienThoai = $data->DienThoai;
$dh->GhiChu = $data->GhiChu;
$dh->MaDV = $data->MaDV;
$dh->SoLuong = $data->SoLuong;
$dh->TenKH = $data->TenKH;
$dh->ThoiGianBD = $data->ThoiGianBD;
$dh->ThoiGianKT = $data->ThoiGianKT;


if ($dh->create()) { // tra ma dang ky
    echo json_encode(
        array(
            'message' => "Tao thanh cong",
            'MaDangKy' => $dh->MaDangKy
        )
    );
} else {
    echo json_encode(
        array('message' => "Tao that bai")
    );
}