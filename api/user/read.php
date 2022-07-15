<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->read();

$num = $result->rowCount();

if ($num > 0) {
    $users = array();
    $users['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'AnhChanDung' => $AnhChanDung,
            'DiaChi' => $DiaChi,
            'Email' => $Email,
            'GioiTinh' => $GioiTinh,
            'HoTen' => $HoTen,
            'MaRole' => $MaRole,
            'MaUser' => $MaUser,
            'MaUser' => $MaUser,
            'SDT' => $SDT,
        );

        array_push($users['data'], $user_item);
    }

    echo json_encode($users);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
