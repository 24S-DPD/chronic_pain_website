<?php

header('Content-Type: application/json');

require_once('recover_data_for_physician.php');

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit();
}

if (!isset($_GET['first_name']) || !isset($_GET['last_name'])) {
    echo json_encode(["error" => "Missing parameters"]);
    exit();
}

$firstName = $_GET['first_name'];
$lastName = $_GET['last_name'];

$data = getUserData($firstName, $lastName);

echo json_encode($data);
?>
