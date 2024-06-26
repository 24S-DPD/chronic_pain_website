<?php

header('Content-Type: application/json');

require_once('../recover_data_for_physician.php');

$firstName = $_GET['first_name'];
$lastName = $_GET['last_name'];
$userResponse = isset($_GET['response']) ? $_GET['response'] : null;
$previousQuestion = isset($_GET['previous_question']) ? $_GET['previous_question'] : null;

$dataTable = getUserData($firstName, $lastName);

$response = [
    'message' => '',
    'buttons' => []
];

if (isset($dataTable["error"])) {
    echo json_encode($dataTable);
    exit;
}

foreach ($dataTable as $data) {
    if ($data['ID_pain_beginning'] == "0-2 months") {
        $response['message'] = "No chronic pain for the user";
        $response['buttons'] = ['OK'];
    } elseif ($data["ID_pain_beginning"] != "0-2 months") {
        if ($userResponse === null && $data['pain_related_distress']>=3) {
            $response['message'] = "Not better accounted for by a chronic secondary pain condition";
            $response['buttons'] = ['Yes', 'No'];

            break;
        //Beginning of Chronic primary pain
        } elseif ($userResponse === "Yes" && $previousQuestion === "Not better accounted for by a chronic secondary pain condition") {
            $response['message'] = "MG30.0 Chronic primary pain";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "OK" && $previousQuestion === "MG30.0 Chronic primary pain") {
            $response['message'] = "Pain in more than 4 body regions: more than 3 body quadrants and axial skeleton";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of MG30.01 Fibromyalgia syndrome
        elseif ($userResponse === "Yes" && $previousQuestion === "Pain in more than 4 body regions: more than 3 body quadrants and axial skeleton") {
            $response['message'] = "Pain is associated with sleep disorders OR cognitive dysfunction OR somatic symptoms";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse === "No" && $previousQuestion === "Pain is associated with sleep disorders OR cognitive dysfunction OR somatic symptoms") {
            $response['message'] = "MG30.01 Chronic widespread pain";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "Yes" && $previousQuestion === "Pain is associated with sleep disorders OR cognitive dysfunction OR somatic symptoms") {
            $response['message'] = "MG30.01 Fibromyaglia syndrome (ID 236601102)";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.01 Fibromyaglia Syndrome
        
        //End of chronic primary pain

        //Beginning of Chronic cancer related pain
         elseif ($userResponse === "No" && $previousQuestion === "Not better accounted for by a chronic secondary pain condition" && ($data["cancer"]==="Yes" || $data["cancer_treatment"] === "Yes")){
            $response['message'] = "MG30.1 Chronic cancer related pain";
            $response['buttons'] = ['OK'];
            break;
        }
        
        elseif ($userResponse==="OK" && $previousQuestion === "MG30.1 Chronic cancer related pain") {
            $response['message'] = "Pain anatomically related to confirmed tumor or metastases";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Pain anatomically related to confirmed tumor or metastases") {
            $response['message'] = "MG30.10 : Chronic cancer pain";
            $response['buttons'] = ['OK'];
            break;
        }

        //Beginning of MG30.10 Chronic cancer pain
        elseif ($userResponse==="OK" && $previousQuestion === "MG30.10 : Chronic cancer pain") {
            $response['message'] = "History of cancer or metastases in internal organs ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of MG30.10 Chronic visceral cancer pain
        elseif ($userResponse==="Yes" && $previousQuestion === "History of cancer or metastases in internal organs ?") {
            $response['message'] = "Pain location compatible with typical visceral referral pain patterns ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Pain location compatible with typical visceral referral pain patterns ?") {
            $response['message'] = "One or more confirmatory test demonstrates the location of the cancer ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "One or more confirmatory test demonstrates the location of the cancer ?") {
            $response['message'] = "MG30.10 Chronic visceral cancer pain (ID : 925682659)";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.10 Chronic visceral cancer pain

        elseif ($userResponse === "No" && ($previousQuestion === "History of cancer or metastases in internal organs ?" || $previousQuestion === "Pain location compatible with typical visceral referral pain patterns ?" || $previousQuestion === "One or more confirmatory test demonstrates the location of the cancer ?")){
            $response['message'] = "Pain related to known tumor or metastases in bone, confirmed on clinical and radiological examination ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of MG30.10 Chronic bone cancer pain
        elseif ($userResponse==="Yes" && $previousQuestion === "Pain related to known tumor or metastases in bone, confirmed on clinical and radiological examination ?") {
            $response['message'] = "MG30.10 : Chronic bone cancer pain (ID 1223823468)";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.10 Chronic bone cancer pain

        elseif ($userResponse === "No" && ($previousQuestion === "Pain related to known tumor or metastases in bone, confirmed on clinical and radiological examination ?")){
            $response['message'] = "Pain anatomically related to known tumor or metastases comprising a structure of the somatosensory nervous system ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse === "Yes" && ($previousQuestion === "Pain anatomically related to known tumor or metastases comprising a structure of the somatosensory nervous system ?")){
            $response['message'] = "Pain distribution neuroanatomically plausible ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of MG30.10 Chronic cancer pain, other specified
        elseif ($userResponse === "No" && ($previousQuestion === "Pain anatomically related to known tumor or metastases comprising a structure of the somatosensory nervous system ?" || $previousQuestion === "Pain distribution neuroanatomically plausible ?" || $previousQuestion === "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?")){
            $response['message'] = "MG30.10 : Chronic cancer pain, other specified";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.10 Chronic cancer pain, other specified

        //Beginning of the last branch of the MG30.10 Chronic cancer pain
        elseif ($userResponse === "Yes" && ($previousQuestion === "Pain distribution neuroanatomically plausible ?")){
            $response['message'] = "MG30.10 : Chronic neuropathic cancer pain (ID : 1480100314) possible";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "OK" && ($previousQuestion === "MG30.10 : Chronic neuropathic cancer pain (ID : 1480100314) possible")){
            $response['message'] = "Sensory signs in same neuroanatomically plausible distribution";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse === "No" && ($previousQuestion === "Sensory signs in same neuroanatomically plausible distribution")){
            $response['message'] = "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 1 -->";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse === "No" && ($previousQuestion === "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 1 -->")){
            $response['message'] = "MG30.10 Chronic cancer pain, other specified";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "Yes" && ($previousQuestion === "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 1 -->")){
            $response['message'] = "MG30.10 Chronic neuropathic cancer pain (ID 1480100314), probable";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "Yes" && ($previousQuestion === "Sensory signs in same neuroanatomically plausible distribution")){
            $response['message'] = "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 2 -->";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse === "No" && ($previousQuestion === "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 2 -->")){
            $response['message'] = "MG30.10 Chronic neuropathic cancer pain (ID 1480100314), probable";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse === "Yes" && ($previousQuestion === "Clinical and radiological examinations confirm a primary tumor or metastases explaining the pain ?<!-- 2 -->")){
            $response['message'] = "MG30.10 Chronic neuropathic cancer pain (ID 1480100314), definite";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of the last branch of the MG30.10 Chronic cancer pain

        //End of MG30.10 Chronic cancer pain

        //Beginning of chronic postsurgical pain
        elseif ($userResponse==="No" && $previousQuestion === "Pain anatomically related to confirmed tumor or metastases") {
            $response['message'] = "History of cancer surgery";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }
        
        elseif ($userResponse==="Yes" && $previousQuestion === "History of cancer surgery") {
            $response['message'] = "Pain located in or referred from area of the surgery";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Pain located in or referred from area of the surgery") {
            $response['message'] = "Pain began or intensified after surgery ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Pain began or intensified after surgery ?") {
            $response['message'] = "You are redirected to the branch";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of chronic postsurgical pain

        elseif ($userResponse==="No" && ($previousQuestion === "History of cancer surgery" || $previousQuestion === "Pain located in or referred from area of the surgery" || $previousQuestion === "Pain began or intensified after surgery ?")) {
            $response['message'] = "History of cancer treatment other than surgery ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of chronic post cancer treatment pain
        elseif ($userResponse==="Yes" && $previousQuestion === "History of cancer treatment other than surgery ?") {
            $response['message'] = "It is likely that the pain is caused by cancer treamtent ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "It is likely that the pain is caused by cancer treamtent ?") {
            $response['message'] = "Active or recurrent tumor/metastases excluded on radiological examination OR pain is not better accounted for by active tumor/metastases ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Active or recurrent tumor/metastases excluded on radiological examination OR pain is not better accounted for by active tumor/metastases ?") {
            $response['message'] = "MG30.11 Chronic post cancer treatment pain";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif ($userResponse==="OK" && $previousQuestion === "MG30.11 Chronic post cancer treatment pain") {
            $response['message'] = "History of treatment with anti-cancer medicine ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginning of MG.30.11 Chronic post cancer medicine pain
        elseif ($userResponse==="Yes" && $previousQuestion === "History of treatment with anti-cancer medicine ?") {
            $response['message'] = "MG30.11 Chronic post cancer medicine pain (ID 1065928586)";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG.30.11 Chronic post cancer medicine pain

        elseif ($userResponse==="No" && $previousQuestion === "History of treatment with anti-cancer medicine ?") {
            $response['message'] = "History of treatment with radiotherapy ?";
            $response['buttons'] = ['Yes','No'];
            break;
        }

        //Beginning of MG30.11 Chronic post radiotherapy pain (ID 1727344827)
        elseif ($userResponse==="Yes" && $previousQuestion === "History of treatment with radiotherapy ?") {
            $response['message'] = "Anatomical location of pain is related to the site of radiotherapy ?";
            $response['buttons'] = ['Yes','No'];
            break;
        }

        elseif ($userResponse==="Yes" && $previousQuestion === "Anatomical location of pain is related to the site of radiotherapy ?") {
            $response['message'] = "MG30.11 Chronic post radiotherapy pain (ID 1727344827)";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.11 Chronic post radiotherapy pain (ID 1727344827)

        //Beginning of MG30.11 Chronic post cancer treatment pain, other specified
        elseif ($userResponse==="No" && ($previousQuestion === "History of treatment with radiotherapy ?" || $previousQuestion === "Anatomical location of pain is related to the site of radiotherapy ?")) {
            $response['message'] = "MG30.11 Chronic post cancer treatment pain, other specified";
            $response['buttons'] = ['OK'];
            break;
        }

        //End of //Beginning of MG30.11 Chronic post cancer treatment pain, other specified

        //End of chronic post cancer treatment pain

        //Beginning of MG30.1Z chronic cancer related pain, unspecified
        elseif($userResponse==="No" && ($previousQuestion === "Active or recurrent tumor/metastases excluded on radiological examination OR pain is not better accounted for by active tumor/metastases ?" || $previousQuestion === "History of cancer treatment other than surgery ?" || $previousQuestion === "It is likely that the pain is caused by cancer treamtent ?")) {
            $response['message'] = "Other specified form of chronic cancer related pain ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif($userResponse==="No" && $previousQuestion === "Other specified form of chronic cancer related pain ?"){
            $response['message'] = "MG30.1Z : chronic cancer related pain, unspecified";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.1Z chronic cancer related pain, unspecified

        //Beginning of MG30.1Y Other specified chronic cancer related pain
        elseif($userResponse==="Yes" && $previousQuestion === "Other specified form of chronic cancer related pain ?"){
            $response['message'] = "MG30.1Y : Other specified chronic cancer related pain";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of MG30.1Y Other specified chronic cancer related pain
        
        //End of chronic cancer related pain


        //Beginning of Chronic postsurgical or post traumatic pain
        elseif/*$previousQuestion==="MG30.11 Chronic post cancer treatment pain, other specified" || $previousQuestion==="MG30.11 Chronic post radiotherapy pain (ID 1727344827)")*/(($data["worse_after_surgery"] === "Yes" || $data["begin_surgery"] === "Yes") && ($data["spread_of_pain"]==="Yes" || $data["area_of_surgery"])){
            $response['message'] = "MG30.2 : Chronic postsurgical or post traumatic pain";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of Chronic postsurgical or post traumatic pain

        //Beginning of Chronic neuropathic pain
        elseif($data["brain_nerves_illness"] === "Yes"){
            $response['message'] = "MG30.5 : Chronic neuropathic pain, possible";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of Chronic neuropathic pain

        //Beginning of Chronic secondary visceral pain
        elseif($data["internal_organs_issues"] === "Yes"){
            $response['message'] = "Anatomical location compatible with typical referral pain patterns from specific organs ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif($userResponse === "Yes" && $previousQuestion === "Anatomical location compatible with typical referral pain patterns from specific organs ?"){
            $response['message'] = "One or more test demonstrate anatomical location compatible with referral patterns ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif($userResponse === "Yes" && $previousQuestion === "One or more test demonstrate anatomical location compatible with referral patterns ?"){
            $response['message'] = "One or more test demonstrates the relevant dysfunction or disease ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif($userResponse === "Yes" && $previousQuestion === "One or more test demonstrates the relevant dysfunction or disease ?"){
            $response['message'] = "MG30.4 : Chronic secondary visceral pain";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of Chronic secondary visceral pain

        //Beginning of Chronic secondary musculoskeletal pain
        elseif($data["musculoskeletal_pain"] === "Yes"){
            $response['message'] = "Musculoskeletal disease or neurological disease with musculoskeletal involvement is present and demonstrated by appropriate clinical examination or appropriate tests ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        elseif($userResponse === "Yes" && $previousQuestion === "Musculoskeletal disease or neurological disease with musculoskeletal involvement is present and demonstrated by appropriate clinical examination or appropriate tests ?"){
            $response['message'] = "MG30.3 : Chronic secondary musculoskeletal pain";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of Chronic secondary musculoskeletal pain

        //Beginning of headache pain
        elseif($data["headaches_pain_face"] === "Yes"){
            $response['message'] = "The patient suffers of chronic headache or orofacial pain. Please refer to the ICHD-3 / the ICOP and the ICD-11 coding Tool";
            $response['buttons'] = ['OK'];
            break;
        }  
        //End of headache pain 

        elseif($data["headaches_pain_face"] === "No" || $response['message'] === "The patient suffers of chronic headache or orofacial pain. Please refer to the ICHD-3 / the ICOP and the ICD-11 coding Tool"){
            $response['message'] = "Is all chronic pain explained after that ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }  
        
        elseif($userResponse === "No" && $previousQuestion === "Is all chronic pain explained after that ?"){
            $response['message'] = "Check emotional distress and functional disability";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif($previousQuestion === "Check emotional distress and functional disability" && $data["pain_related_distress"]>=3){
            $response['message'] = "MG30.0 Chronic primary pain";
            $response['buttons'] = ['OK'];
            break;
        }

        elseif($previousQuestion === "Check emotional distress and functional disability" && $data["pain_related_distress"]<3){
            $response['message'] = "Other specified form of chronic pain ?";
            $response['buttons'] = ['Yes', 'No'];
            break;
        }

        //Beginnning of other specified chronic pain
        elseif($userResponse === "Yes" && $previousQuestion === "Other specified form of chronic pain ?"){
            $response['message'] = "MG30.Y : Other specified chronic pain";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of other specified chronic pain

        //Beginnning of other unspecified chronic pain
        elseif($userResponse === "No" && $previousQuestion === "Other specified form of chronic pain ?"){
            $response['message'] = "MG30.Z : Chronic pain, unspecified";
            $response['buttons'] = ['OK'];
            break;
        }
        //End of other unspecified chronic pain

        //END
        elseif($userResponse === "Yes" && $previousQuestion === "Is all chronic pain explained after that ?"){
            $response['message'] = "End of the algorithm.";
            $response['buttons'] = ['OK'];
            break;
        }
    }
}

// Par défaut, si aucun des cas ci-dessus n'est satisfait
if (empty($response['message'])) {
    $response['message'] = "No chronic pain for the user " . $firstName . " " . $lastName . ".";
    $response['buttons'] = ["OK"];
}

echo json_encode($response);

// Log the output for debugging
error_log("JSON output: " . json_encode($response));

?>
