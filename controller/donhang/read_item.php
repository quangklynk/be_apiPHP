<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DonHang.php';
include_once '../../model/DichVu.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);
$dv = new DichVu($db);
$dh->MaDangKy = isset($_GET['MaDangKy']) ? $_GET['MaDangKy'] : null;

$dh->read_item();

$dv->MaDV = $dh->MaDV;
$dv->read_item();

$dh_item = array(
            'DiaChi' => $DiaChi,
            'DienThoai' => $DienThoai,
            'GhiChu' => $GhiChu,
            'MaDangKy' => $MaDangKy,
            'MaDH' => $MaDH,
            'TenDV' => $dv->TenDV,
            'SoLuong' => $SoLuong,
            'TenKH' => $TenKH,
            'ThanhTien' => $ThanhTien,
            'ThoiGianBD' => $ThoiGianBD,
            'ThoiGianKT' => $ThoiGianKT,
            'TrangThai' => $TrangThai,
);
echo json_encode($dh_item);