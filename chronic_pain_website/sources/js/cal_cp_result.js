'use strict';

document.addEventListener("DOMContentLoaded", function() {
    // AJAX request to fetch data from initial_decision_trunk.php
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "sources/php/pain_decision_tree/initial_decision_trunk.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var responseText = xhr.responseText.trim();
                var results = JSON.parse(responseText);
                displayResults(results);
            } catch (e) {
                console.error("Error parsing JSON: ", e);
                console.error("Response Text: ", responseText);
            }
        }
    };
    xhr.send();
});

function displayResults(results) {
    var resultsDiv = document.getElementById("calcp-results");
    resultsDiv.innerHTML = ''; // Clear previous results
    if (results && results.length > 0) {
        results.forEach(function(result) {
            var resultHtml = "<p>" + result + "</p>";
            resultsDiv.innerHTML += resultHtml;
        });
    } else {
        resultsDiv.innerHTML = "<p>No results found.</p>";
    }
}
