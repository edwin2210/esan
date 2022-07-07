/***** Products Create *****/
let PRODUCTS_CREATE_CREATE_FORM = $('#web-admin-products-create-form');
let PRODUCTS_CREATE_CREATE_ROUTE = $('#inp-route-web-admin-products-create').val();

$( document ).ready(function() {
    //Link Create
    PRODUCTS_CREATE_CREATE_FORM.submit(function (event) {
        event.preventDefault();
        let data = PRODUCTS_CREATE_CREATE_FORM.serializeArray();
        createProduct(data[0].value, data[1].value, data[2].value, data[3].value);
    });
    //Load validators
    setValidator("web-admin-products-create-inp-name", "name");
    setValidator("web-admin-products-create-inp-price", "price");
    setValidator("web-admin-products-create-inp-description", "description");
});

function validateCreateProduct(name, price, description) {
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

function createProduct(csrf, name, price, description) {
    if (validateCreateProduct(name, price, description)) {
        var formData = new FormData();
        formData.append('name', name);
        formData.append('price', price);
        formData.append('description', description);

        $.ajax({
            type: 'post',
            url: PRODUCTS_CREATE_CREATE_ROUTE,
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
