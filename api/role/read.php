<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Role.php';

$database = new Database();
$db = $database->connect();

$role = new Role($db);

$result = $role->read();

$num = $result->rowCount();

if ($num > 0) {
    $roles = array();
    $roles['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $role_item = array(
            'MaRole' => $MaRole,
            'Ten' => $Ten,
        );

        array_push($roles['data'], $role_item);
    }

    echo json_encode($roles);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
