<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$ch->MaCH = $data->MaCH;
$ch->TrangThai = 1;

if ($ch->updateStatus()) {
    echo json_encode(
        array(
            'message' => "Sua thanh cong"
        )
    );
    die();
}
echo json_encode(
    array('message' => "Sua that bai")
);
