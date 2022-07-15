<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DonHang.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);

$result = $dh->read();

$num = $result->rowCount();

if ($num > 0) {
    $dhs = array();
    $dhs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dh_item = array(
            'DiaChi' => $DiaChi,
            'MaDH' => $MaDH,
            'MaUser' => $MaUser,
            'NgayGiao' => $NgayGiao,
            'NgayMuaHang' => $NgayMuaHang,
            'TongTien' => $TongTien,
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
