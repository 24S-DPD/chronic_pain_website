<?php
session_start();

try {
    // Retrieve the log of connection and connection to the server
    require_once('constants.php');

    // Retrieve the user ID
    $userId = $_SESSION['user_id'];

    $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve info from submitForm.js with ajax request
    $pain_beginning = $_POST['pain_begining'];
    $pain_intensity = $_POST['pain_intensity'];
    $idPattern = $_POST['pattern'];
    $idDistress = $_POST['distress'];
    $idInterference = $_POST['interference'];
    $idPainLocation = $_POST['pain_location'];
    $cancer = $_POST['cancer'];
    $cancerTreatment = $_POST['cancer_treatment'];
    $beginAfterSurgery = $_POST['begin_after_surgery'];
    $worseAfterSurgery = $_POST['worse_after_surgery'];
    $areaSurgery = $_POST['area_surgery'];
    $spreadPainSurgery = $_POST['spread_pain_surgery'];
    $brainNerves = $_POST['brain_nerves_illness'];
    $internalOrgans = $_POST['internal_organs'];
    $musculoskeletal_pain = $_POST['musculoskeletal_pain'];
    $headaches = $_POST['headaches'];
    $ideas_about_pain = isset($_POST['ideas_about_pain']) ? $_POST['ideas_about_pain'] : '';;
    $concerns_about_pain = isset($_POST['concerns_about_pain']) ? $_POST['concerns_about_pain'] : '';
    $expectations = isset($_POST['expectations']) ? $_POST['expectations'] : '';
    $closing_thoughts = isset($_POST['closing_thoughts']) ? $_POST['closing_thoughts'] : '';
    $pain_location = $_POST['pain_location'];

    $zones = explode(';', $pain_location);

    print_r($_POST);

    // Prepare the insertion request
    $statement = $db->prepare("INSERT INTO newpain (ID_user, ID_pain_beginning, pain_intensity, ID_temporal_pattern, pain_related_distress, pain_related_interference, cancer, 
    cancer_treatment, begin_after_surgery, worse_after_surgery, area_of_surgery, spread_of_pain, brain_nerves_illness, internal_organs_issues, musculoskeletal_pain, headaches_pain_face,
    ideas_about_pain, concerns_about_pain, expectations, closing_thoughts, ID_pain_location, ID_vertebrae)
    VALUES (:user_id, :pain_beginning, :pain_intensity, :pattern, :distress, :interference, :cancer, 
    :cancer_treatment, :begin_after_surgery, :worse_after_surgery, :area_surgery, :spread_pain_surgery, :brain_nerves, 
    :internal_organs, :musculoskeletal_pain, :headaches, :ideas_about_pain, :concerns_about_pain, :expectations, :closing_thoughts, 
    :abbr, :vertebre)");

print_r($zones);
foreach ($zones as $zone) {
    $zone = trim($zone);
    if (!empty($zone)) {
        list($vertebre, $abbr) = explode(' ', $zone);
    
        // Assigner les valeurs aux paramètres de la requête
        $statement->bindParam(':user_id', $userId);
        $statement->bindParam(':pain_beginning', $pain_beginning);
        $statement->bindParam(':pain_intensity', $pain_intensity);
        $statement->bindParam(':pattern', $idPattern);
        $statement->bindParam(':distress', $idDistress);
        $statement->bindParam(':interference', $idInterference);
        $statement->bindParam(':vertebre', $vertebre);
        $statement->bindParam(':abbr', $abbr);
        $statement->bindParam(':cancer', $cancer);
        $statement->bindParam(':cancer_treatment', $cancerTreatment);
        $statement->bindParam(':begin_after_surgery', $beginAfterSurgery);
        $statement->bindParam(':worse_after_surgery', $worseAfterSurgery);
        $statement->bindParam(':area_surgery', $areaSurgery);
        $statement->bindParam(':spread_pain_surgery', $spreadPainSurgery);
        $statement->bindParam(':brain_nerves', $brainNerves);
        $statement->bindParam(':internal_organs', $internalOrgans);
        $statement->bindParam(':musculoskeletal_pain', $musculoskeletal_pain);
        $statement->bindParam(':headaches', $headaches);
        $statement->bindParam(':ideas_about_pain', $ideas_about_pain);
        $statement->bindParam(':concerns_about_pain', $concerns_about_pain);
        $statement->bindParam(':expectations', $expectations);
        $statement->bindParam(':closing_thoughts', $closing_thoughts);

        $statement->execute();
    }
}

} catch (PDOException $exception) {
    error_log('Request error: '.$exception->getMessage());
    var_dump($exception->getMessage());
    return false;
}
return true;

echo phpversion();
?>
