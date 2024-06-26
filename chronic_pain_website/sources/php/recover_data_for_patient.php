<?php
session_start();

function getUserData() {
    try {
        // Connection
        require_once('constants.php');
        $db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifiez si l'utilisateur est connecté
        if (!isset($_SESSION["user_id"])) {
            return ["error" => "User not authenticated"];
        }

        $userId = $_SESSION["user_id"];

        // SELECT request to recover the data from "newpain" table for the connected user
        $query = "SELECT p.id, p.pain_intensity, p.pain_related_distress, p.pain_related_interference,
                         p.ideas_about_pain, p.concerns_about_pain, p.expectations, p.closing_thoughts,
                         pb.pain_beginning AS ID_pain_beginning,
                         tp.temporal_pattern AS ID_temporal_pattern,
                         pl.pain_location AS ID_pain_location,
                         v.vertebrea AS ID_vertebrae,
                         yn_cancer.response AS cancer,
                         yn_cancer_treatment.response AS cancer_treatment,
                         yn_begin_after_surgery.response AS begin_after_surgery,
                         yn_worse_after_surgery.response AS worse_after_surgery,
                         yn_spread_of_pain.response AS spread_of_pain,
                         yn_area_of_surgery.response AS area_of_surgery,
                         yn_brain_nerves.response AS brain_nerves_illness,
                         yn_internal_organs.response AS internal_organs_issues,
                         yn_musculoskeletal_pain.response AS musculoskeletal_pain,
                         yn_headaches.response AS headaches_pain_face,
                         ui.first_name, ui.last_name, ui.email, ui.phone_number, ui.user_role
                  FROM newpain p
                  LEFT JOIN pain_beginning pb ON p.ID_pain_beginning = pb.ID
                  LEFT JOIN temporal_pattern tp ON p.ID_temporal_pattern = tp.ID
                  LEFT JOIN pain_location pl ON p.ID_pain_location = pl.abreviation
                  LEFT JOIN yesorno_questions yn_cancer ON p.cancer = yn_cancer.ID
                  LEFT JOIN yesorno_questions yn_cancer_treatment ON p.cancer_treatment = yn_cancer_treatment.ID
                  LEFT JOIN yesorno_questions yn_begin_after_surgery ON p.begin_after_surgery = yn_begin_after_surgery.ID
                  LEFT JOIN yesorno_questions yn_worse_after_surgery ON p.worse_after_surgery = yn_worse_after_surgery.ID
                  LEFT JOIN yesorno_questions yn_spread_of_pain ON p.spread_of_pain = yn_spread_of_pain.ID
                  LEFT JOIN yesorno_questions yn_area_of_surgery ON p.area_of_surgery = yn_area_of_surgery.ID
                  LEFT JOIN yesorno_questions yn_brain_nerves ON p.brain_nerves_illness = yn_brain_nerves.ID
                  LEFT JOIN yesorno_questions yn_internal_organs ON p.internal_organs_issues = yn_internal_organs.ID
                  LEFT JOIN yesorno_questions yn_musculoskeletal_pain ON p.musculoskeletal_pain = yn_musculoskeletal_pain.ID
                  LEFT JOIN yesorno_questions yn_headaches ON p.headaches_pain_face = yn_headaches.ID
                  LEFT JOIN vertebrea v ON p.ID_vertebrae = v.ID
                  LEFT JOIN userinformation ui ON p.ID_user = ui.ID
                  WHERE p.ID_user = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Recover the results
        $dataTable = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $dataTable;

    } catch (PDOException $exception) {
        error_log('Request error ' . $exception->getMessage());
        return ["error" => $exception->getMessage()];
    }
}
?>
