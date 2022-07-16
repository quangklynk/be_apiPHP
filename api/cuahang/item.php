<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);
$user = new User($db);
$ch->MaCH = isset($_GET['MaCH']) ? $_GET['MaCH'] : die();

if ($user->checkEndUser()) {
    echo json_encode(
        array('message' => "Khong du quyen truy cap")
    );
} else {
    $ch->read_item();

    $ch_item = array(
        'LoaiCuaHang' => $ch->LoaiCuaHang,
        'MaCH' => $ch->MaCH,
        'MaUser' => $ch->MaUser,
        'Ten' => $ch->Ten,
        'TrangThai' => $ch->TrangThai,
        'HinhAnh' => $ch->HinhAnh,
    );
    echo json_encode($ch_item);
}
