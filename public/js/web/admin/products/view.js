/***** Products View *****/
let PRODUCTS_VIEW_ID = $('#web-admin-products-view-id').val();
let PRODUCTS_VIEW_DELETE = $('#web-admin-products-view-delete');
let PRODUCTS_VIEW_DELETE_ROUTE = $('#inp-route-web-admin-products-delete').val();

$( document ).ready(function() {
    //Link delete action
    PRODUCTS_VIEW_DELETE.on('click', function () {
        $("#web-modal-message").html('¿Estás seguro de eliminar este producto?');
        $("#web-modal-btn").html('Eliminar');
        $("#web-modal-btn").attr('onclick', 'deleteProduct()');
        $("#web-modal").modal('show');
    });
});

function deleteProduct() {
    $("#web-modal").modal('hide');
    $.ajax({
        type: 'post',
        url: PRODUCTS_VIEW_DELETE_ROUTE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': PRODUCTS_VIEW_ID
        },
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
