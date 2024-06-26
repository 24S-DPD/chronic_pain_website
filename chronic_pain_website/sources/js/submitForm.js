'use strict'

//Listen the "validate answer" button
document.getElementById("questions").addEventListener('submit', function(event){
    event.preventDefault();

    //Check if no fields are empty
    var formFields = document.querySelectorAll('#questions input, #questions select, #question textarea');
    var isEmpty = false;
    
    formFields.forEach(function(field) {
        if (!field.value) {
            isEmpty = true;
        }
    });
    
    if (isEmpty) {
        alert("Please fill in all fields.");
        return;
    }

    var pain_begining, pain_intensity, temporal_pattern, distress, interference, pain_location, pain_movement, cancer, cancer_treatment, begin_after_surgery, worse_after_surgery, area_surgery, spread_pain_surgery, brain_nerves_illness, internal_organs, musculoskeletal_pain, headaches;

    function getRadioButtonValue(name) {
        var radios = document.getElementsByName(name);
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                return radios[i].value;
            }
        }
        return null; // Return null if no radio button is checked
    }

    pain_begining = document.getElementById('pain_beginning').value;
    pain_movement = getRadioButtonValue('pain_movement');
    pain_intensity = getRadioButtonValue('pain_intensity');
    distress = getRadioButtonValue('distress');
    interference = getRadioButtonValue('interference');
    temporal_pattern = getRadioButtonValue('temporal_pattern');
    cancer = getRadioButtonValue('cancer');
    cancer_treatment = getRadioButtonValue('cancer_treatment');
    begin_after_surgery = getRadioButtonValue('begin_after_surgery');
    worse_after_surgery = getRadioButtonValue('worse_after_surgery');
    area_surgery = getRadioButtonValue('area_surgery');
    spread_pain_surgery = getRadioButtonValue('spread_pain_surgery');
    brain_nerves_illness = getRadioButtonValue('brain_nerves_illness');
    internal_organs = getRadioButtonValue('internal_organs');
    musculoskeletal_pain = getRadioButtonValue('muskuloskeletal_pain');
    headaches = getRadioButtonValue('headaches');
    pain_location = document.getElementById('painLocations').value;
    var ideas_about_pain = document.getElementById('ideas_about_pain').value;
    var concerns_about_pain = document.getElementById('concerns_about_pain').value;
    var expectations = document.getElementById('expectations').value;
    var closing_thoughts = document.getElementById('closing_thoughts').value;



    //Add each variable of the form in a table
    var formData = new FormData();
    formData.append('pain_begining', pain_begining);
    formData.append('pain_intensity', pain_intensity);
    formData.append('pattern', temporal_pattern);
    formData.append('distress', distress);
    formData.append('interference', interference);
    formData.append('pain_location', pain_location);
    formData.append('cancer', cancer);
    formData.append('cancer_treatment', cancer_treatment);
    formData.append('begin_after_surgery', begin_after_surgery);
    formData.append('worse_after_surgery', worse_after_surgery);
    formData.append('area_surgery', area_surgery);
    formData.append('spread_pain_surgery', spread_pain_surgery);
    formData.append('brain_nerves_illness', brain_nerves_illness);
    formData.append('internal_organs', internal_organs);
    formData.append('musculoskeletal_pain', musculoskeletal_pain);
    formData.append('headaches', headaches);
    formData.append('ideas_about_pain', ideas_about_pain);
    formData.append('concerns_about_pain', concerns_about_pain);
    formData.append('expectations', expectations);
    formData.append('closing_thoughts', closing_thoughts);


    //Send the form with an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'sources/php/submitForm.php', true);

    xhr.onload = function(){
        if (xhr.status === 200){
            console.log(xhr.responseText);
            window.location.href = "patient_recap.html";
        } else {
            console.error("Error occured during the request");
        }
    };
    xhr.send(formData);
})

