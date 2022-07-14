<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Role.php';

$database = new Database();
$db = $database->connect();

$role = new Role($db);
$role->MaRole = isset($_GET['MaRole']) ? $_GET['MaRole'] : die();

$role->read_item();

$role_item = array(
    'MaRole' => $role->MaRole,
    'Ten' => $role->Ten,
);
echo json_encode($role_item);
