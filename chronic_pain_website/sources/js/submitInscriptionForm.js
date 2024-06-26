'use strict';

// Listen for the form submission event
document.getElementById("account_creation_form").addEventListener('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting normally

    // Retrieve values from form fields
    var firstName = document.querySelector('input[name="first_name"]').value;
    var lastName = document.querySelector('input[name="last_name"]').value;
    var birthday = document.querySelector('input[name="birthday"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var password = document.querySelector('input[name="password"]').value;
    var userRole = document.querySelector('select[name="user_role"]').value;

    // Create a FormData object to store form data
    var formData = new FormData();
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('birthday', birthday);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('user_role', userRole);

    // Send form data via AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'sources/php/submitInscriptionForm.php', true);
    xhr.onload = function(){
        if (xhr.status === 200){
            console.log(xhr.responseText); // Log server response to console
            var response = xhr.responseText;
            if (response === "success"){
                window.location.href = "login.html"
            }
            else{
                var errorMessage = document.getElementById("error_inscription");
                errorMessage.textContent = "This account already exists.";
                errorMessage.style.color = "red";
            }
        } else {
            console.error("An error occurred during the request"); // Log error in case of request failure
        }
    };
    xhr.send(formData); // Send form data
});
