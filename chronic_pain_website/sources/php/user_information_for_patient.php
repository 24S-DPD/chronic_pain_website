<?php
header('Content-Type: application/json');

require_once('recover_data_for_patient.php');

$data = getUserData();

echo json_encode($data);
?>