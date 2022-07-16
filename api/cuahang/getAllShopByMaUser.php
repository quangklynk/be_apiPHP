<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/CuaHang.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$ch = new CuaHang($db);
$user = new User($db);
$user->token = isset($_GET['token']) ? $_GET['token'] : die();

$user->findUserByToken();

$ch->MaUser = $user->MaUser;

$result = $ch->getAllShopByMaUser();

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
