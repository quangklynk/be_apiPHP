<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DonHang.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);
$dh->MaDH = isset($_GET['MaDH']) ? $_GET['MaDH'] : die();

$dh->read_item();

$dh_item = array(
    'DiaChi' => $dh->DiaChi,
    'MaDH' => $dh->MaDH,
    'MaUser' => $dh->MaUser,
    'NgayGiao' => $dh->NgayGiao,
    'NgayMuaHang' => $dh->NgayMuaHang,
    'TongTien' => $dh->TongTien,
    'TrangThai' => $dh->TrangThai,
);
echo json_encode($dh_item);
