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

$dh->TrangThai = $data->TrangThai;
$dh->MaDangKy = $data->MaDangKy;


if ($dh->updateStatuByAdmin()) {
    echo json_encode(
        array(
            'message' => "Sua thanh cong!"
        )
    );
} else {
    echo json_encode(
        array('message' => "Sua that bai")
    );
}