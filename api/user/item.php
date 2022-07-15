<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$user->MaUser = isset($_GET['MaUSer']) ? $_GET['MaUSer'] : die();

$user->read_item();

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
    'TKNH' => $user->TKNH,
);
echo json_encode($user_item);
