<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/KhachHang.php';

$database = new Database();
$db = $database->connect();

$kh = new KhachHang($db);
$kh->MaKH = isset($_GET['MaKH']) ? $_GET['MaKH'] : die();

$kh->read_item();

$kh_item = array(
    'CMND' => $kh->CMND,
    'MaKH' => $kh->MaKH,
    'MaUser' => $kh->MaUser,
);
echo json_encode($kh_item);
