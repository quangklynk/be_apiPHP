<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/config.inc';
include_once '../../model/TaiKhoan.php';

$database = new Database();
$db = $database->connect();

$tk = new TaiKhoan($db);

$data = json_decode(file_get_contents("php://input"));

$tk->TenTK = $data->SDT;
$tk->MatKhau = $data->MatKhau;


if ($tk->login()) {
    return json_encode(
        array('message' => "Dang nhap thanh cong!")
    );
} else {
    return json_encode(
        array('message' => "Sai thong tin dang nhap, hoac chua dang ky!")
    );
} 