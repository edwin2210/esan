/***** Users Edit *****/
let USERS_EDIT_EDIT_FORM = $('#web-admin-users-edit-form');
let USERS_EDIT_EDIT_ROUTE = $('#inp-route-web-admin-users-edit').val();

$( document ).ready(function() {
    //Link Create
    USERS_EDIT_EDIT_FORM.submit(function (event) {
        event.preventDefault();
        let data = USERS_EDIT_EDIT_FORM.serializeArray();
        editUser(data[0].value, data[1].value, data[2].value, data[3].value, data[4].value, data[5].value);
    });
    //Load validators
    setValidator("web-admin-users-edit-inp-names", "names");
    setValidator("web-admin-users-edit-inp-lastnames", "lastnames");
    setValidator("web-admin-users-edit-inp-email", "email");
});

function validateEditUser(names, last_names, email) {
    let result = false;
    let msg = messageFromValidation(validate(names, "names"));
    if (msg.length == 0) {
        msg = messageFromValidation(validate(last_names, "lastnames"));
        if (msg.length == 0) {
            msg = messageFromValidation(validate(email, "email"));
            if (msg.length == 0) {
                result = true;
            } else {
                showAlert(0, "El correo electrónico" + msg, 3500);
            }
        } else {
            showAlert(0, "Los apellidos" + msg, 3500);
        }
    } else {
        showAlert(0, "Los nombres" + msg, 3500);
    }
    return result;
}

function editUser(csrf, id, names, last_names, email, role) {
    if (validateEditUser(names, last_names, email)) {
        var formData = new FormData();
        formData.append('id', id);
        formData.append('names', names);
        formData.append('last_names', last_names);
        formData.append('email', email);
        formData.append('role', role);

        $.ajax({
            type: 'post',
            url: USERS_EDIT_EDIT_ROUTE,
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function (result){
                result = JSON.parse(result);
                if (result.success == true) {
                    showAlert(1, result.message, 2000);
                    window.location = $('#inp-route-web-admin-users-list').val();
                } else {
                    showAlert(0, result.message, 2000);
                }
            }
        });
    }
}
