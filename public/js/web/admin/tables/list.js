/***** Tables List *****/
let TABLES_LIST_FORM = $('#web-admin-tables-list-form');
let TABLES_LIST_TABLE = $('#web-admin-tables-list-table');
let TABLES_LIST_TABLE_COLS = 4;

let TABLES_LIST_ROUTE = $("#inp-route-web-admin-tables-list").val();
let TABLES_VIEW_ROUTE = $("#inp-route-web-admin-tables-view").val();

$( document ).ready(function() {
    //Link Filters
    TABLES_LIST_FORM.submit(function (event) {
        event.preventDefault();
        let data = TABLES_LIST_FORM.serializeArray();
        let d1 = data[1] == null ? '' : data[1];
        let d2 = data[2] == null ? '' : data[2];
        getDataTables(data[0].value, d1, d2);
    });
    //Load tables
    TABLES_LIST_FORM.submit();
});

function getDataTables(csrf, filter_name, filter_capacity) {
    $.ajax({
        type: 'post',
        url: TABLES_LIST_ROUTE,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'filter_name': filter_name,
            'filter_capacity': filter_capacity
        },
        success: function (result){
            tableBody = "";
            if (result.length == 0) {
                tableBody =
                    "<tr>\n" +
                    "<td class=\"fw-0 fz-sm\" colspan=\"" + PRODUCTS_LIST_TABLE_COLS + "\">\n" +
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
                        result[i].name + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\">\n" +
                        result[i].capacity + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\"\n>" +
                        "<a href=\"" + TABLES_VIEW_ROUTE.replace('FAKE_ID', result[i].id) + "\">" +
                        "<button class=\"ht-btn ht-btn-sm ht-btn-orange\">Ver</button>\n" +
                        "</a>\n" +
                        "</td>\n" +
                        "</tr>\n";
                }
            }
            TABLES_LIST_TABLE.html(tableBody);
        }
    });
}
