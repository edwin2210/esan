/***** Orders List *****/
let ORDERS_W_LIST_FORM = $('#web-waiter-orders-list-form');
let ORDERS_W_LIST_TABLE = $('#web-waiter-orders-list-table');
let ORDERS_W_LIST_TABLE_COLS = 5;

let ORDERS_W_LIST_ROUTE = $("#inp-route-web-waiter-orders-list").val();
let ORDERS_W_VIEW_ROUTE = $("#inp-route-web-waiter-orders-view").val();

$( document ).ready(function() {
    //Link Filters
    ORDERS_W_LIST_FORM.submit(function (event) {
        event.preventDefault();
        let data = ORDERS_W_LIST_FORM.serializeArray();
        let d1 = data[1] == null ? '' : data[1];
        let d2 = data[2] == null ? '' : data[2];
        let d3 = data[3] == null ? '' : data[3];
        let d4 = data[4] == null ? '' : data[4];
        getDataWOrders(data[0].value, d1, d2, d3, d4);
    });
    //Load orders
    ORDERS_W_LIST_FORM.submit();
});

function getDataWOrders(csrf, filter_date, filter_table, filter_waiter, filter_completed) {
    $.ajax({
        type: 'post',
        url: ORDERS_W_LIST_ROUTE,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'filter_date': filter_date,
            'filter_table': filter_table,
            'filter_waiter': filter_waiter,
            'filter_completed': filter_completed
        },
        success: function (result){
            tableBody = "";
            if (result.length == 0) {
                tableBody =
                    "<tr>\n" +
                    "<td class=\"fw-0 fz-sm\" colspan=\"" + ORDERS_W_LIST_TABLE_COLS + "\">\n" +
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
                        result[i].created_at + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\">\n" +
                        result[i].table.name + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\">\n" +
                        result[i].creator.names + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\">\n" +
                        (result[i].received_date ? 'Si' : 'No') + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\"\n>" +
                        "<a href=\"" + ORDERS_W_VIEW_ROUTE.replace('FAKE_ID', result[i].id) + "\">" +
                        "<button class=\"ht-btn ht-btn-sm ht-btn-orange\">Ver</button>\n" +
                        "</a>\n" +
                        "</td>\n" +
                        "</tr>\n";
                }
            }
            ORDERS_W_LIST_TABLE.html(tableBody);
        }
    });
}
