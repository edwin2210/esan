/***** Login Form *****/
let LOGIN_FORM = $('#web-public-login-form');
let LOGIN_FORM_ROUTE = $("#inp-route-web-public-login-in").val();

$( document ).ready(function() {
    //Link Form
    LOGIN_FORM.submit(function (event) {
        event.preventDefault();
        let data = LOGIN_FORM.serializeArray();
        let email = data[1].value;
        let password = data[2].value;
        //Validate email & password
        if (email.length >= 8 && email.includes("@")) {
            if (password.length >= 8) {
                $.ajax({
                    type: 'post',
                    url: LOGIN_FORM_ROUTE,
                    headers: {
                        'X-CSRF-TOKEN': data[0].value
                    },
                    data: {
                        'email': email,
                        'password': password
                    },
                    success: function (result){
                        result = JSON.parse(result);
                        if (result.success == true) { //Redirect to /home
                            window.location = result.route;
                        } else { //Credentials incorrect
                            showAlert(0, result.message, 2000);
                        }
                    }
                });
            } else {
                showAlert(0, "Error. La contraseña debe tener al menos 8 caracteres", 1500);
            }
        } else {
            showAlert(0, "Error. El correo electrónico es inválido", 1500);
        }
    });
});
