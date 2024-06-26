document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var popUp = document.getElementById("popUp");
    var btn = document.getElementById("continue_button");
    var span = document.getElementsByClassName("close")[0];
    var message = document.getElementById("popup_message");
    var buttonsContainer = document.getElementById("buttons_container");

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    var firstName = getUrlParameter('first_name');
    var lastName = getUrlParameter('last_name');

    function fetchQuestion(response = '', previousQuestion = '') {
        let url = `sources/php/pain_decision_tree/initial_decision_trunk.php?first_name=${encodeURIComponent(firstName)}&last_name=${encodeURIComponent(lastName)}`;
        if (response) {
            url += `&response=${response}`;
        }
        if (previousQuestion) {
            url += `&previous_question=${encodeURIComponent(previousQuestion)}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Update the modal content
                message.textContent = data.message;

                // Clear existing buttons
                while (buttonsContainer.firstChild) {
                    buttonsContainer.removeChild(buttonsContainer.firstChild);
                }

                // Create and append new buttons
                data.buttons.forEach(buttonText => {
                    var button = document.createElement("button");
                    button.textContent = buttonText;
                    button.classList.add(buttonText.toLowerCase() + '_button');
                    button.onclick = function() {
                        popUp.style.display = "none";
                        console.log(buttonText);
                        console.log(message.textContent);
                        if (buttonText === 'Yes' || buttonText === 'No') {
                            fetchQuestion(buttonText, message.textContent);
                        } else if (buttonText === 'OK' && (message.textContent === "No chronic pain for the user" || message.textContent === "MG30.10 Chronic visceral cancer pain (ID : 925682659)" || message.textContent === "MG30.10 : Chronic cancer pain, other specified" || message.textContent === "MG30.10 Chronic cancer pain, other specified" || message.textContent === "MG30.10 Chronic neuropathic cancer pain (ID 1480100314), probable" || message.textContent === "MG30.10 Chronic neuropathic cancer pain (ID 1480100314), definite" || message.textContent === "MG30.Z : Chronic pain, unspecified" || message.textContent === "MG30.Y : Other specified chronic pain" || message.textContent === "MG30.11 Chronic post cancer medicine pain (ID 1065928586)" || message.textContent === "MG30.11 Chronic post cancer treatment pain, other specified" || message.textContent === "MG30.11 Chronic post radiotherapy pain (ID 1727344827)" || message.textContent === "MG30.01 Chronic widespread pain" || message.textContent === "MG30.01 Fibromyaglia syndrome (ID 236601102)" || message.textContent === "End of the algorithm."/*to complete || message.textContent === ""*/)) {
                            alert("End of the CAL-CP algorithm");
                        }
                        else{
                            fetchQuestion(buttonText, message.textContent);
                        }
                    };
                    buttonsContainer.appendChild(button);
                });

                // Show the modal
                popUp.style.display = "block";
            })
            .catch(error => console.error('Error:', error));
    }

    // Initial fetch to start the decision tree
    btn.onclick = function() {
        fetchQuestion();
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        popUp.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == popUp) {
            popUp.style.display = "none";
        }
    };
});
