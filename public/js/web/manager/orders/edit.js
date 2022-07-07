/***** Orders Edit *****/
let ORDERS_EDIT_EDIT_FORM = $('#web-manager-orders-edit-form');
let ORDERS_EDIT_EDIT_ROUTE = $('#inp-route-web-manager-orders-edit').val();

$( document ).ready(function() {
    //Link Create
    ORDERS_EDIT_EDIT_FORM.submit(function (event) {
        event.preventDefault();
        let data = ORDERS_EDIT_EDIT_FORM.serializeArray();

        let products = getOrder('edit-order');
        editOrder(data[0].value, data[1].value, data[2].value, data[3].value, products);
    });
});

function validateEditOrder(waiter_id, table_id, products) {
    let result = false;
    if (waiter_id && waiter_id > 0) {
        if (table_id && table_id > 0) {
            if (products.length > 0) {
                result = true;
            } else {
                showAlert(0, "Se require al menos 1 producto", 3500);
            }
        } else {
            showAlert(0, "La mesa es un campo inválido", 3500);
        }
    } else {
        showAlert(0, "El mesero es un campo inválido", 3500);
    }
    return result;
}

function editOrder(csrf, id, waiter_id, table_id, products) {
    if (validateEditOrder(waiter_id, table_id, products)) {
        var formData = new FormData();
        formData.append('id', id);
        formData.append('id_waiter', waiter_id);
        formData.append('id_table', table_id);
        formData.append('products', products);

        $.ajax({
            type: 'post',
            url: ORDERS_EDIT_EDIT_ROUTE,
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
                    window.location = $('#inp-route-web-manager-orders-list').val();
                } else {
                    showAlert(0, result.message, 2000);
                }
            }
        });
    }
}

