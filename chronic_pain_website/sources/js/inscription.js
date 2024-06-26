'use strict'

function printUserRole(){
    ajaxRequest("GET", "sources/php/database.php", function(response){
        var select = document.getElementById("user_role");
        const data = JSON.parse(response);
        const descriptionUserRole = data.userRole.map(item => ({id: item.ID, value: item.user_role}));

        descriptionUserRole.forEach(function(item) {
            var id = item.id;
            var value = item.value;

            var option = document.createElement('option');
            option.text = value;
            option.value = parseInt(id);
            select.add(option);
        });
    })
}

printUserRole();