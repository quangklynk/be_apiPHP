<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/KhachHang.php';

$database = new Database();
$db = $database->connect();

$kh = new KhachHang($db);
$kh->MaKH = isset($_GET['MaKH']) ? $_GET['MaKH'] : die();

if ($kh->delete()) {
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