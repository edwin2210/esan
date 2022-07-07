/***** Products List *****/
let PRODUCTS_LIST_FORM = $('#web-admin-products-list-form');
let PRODUCTS_LIST_TABLE = $('#web-admin-products-list-table');
let PRODUCTS_LIST_TABLE_COLS = 4;

let PRODUCTS_LIST_ROUTE = $("#inp-route-web-admin-products-list").val();
let PRODUCTS_VIEW_ROUTE = $("#inp-route-web-admin-products-view").val();

$( document ).ready(function() {
    //Link Filters
    PRODUCTS_LIST_FORM.submit(function (event) {
        event.preventDefault();
        let data = PRODUCTS_LIST_FORM.serializeArray();
        let d1 = data[1] == null ? '' : data[1];
        let d2 = data[2] == null ? '' : data[2];
        getDataProducts(data[0].value, d1, d2);
    });
    //Load products
    PRODUCTS_LIST_FORM.submit();
});

function getDataProducts(csrf, filter_name, filter_price) {
    $.ajax({
        type: 'post',
        url: PRODUCTS_LIST_ROUTE,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'filter_name': filter_name,
            'filter_price': filter_price
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
                        "$" + result[i].price + "\n" +
                        "</td>\n" +
                        "<td class=\"fw-0 fz-sm\"\n>" +
                        "<a href=\"" + PRODUCTS_VIEW_ROUTE.replace('FAKE_ID', result[i].id) + "\">" +
                        "<button class=\"ht-btn ht-btn-sm ht-btn-orange\">Ver</button>\n" +
                        "</a>\n" +
                        "</td>\n" +
                        "</tr>\n";
                }
            }
            PRODUCTS_LIST_TABLE.html(tableBody);
        }
    });
}
