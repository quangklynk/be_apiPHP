<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);
$user = new User($db);

$sp->MaSP = isset($_GET['MaSP']) ? $_GET['MaSP'] : null;
$user->token = isset($_GET['token']) ? $_GET['token'] : null;

if ($user->checkShop() || $user->checkAdmin()) {
    if ($sp->delete()) {
        echo json_encode(
            array(
                'message' => "Xoa thanh cong"
            )
        );
        die();
    }
    echo json_encode(
        array('message' => "Xoa that bai")
    );
} else {
    echo json_encode(
        array('message' => "Khong quyen truy cap!")
    );
}

