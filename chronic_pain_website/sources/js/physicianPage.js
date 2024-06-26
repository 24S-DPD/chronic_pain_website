'use strict';

document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch patient names and populate the list
    function fetchPatients() {
        ajaxRequest("GET", "sources/php/physicianPage.php", function(response) {
            var div = document.getElementById("patient_list");
            const data = JSON.parse(response);

            if (data.status === 'success') {
                const patients = data.patients;
                patients.forEach(function(patient) {
                    var listItem = document.createElement('li');
                    
                    // Create a link element
                    var link = document.createElement('a');
                    link.href = `patient_answers.html?first_name=${encodeURIComponent(patient.first_name)}&last_name=${encodeURIComponent(patient.last_name)}`;
                    link.textContent = `${patient.first_name} ${patient.last_name}`;
                    
                    // Append the link to the list item
                    listItem.appendChild(link);
                    div.appendChild(listItem);
                });
            } else {
                console.error('Failed to fetch patient data:', data.message);
            }
        });
    }

    // Function to filter the patient list based on search input
    function filterPatients() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const patientListItems = document.querySelectorAll('#patient_list li');
        patientListItems.forEach(item => {
            const patientName = item.textContent.toLowerCase();
            if (patientName.includes(searchInput)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Fetch patients when the page loads
    fetchPatients();

    // Add event listener to search input
    document.getElementById('search').addEventListener('input', filterPatients);
});

function ajaxRequest(method, url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            callback(xhr.responseText);
        } else {
            console.error('The request failed!');
        }
    };
    xhr.send();
}
