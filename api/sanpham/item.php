<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);
$sp->MaSP = isset($_GET['MaSP']) ? $_GET['MaSP'] : die();

$sp->read_item();

$sp_item = array(
    'GiaSP' => $sp->GiaSP,
    'MaSP' => $sp->MaSP,
    'MoTa' => $sp->MoTa,
    'NgaySanXuat' => $sp->NgaySanXuat,
    'TenSP' => $sp->TenSP,
);
echo json_encode($sp_item);
