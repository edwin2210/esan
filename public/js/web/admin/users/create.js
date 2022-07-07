/***** Users Create *****/
let USERS_CREATE_CREATE_FORM = $('#web-admin-users-create-form');
let USERS_CREATE_CREATE_ROUTE = $('#inp-route-web-admin-users-create').val();

$( document ).ready(function() {
    //Link Create
    USERS_CREATE_CREATE_FORM.submit(function (event) {
        event.preventDefault();
        let data = USERS_CREATE_CREATE_FORM.serializeArray();
        createUser(data[0].value, data[1].value, data[2].value, data[3].value, data[4].value, data[5].value, data[6].value);
    });
    //Load validators
    setValidator("web-admin-users-create-inp-names", "names");
    setValidator("web-admin-users-create-inp-lastnames", "lastnames");
    setValidator("web-admin-users-create-inp-email", "email");
    setValidator("web-admin-users-create-inp-passwd1", "password");
    setValidator("web-admin-users-create-inp-passwd2", "password");
});

function validateCreateUser(names, last_names, email, password1, password2) {
    let result = false;
    let msg = messageFromValidation(validate(names, "names"));
    if (msg.length == 0) {
        msg = messageFromValidation(validate(last_names, "lastnames"));
        if (msg.length == 0) {
            msg = messageFromValidation(validate(email, "email"));
            if (msg.length == 0) {
                msg = messageFromValidation(validate(password1, "password"));
                if (msg.length == 0) {
                    msg = messageFromValidation(validate(password2, "password"));
                    if (msg.length == 0) {
                        if (password1 == password2) {
                            result = true;
                        } else {
                            showAlert(0, "Las contraseñas no son iguales", 3500);
                        }
                    } else {
                        showAlert(0, "Las confirm. de la contraseña" + msg, 3500);
                    }
                } else {
                    showAlert(0, "La contraseña" + msg, 3500);
                }
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

function createUser(csrf, names, last_names, email, password1, password2, role) {
    if (validateCreateUser(names, last_names, email, password1, password2)) {
        var formData = new FormData();
        formData.append('names', names);
        formData.append('last_names', last_names);
        formData.append('email', email);
        formData.append('password', password1);
        formData.append('role', role);

        $.ajax({
            type: 'post',
            url: USERS_CREATE_CREATE_ROUTE,
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
