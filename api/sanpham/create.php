<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);

$data = json_decode(file_get_contents("php://input"));

$sp->GiaSP = $data->GiaSP;
$sp->MoTa = $data->MoTa;
$sp->NgaySanXuat = $data->NgaySanXuat;
$sp->TenSP = $data->TenSP;


if ($sp->create()) {
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
