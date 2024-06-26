'use strict';

document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const firstName = urlParams.get('first_name');
    const lastName = urlParams.get('last_name');

    if (!firstName || !lastName) {
        console.error("Missing parameters");
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", `sources/php/user_information_for_physician.php?first_name=${encodeURIComponent(firstName)}&last_name=${encodeURIComponent(lastName)}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            if (data.length > 0) {
                displayResults(data[0], data);     // Display all records
            } else {
                document.getElementById("form_answer").innerHTML = "No results found.";
            }
        }
    };
    xhr.send();
});

function displayResults(user, data) {
    var patientName = document.getElementById("patient_name");
    console.log(patientName);
    patientName.textContent = "Answers of " + user.first_name + ' ' + user.last_name;
    var resultsDiv = document.getElementById("form_answer");
    if (data && data.length > 0) {
        for (var i = 0; i < data.length; i++) {
            var resultHtml = "<div class='form_answer'>";
        for (var i = 0; i < data.length; i++) {
            resultHtml += "<p><strong>Pain location " + (i + 1) + " : </strong>" + data[i].ID_vertebrae + " - " + data[i].ID_pain_location + "</p>";
        }
        resultHtml += "<p><strong>Pain Intensity:</strong> " + data[0].pain_intensity + "</p>";
        resultHtml += "<p><strong>Pain-Related Distress:</strong> " + data[0].pain_related_distress + "</p>";
        resultHtml += "<p><strong>Pain-Related Interference:</strong> " + data[0].pain_related_interference + "</p>";
        resultHtml += "<p><strong>Pain Beginning:</strong> " + data[0].ID_pain_beginning + "</p>";
        resultHtml += "<p><strong>Temporal Pattern:</strong> " + data[0].ID_temporal_pattern + "</p>";
        resultHtml += "<p><strong>Cancer:</strong> " + data[0].cancer + "</p>";
        resultHtml += "<p><strong>Cancer Treatment:</strong> " + data[0].cancer_treatment + "</p>";
        resultHtml += "<p><strong>Begin After Surgery:</strong> " + data[0].begin_after_surgery + "</p>";
        resultHtml += "<p><strong>Worse After Surgery:</strong> " + data[0].worse_after_surgery + "</p>";
        resultHtml += "<p><strong>Spread of Pain:</strong> " + data[0].spread_of_pain + "</p>";
        resultHtml += "<p><strong>Area of Surgery:</strong> " + data[0].area_of_surgery + "</p>";
        resultHtml += "<p><strong>Brain/Nerves Illness:</strong> " + data[0].brain_nerves_illness + "</p>";
        resultHtml += "<p><strong>Internal Organs Issues:</strong> " + data[0].internal_organs_issues + "</p>";
        resultHtml += "<p><strong>Musculoskeletal Pain:</strong> " + data[0].musculoskeletal_pain + "</p>";
        resultHtml += "<p><strong>Headaches/Pain in Face:</strong> " + data[0].headaches_pain_face + "</p>";
        resultHtml += "<p><strong>Ideas About Pain:</strong> " + data[0].ideas_about_pain + "</p>";
        resultHtml += "<p><strong>Concerns About Pain:</strong> " + data[0].concerns_about_pain + "</p>";
        resultHtml += "<p><strong>Expectations:</strong> " + data[0].expectations + "</p>";
        resultHtml += "<p><strong>Closing Thoughts:</strong> " + data[0].closing_thoughts + "</p>";
        resultHtml += "</div>";
        resultsDiv.innerHTML += resultHtml;
        }
    } else {
        resultsDiv.innerHTML = "No results found.";
    }
    
}
