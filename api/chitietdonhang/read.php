<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/ChiTietDonHang.php';

$database = new Database();
$db = $database->connect();

$ctdh = new ChiTietDonHang($db);

$result = $ctdh->read();

$num = $result->rowCount();

if ($num > 0) {
    $ctdhs = array();
    $ctdhs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $ctdh_item = array(
            'MaCTDH' => $MaCTDH,
            'MaDH' => $MaDH,
            'MaSP' => $MaSP,
            'SoLuong' => $NgaySanXuat,
            'GiaTien' => $GiaTien,
            'TenSP' => $TenSP,
        );

        array_push($ctdhs['data'], $ctdh_item);
    }

    echo json_encode($ctdhs);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
