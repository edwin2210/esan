/***** Tables Edit *****/
let TABLES_EDIT_EDIT_FORM = $('#web-admin-tables-edit-form');
let TABLES_EDIT_EDIT_ROUTE = $('#inp-route-web-admin-tables-edit').val();

$( document ).ready(function() {
    //Link Create
    TABLES_EDIT_EDIT_FORM.submit(function (event) {
        event.preventDefault();
        let data = TABLES_EDIT_EDIT_FORM.serializeArray();
        editTable(data[0].value, data[1].value, data[2].value, data[3].value, data[4].value);
    });
    //Load validators
    setValidator("web-admin-tables-edit-inp-name", "table");
    setValidator("web-admin-tables-edit-inp-price", "capacity");
    setValidator("web-admin-tables-edit-inp-description", "description");
});

function validateEditTable(name, capacity, description) {
    let result = false;
    let msg = messageFromValidation(validate(name, "table"));
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

function editTable(csrf, id, name, capacity, description) {
    if (validateEditTable(name, capacity, description)) {
        var formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('capacity', capacity);
        formData.append('description', description);

        $.ajax({
            type: 'post',
            url: TABLES_EDIT_EDIT_ROUTE,
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
