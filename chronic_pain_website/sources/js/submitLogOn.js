'use strict';

// Listen for the form submission event
document.getElementById("login_form").addEventListener('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting normally

    // Retrieve values from form fields
    var firstName = document.querySelector('input[name="first_name"]').value;
    var lastName = document.querySelector('input[name="last_name"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var password = document.querySelector('input[name="password"]').value;

    // Create a FormData object to store form data
    var formData = new FormData();
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('email', email);
    formData.append('password', password);

    // Send form data via AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'sources/php/submitLogOn.php', true);
    xhr.onload = function(){
        if (xhr.status === 200){
            try {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                if (response.status === "success"){
                    sessionStorage.setItem('loggedin', 'true');
                    var welcomeMessage = "Welcome " + firstName + " " + lastName + "!";
                    alert(welcomeMessage);

                    if (response.user_role === 0){
                        window.location.href = "formulaire.html";
                    }
                    else if (response.user_role === 1){
                        window.location.href = "physician_page.html";
                    }
                } else {
                    var errorMessage = document.getElementById("error_message");
                    errorMessage.textContent = "Identifiant or password wrong. Please try again";
                    errorMessage.style.color = "red";
                }
            } catch (e) {
                console.error("An error occurred during JSON parsing: ", e);
                var errorMessage = document.getElementById("error_message");
                errorMessage.textContent = "An unexpected error occurred. Please try again.";
                errorMessage.style.color = "red";
            }
        } else {
            console.error("An error occurred during the request"); // Log error in case of request failure
        }
    };
    xhr.send(formData); // Send form data
});
