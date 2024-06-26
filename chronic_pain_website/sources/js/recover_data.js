'use strict';

document.addEventListener("DOMContentLoaded", function() {
    // AJAX request to fetch data from the database
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "sources/php/user_information_for_patient.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);

            if (data.error) {
                console.error("Error:", data.error);
                document.getElementById("user-info").innerHTML = "Error fetching user data: " + data.error;
                return;
            }

            if (data.length > 0) {
                displayUserInfo(data[0]); // Display user info from the first record
                displayResults(data);     // Display all records
                setupDownloadButton(data[0]); // Setup download button with user data
            } else {
                document.getElementById("user-info").innerHTML = "No user data found.";
                document.getElementById("form_answer").innerHTML = "No results found.";
            }
        }
    };
    xhr.send();
});

function displayUserInfo(user) {
    var userInfoDiv = document.getElementById("user-info");
    if (user) {
        var userInfoHtml = "<h2>User Information</h2>";
        userInfoHtml += "<p><strong>First Name:</strong> " + user.first_name + "</p>";
        userInfoHtml += "<p><strong>Last Name:</strong> " + user.last_name + "</p>";
        userInfoHtml += "<p><strong>Email:</strong> " + user.email + "</p>";
        userInfoHtml += "<p><strong>Phone Number:</strong> " + user.phone_number + "</p>";
        userInfoDiv.innerHTML = userInfoHtml;
    } else {
        userInfoDiv.innerHTML = "User information not found.";
    }
}

function displayResults(data) {
    var resultsDiv = document.getElementById("form_answer");
    if (data && data.length > 0) {
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
        
    } else {
        resultsDiv.innerHTML = "No results found.";
    }
}

function setupDownloadButton(user) {
    document.getElementById("download-pdf").addEventListener("click", function() {
        downloadPDF(user);
    });
}

function downloadPDF(user) {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF();

    const userInfo = document.getElementById("user-info").innerText;
    const formAnswer = document.getElementById("form_answer").innerText;

    const userInfoLines = pdf.splitTextToSize(userInfo, 180);
    const formAnswerLines = pdf.splitTextToSize(formAnswer, 180);

    let y = 10; // Start at top
    userInfoLines.forEach(line => {
        if (y > 280) { // If exceeds page, add new page
            pdf.addPage();
            y = 10;
        }
        pdf.text(10, y, line);
        y += 10;
    });

    formAnswerLines.forEach(line => {
        if (y > 280) { // If exceeds page, add new page
            pdf.addPage();
            y = 10;
        }
        pdf.text(10, y, line);
        y += 10;
    });

    // Construct the filename
    const filename = `patient_recap_${user.first_name}_${user.last_name}.pdf`;
    pdf.save(filename);
}
