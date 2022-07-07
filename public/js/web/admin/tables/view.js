/***** Tables View *****/
let TABLES_VIEW_ID = $('#web-admin-tables-view-id').val();
let TABLES_VIEW_DELETE = $('#web-admin-tables-view-delete');
let TABLES_VIEW_DELETE_ROUTE = $('#inp-route-web-admin-tables-delete').val();

$( document ).ready(function() {
    //Link delete action
    TABLES_VIEW_DELETE.on('click', function () {
        $("#web-modal-message").html('¿Estás seguro de eliminar esta mesa?');
        $("#web-modal-btn").html('Eliminar');
        $("#web-modal-btn").attr('onclick', 'deleteTable()');
        $("#web-modal").modal('show');
    });
});

function deleteTable() {
    $("#web-modal").modal('hide');
    $.ajax({
        type: 'post',
        url: TABLES_VIEW_DELETE_ROUTE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': TABLES_VIEW_ID
        },
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
