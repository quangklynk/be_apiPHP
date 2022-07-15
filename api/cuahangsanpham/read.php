<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/CuaHangSanPham.php';

$database = new Database();
$db = $database->connect();

$chsp = new CuaHangSanPham($db);

$result = $chsp->read();

$num = $result->rowCount();

if ($num > 0) {
    $chsps = array();
    $chsps['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $chsp_item = array(
            'ID' => $ID,
            'MaCH' => $MaCH,
            'MaSP' => $MaSP,
            'SoLuong' => $SoLuong,
        );

        array_push($chsps['data'], $chsp_item);
    }

    echo json_encode($chsps);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
