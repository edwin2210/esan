/***** Products Edit *****/
let PRODUCTS_EDIT_EDIT_FORM = $('#web-admin-products-edit-form');
let PRODUCTS_EDIT_EDIT_ROUTE = $('#inp-route-web-admin-products-edit').val();

$( document ).ready(function() {
    //Link Create
    PRODUCTS_EDIT_EDIT_FORM.submit(function (event) {
        event.preventDefault();
        let data = PRODUCTS_EDIT_EDIT_FORM.serializeArray();
        editProduct(data[0].value, data[1].value, data[2].value, data[3].value, data[4].value);
    });
    //Load validators
    setValidator("web-admin-products-edit-inp-name", "product");
    setValidator("web-admin-products-edit-inp-price", "price");
    setValidator("web-admin-products-edit-inp-description", "description");
});

function validateEditProduct(name, price, description) {
    let result = false;
    let msg = messageFromValidation(validate(name, "product"));
    if (msg.length == 0) {
        msg = messageFromValidation(validate(price, "price"));
        if (msg.length == 0) {
            msg = messageFromValidation(validate(description, "description"));
            if (msg.length == 0) {
                result = true;
            } else {
                showAlert(0, "La descripción" + msg, 3500);
            }
        } else {
            showAlert(0, "El precio" + msg, 3500);
        }
    } else {
        showAlert(0, "El nombre" + msg, 3500);
    }
    return result;
}

function editProduct(csrf, id, name, price, description) {
    if (validateEditProduct(name, price, description)) {
        var formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('price', price);
        formData.append('description', description);

        $.ajax({
            type: 'post',
            url: PRODUCTS_EDIT_EDIT_ROUTE,
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
                    window.location = $('#inp-route-web-admin-products-list').val();
                } else {
                    showAlert(0, result.message, 2000);
                }
            }
        });
    }
}
