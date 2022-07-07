/***** Users View *****/
let USERS_VIEW_ID = $('#web-admin-users-view-id').val();
let USERS_VIEW_DELETE = $('#web-admin-users-view-delete');
let USERS_VIEW_DELETE_ROUTE = $('#inp-route-web-admin-users-delete').val();

$( document ).ready(function() {
    //Link delete action
    USERS_VIEW_DELETE.on('click', function () {
        $("#web-modal-message").html('¿Estás seguro de eliminar este usuario?');
        $("#web-modal-btn").html('Eliminar');
        $("#web-modal-btn").attr('onclick', 'deleteUser()');
        $("#web-modal").modal('show');
    });
});

function deleteUser() {
    $("#web-modal").modal('hide');
    $.ajax({
        type: 'post',
        url: USERS_VIEW_DELETE_ROUTE,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': USERS_VIEW_ID
        },
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
