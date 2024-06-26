<?php
require_once('../../recover_data.php');

foreach ($dataTable as $data) {
    //Count the number of body regions impact by the pain
    if ($data['pain_location'] > 4) {
        echo "The CAL-CP algorithm predict a chronic widespread pain "
        if ($data['sleep_disorders'] == "Yes" && $data['somatic symptoms'] == "Yes" && $data['cognitive_disfunction'] == "Yes") {
            echo "The CAL-CP algorithm predict a Fibromyalgia syndrome (ID 236601102"
        }
    } /*elseif (Regional pain in limb initiated by nerve lesion or tissue trauma) {
            ...
            Can not implement that for the moment}*/
    elseif($data['musculoskeletal_pain']=="Yes"){
        //Diriger vers chronic primary musculoskeletal pain
    }

    elseif($data["headaches_pain_face"]=="Yes"){
        echo "Please refer to the ICHD-3/ICOP and the ICD-11 Coding Tool : https://icd.who.int/ct/icd11_mms/en/release"
    }

    elseif($data["internal_organs_issues"] == "Yes"){
        //Diriger vers chronic primary visceral pain
    }

    /*Clinician side
    elseif($data[] == "Yes"){
        //Diriger vers other_specified_chronic_primary_pain
    }*/
}
?>