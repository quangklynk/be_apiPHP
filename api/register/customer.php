<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/User.php';
include_once '../../model/KhachHang.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$customer = new KhachHang($db);

$data = json_decode(file_get_contents("php://input"));

$user->Email = $data->Email;
$user->HoTen = $data->HoTen;
$user->MaRole = 3;
$user->MatKhau = md5($data->MatKhau);
$user->SDT = $data->SDT;
$user->GioiTinh = $data->GioiTinh;
$user->DiaChi = $data->DiaChi;


if ($user->register()) {
    $user->getByEmail();

    $customer->CMND = $data->CMND;
    $customer->MaUser = $user->MaUser;

    if ($customer->create()) {
        echo json_encode(
            array(
                'message' => "Tao thanh cong"
            )
        );
    }
} else {
    echo json_encode(
        array('message' => "Tao that bai")
    );
}
