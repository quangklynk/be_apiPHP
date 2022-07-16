<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/SanPham.php';

$database = new Database();
$db = $database->connect();

$sp = new SanPham($db);
$sp->MaSP = isset($_GET['MaSP']) ? $_GET['MaSP'] : die();

$result = $sp->read();

$num = $result->rowCount();

if ($num > 0) {
    $sps = array();
    $sps['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $sp_item = array(
            'GiaSP' => $GiaSP,
            'MaSP' => $MaSP,
            'MoTa' => $MoTa,
            'NgaySanXuat' => $NgaySanXuat,
            'TenSP' => $TenSP,
            'HinhAnh' => $HinhAnh,
        );

        array_push($sps['data'], $sp_item);
    }

    echo json_encode($sps);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
