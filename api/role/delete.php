<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Role.php';

$database = new Database();
$db = $database->connect();

$role = new Role($db);
$role->id = isset($_GET['id']) ? $_GET['id'] : die();

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
