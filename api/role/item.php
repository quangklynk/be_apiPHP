<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Role.php';

$database = new Database();
$db = $database->connect();

$role = new Role($db);
$role->id = isset($_GET['id']) ? $_GET['id'] : die();

$role->read_item();

$role_item = array(
    'MaRole' => $role->MaRole,
    'Ten' => $role->Ten,
);
echo json_encode($role_item);
