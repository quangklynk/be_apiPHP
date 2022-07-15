<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->SDT = $data->SDT;
$user->MatKhau = $data->MatKhau;


if ($user->checkAccount()) {
    if ($user->checkToken()) {
        return json_encode(
            array('message' => "Dang nhap thanh cong!",
                  'token' => $user->token,
                  'data' => $user,)
        );
    }

    return json_encode(
        array('message' => "Loi khi tao token!")
    );
} else {
    return json_encode(
        array('message' => "Sai thong tin dang nhap, hoac chua dang ky!")
    );
}