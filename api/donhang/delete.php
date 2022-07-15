<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DonHang.php';

$database = new Database();
$db = $database->connect();

$dh = new DonHang($db);
$dh->MaDH = isset($_GET['MaDH']) ? $_GET['MaDH'] : die();

if ($dh->delete()) {
    echo json_encode(
        array(
            'message' => "Xoa thanh cong"
        )
    );
} else {
    echo json_encode(
        array('message' => "Xoa that bai")
    );
}
