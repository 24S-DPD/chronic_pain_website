<?php
require_once('../recover_data.php');

$dataTable = getUserData();

if (isset($dataTable["error"])) {
    header('Content-Type: application/json');
    echo json_encode($dataTable);
    exit;
}

$results = array();
?>