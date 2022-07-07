/***** Users List *****/
let USERS_LIST_FORM = $('#web-admin-users-list-form');
let USERS_LIST_TABLE = $('#web-admin-users-list-table');
let USERS_LIST_TABLE_COLS = 6;

let USERS_LIST_ROUTE = $("#inp-route-web-admin-users-list").val();
let USERS_VIEW_ROUTE = $("#inp-route-web-admin-users-view").val();

$( document ).ready(function() {
    //Link Filters
    USERS_LIST_FORM.submit(function (event) {
        event.preventDefault();
        let data = USERS_LIST_FORM.serializeArray();
        let d1 = data[1] == null ? '' : data[1];
        let d2 = data[2] == null ? '' : data[2];
        let d3 = data[3] == null ? '' : data[3];
        let d4 = data[4] == null ? '' : data[4];
        getDataUsers(data[0].value, d1, d2, d3, d4);
    });
    //Load users
    USERS_LIST_FORM.submit();
});

function getDataUsers(csrf, filter_names, filter_lastnames, filter_email, filter_role) {
    $.ajax({
        type: 'post',
        url: USERS_LIST_ROUTE,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'filter_names': filter_names,
            'filter_lastnames': filter_lastnames,
            'filter_email': filter_email,
            'filter_role': filter_role
        },
        success: function (result){
            tableBody = "";
            if (result.length == 0) {
                tableBody =
                    "<tr>\n" +
                    "<td class=\"fw-0 fz-sm\" colspan=\"" + USERS_LIST_TABLE_COLS + "\">\n" +
                    "No hay registros\n" +
                    "</td>\n" +
                    "</tr>\n";
            } else {
                for (var i = 0; i < result.length; i++) {
                    tableBody +=
                        "<tr>\n" +
                            "<th scope=\"row\" class=\"fw-2 fz-sm\">\n" +
                                result[i].id + "\n" +
                            "</th>\n" +
                            "<td class=\"fw-0 fz-sm\">\n" +
                                result[i].names + "\n" +
                            "</td>\n" +
                            "<td class=\"fw-0 fz-sm\">\n" +
                                result[i].last_names + "\n" +
                            "</td>\n" +
                            "<td class=\"fw-0 fz-sm\">\n" +
                                result[i].email + "\n" +
                            "</td>\n" +
                            "<td class=\"fw-0 fz-sm\">\n" +
                                result[i].role.name + "\n" +
                            "</td>\n" +
                            "<td class=\"fw-0 fz-sm\"\n>" +
                                "<a href=\"" + USERS_VIEW_ROUTE.replace('FAKE_ID', result[i].id) + "\">" +
                                "<button class=\"ht-btn ht-btn-sm ht-btn-orange\">Ver</button>\n" +
                                "</a>\n" +
                            "</td>\n" +
                        "</tr>\n";
                }
            }
            USERS_LIST_TABLE.html(tableBody);
        }
    });
}
