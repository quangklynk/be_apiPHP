<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);

$result = $ch->read();

$num = $result->rowCount();

if ($num > 0) {
    $chs = array();
    $chs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $ch_item = array(
            'LoaiCuaHang' => $LoaiCuaHang,
            'MaCH' => $MaCH,
            'MaUser' => $MaUser,
            'Ten' => $Ten,
            'TrangThai' => $TrangThai,
            'HinhAnh' => $HinhAnh,
        );

        array_push($chs['data'], $ch_item);
    }

    echo json_encode($chs);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
