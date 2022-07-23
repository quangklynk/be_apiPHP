<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$user->MaUser = isset($_GET['MaUser']) ? $_GET['MaUser'] : die();

if ($role->delete()) {
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