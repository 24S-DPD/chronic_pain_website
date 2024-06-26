<?php
require_once("constants.php");

function getPatientNames() {
    try {
        // Connection
        $db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to get the first and last names of all patients
        $query = 'SELECT first_name, last_name FROM userinformation WHERE user_role = "patient"';
        $statement = $db->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $exception) {
        error_log('Request error: ' . $exception->getMessage());
        return false;
    }
}

$patients = getPatientNames();

if ($patients !== false) {
    echo json_encode(['status' => 'success', 'patients' => $patients]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unable to fetch patient data.']);
}
?>
