<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Role.php';

$database = new Database();
$db = $database->connect();

$role = new Role($db);

$data = json_decode(file_get_contents("php://input"));

$role->Ten = $data->Ten;


if ($role->create()) {
    echo json_encode(
        array(
            'message' => "Tao thanh cong"
        )
    );
} else {
    echo json_encode(
        array('message' => "Tao that bai")
    );
}
