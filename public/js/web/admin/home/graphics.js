/***** Graphics View *****/
let HOME_GRAPHICS_A_DATE = $("#web-admin-home-graphics-adate");
let HOME_GRAPHICS_B_DATE = $("#web-admin-home-graphics-bdate");
let HOME_GRAPHICS_ROUTE = $("#inp-route-web-admin-home-graphics").val();

$( document ).ready(function() {
    //Link to graphic by dates range
    HOME_GRAPHICS_A_DATE.on('change', function () {
        getDataForGraphicHome();
    });
    HOME_GRAPHICS_B_DATE.on('change', function () {
        getDataForGraphicHome();
    });
    //Call graphic at section ready
    getDataForGraphicHome();
});

function getDataForGraphicHome() {
    let strDateA = HOME_GRAPHICS_A_DATE.val();
    let strDateB = HOME_GRAPHICS_B_DATE.val();
    let dateA = null, dateB = null;
    if (strDateA.length > 0 && strDateB.length > 0) {
        dateA = new Date(strDateA);
        dateB = new Date(strDateB);
        if (dateA >= dateB) {
            showAlert(0, "La fecha inicial debe ser menor a la fecha final", 2000);
            strDateA = ""; strDateB = "";
        } else {
            strDateA = HOME_GRAPHICS_A_DATE.val();
            strDateB = HOME_GRAPHICS_B_DATE.val();
        }
    } else {
        if (strDateA.length > 0 && strDateB.length == 0) {
            showAlert(0, "Ingresa una fecha final", 2000);
        } else if (strDateA.length == 0 && strDateB.length > 0) {
            showAlert(0, "Ingresa una fecha inicial", 2000);
        }
        strDateA = ""; strDateB = "";
    }
    if (strDateA.length > 0 && strDateB.length > 0) {
        $.ajax({
            type: 'post',
            url: HOME_GRAPHICS_ROUTE,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'dateA': strDateA,
                'dateB': strDateB,
            },
            success: function (result){
                result = JSON.parse(result);
                if (result.success) {
                    $('#web-admin-home-graphics-title').text(result.title);
                    $('#web-admin-home-graphics-total_earned').text("Ganancias totales: $" + result.money_earned);
                    let time = result.time.split(",");
                    if (time.length == 3) {
                        $('#web-admin-home-graphics-time').html(
                            "<li>Tiempo mín. en una mesa: " + time[0] + "hrs</li>" +
                            "<li>Tiempo prom. en una mesa: " + time[1] + "hrs</li>" +
                            "<li>Tiempo máx. en una mesa: " + time[2] + "hrs</li>"
                        );
                    }
                    generateGraphic(result.top_products, "web-admin-home-graphics-top_products", "pie", "Productos más vendidos");
                    generateGraphic(result.top_tables, "web-admin-home-graphics-top_tables", "pie", "Mesas más utilizadas");
                    generateGraphic(result.top_days, "web-admin-home-graphics-top_days", "bar", "Días más concurridos");
                    generateGraphic(result.top_days, "web-admin-home-graphics-top_days", "bar", "Días más concurridos");
                    showAlert(1, result.message, 2500);
                } else {
                    showAlert(0, result.message, 2000);
                }
            }
        });
    }
}

function generateGraphic(array_data, canvas_id, type, title) {
    let x_vals = [];
    let y_vals = [];
    let n;
    for (var key in array_data) {
        x_vals.push(key);
        y_vals.push(array_data[key]);
    }
    var colors = dynamicColors(x_vals.length);

    let display_aux = true;
    if (type == "bar") { //Hide top controls of graphic for graphic bars
        display_aux = false;
    }
    new Chart(canvas_id, {
        type: type,
        data: {
            labels: x_vals,
            datasets: [{
                backgroundColor: colors,
                borderColor: colors,
                data: y_vals
            }]
        },
        options: {
            legend: {display: display_aux},
            title: {
                display: true,
                text: title
            }
        }
    });
}

function dynamicColors(size) { //Generate array of random colors
    var r, g, b, i;
    var arr = [];
    for (i = 0; i < size; i++) {
        r = Math.floor(Math.random() * 255);
        g = Math.floor(Math.random() * 255);
        b = Math.floor(Math.random() * 255);
        arr.push("rgb(" + r + "," + g + "," + b + ")");
    }
    return arr;
};
