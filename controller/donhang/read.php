<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/config.inc';
include_once '../../model/DonHang.php';
include_once '../../model/DichVu.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);
$dv = new DichVu($db);

$result = $dh->read();

$num = $result->rowCount();

if ($num > 0) {
    $dhs = array();
    $dhs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dv->MaDV = $MaDV;
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

        array_push($dhs['data'], $dh_item);
    }

    echo json_encode($dhs);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}