<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DichVu.php';

$database = new Database();
$db = $database->connect();

$dv = new DichVu($db);

$result = $dv->read();

$num = $result->rowCount();

if ($num > 0) {
    $dvs = array();
    $dvs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dv_item = array(
            'DonGia' => $DonGia,
            'LoaiDV' => $LoaiDV,
            'MaDV' => $MaDV,
            'TenDV' => $TenDV,
        );

        array_push($dvs['data'], $dv_item);
    }

    echo json_encode($dvs);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}