<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/DichVu.php';

$database = new Database();
$db = $database->connect();

$kh = new DichVu($db);

$result = $kh->read();

$num = $result->rowCount();

if ($num > 0) {
    $khs = array();
    $khs['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $kh_item = array(
            'CMND' => $CMND,
            'MaKH' => $MaKH,
            'MaUser' => $MaUser,
        );

        array_push($khs['data'], $kh_item);
    }

    echo json_encode($khs);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}