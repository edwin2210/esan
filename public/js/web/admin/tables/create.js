/***** Tables Create *****/
let TABLES_CREATE_CREATE_FORM = $('#web-admin-tables-create-form');
let TABLES_CREATE_CREATE_ROUTE = $('#inp-route-web-admin-tables-create').val();

$( document ).ready(function() {
    //Link Create
    TABLES_CREATE_CREATE_FORM.submit(function (event) {
        event.preventDefault();
        let data = TABLES_CREATE_CREATE_FORM.serializeArray();
        createTable(data[0].value, data[1].value, data[2].value, data[3].value);
    });
    //Load validators
    setValidator("web-admin-products-create-inp-name", "name");
    setValidator("web-admin-tables-create-inp-capacity", "capacity");
    setValidator("web-admin-products-create-inp-description", "description");
});

function validateCreateTable(name, capacity, description) {
    let result = false;
    let msg = messageFromValidation(validate(name, "product"));
    if (msg.length == 0) {
        msg = messageFromValidation(validate(capacity, "capacity"));
        if (msg.length == 0) {
            msg = messageFromValidation(validate(description, "description"));
            if (msg.length == 0) {
                result = true;
            } else {
                showAlert(0, "La descripción" + msg, 3500);
            }
        } else {
            showAlert(0, "La capacidad" + msg, 3500);
        }
    } else {
        showAlert(0, "El nombre" + msg, 3500);
    }
    return result;
}

function createTable(csrf, name, capacity, description) {
    if (validateCreateTable(name, capacity, description)) {
        var formData = new FormData();
        formData.append('name', name);
        formData.append('capacity', capacity);
        formData.append('description', description);

        $.ajax({
            type: 'post',
            url: TABLES_CREATE_CREATE_ROUTE,
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
                    window.location = $('#inp-route-web-admin-tables-list').val();
                } else {
                    showAlert(0, result.message, 2000);
                }
            }
        });
    }
}
