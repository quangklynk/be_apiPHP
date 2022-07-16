<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$user->MaRole = isset($_GET['MaRole']) ? $_GET['MaRole'] : die();

$user->getListUserByMarole();

$user_item = array(
    'AnhChanDung' => $user->AnhChanDung,
    'DiaChi' => $user->DiaChi,
    'Email' => $user->Email,
    'GioiTinh' => $user->GioiTinh,
    'HoTen' => $user->HoTen,
    'MaRole' => $user->MaRole,
    'MaUser' => $user->MaUser,
    'NgaySinh' => $user->NgaySinh,
    'SDT' => $user->SDT,
    'TKNH' => $user->TKNH,
    'CMND' => $user->CMND,
);
echo json_encode(
    array('message' => "Thanh cong!",
          'data' => $user_item)
);
