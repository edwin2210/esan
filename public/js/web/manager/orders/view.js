/***** Orders View *****/
let ORDERS_VIEW_ID = $('#web-manager-orders-view-id').val();
let ORDERS_VIEW_DELETE = $('#web-manager-orders-view-delete');
let ORDERS_VIEW_COLLECT = $('#web-manager-orders-view-collect');
let ORDERS_VIEW_DELETE_ROUTE = $('#inp-route-web-manager-orders-delete').val();
let ORDERS_VIEW_COLLECT_ROUTE = $('#inp-route-web-manager-orders-collect').val();

$( document ).ready(function() {
    //Link delete action
    ORDERS_VIEW_DELETE.on('click', function () {
        $("#web-modal-message").html('¿Estás seguro de eliminar esta orden?');
        $("#web-modal-btn").html('Eliminar');
        $("#web-modal-btn").attr('onclick', 'deleteOrder()');
        $("#web-modal").modal('show');
    });
    //Link pay action
    ORDERS_VIEW_COLLECT.on('click', function () {
        $("#web-modal-message").html('¿Estás seguro de cobrar esta orden?');
        $("#web-modal-btn").html('Cobrar');
        $("#web-modal-btn").attr('onclick', 'collectOrder()');
        $("#web-modal").modal('show');
    });
});

function deleteOrder() {
    $("#web-modal").modal('hide');
    $.ajax({
        type: 'post',
        url: ORDERS_VIEW_DELETE_ROUTE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': ORDERS_VIEW_ID
        },
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

function collectOrder() {
    $("#web-modal").modal('hide');
    $.ajax({
        type: 'post',
        url: ORDERS_VIEW_COLLECT_ROUTE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': ORDERS_VIEW_ID
        },
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
