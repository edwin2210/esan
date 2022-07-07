let FILTER_LETTERS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
let FILTER_LETTERS_SPECIALS = "ÑñáéíóúÁÉÍÓÚ";
let FILTER_NUMS = "1234567890";
let FILTER_SPECIALS = "()-_.:,;!¡+*@ ";

//Validate string according type
function validate(data, type) {
    let result = -1, lenMin, lenMax, filter;
    if (type == 'names' || type == 'lastnames') {
        lenMin = 3, lenMax = 30, filter = FILTER_LETTERS + FILTER_LETTERS_SPECIALS + " ";
    } else if (type == 'product' || type == 'table') {
        lenMin = 1, lenMax = 80, filter = FILTER_LETTERS +  FILTER_NUMS + FILTER_LETTERS_SPECIALS + FILTER_SPECIALS;
    } else if (type == 'capacity') {
        lenMin = 1, lenMax = 3, filter = FILTER_NUMS;
    } else if (type == 'price') {
        lenMin = 1, lenMax = 8, filter = FILTER_NUMS + ".";
    } else if (type == 'email') {
        lenMin = 5; lenMax = 40; filter = FILTER_LETTERS + FILTER_NUMS + " .@";
    } else if (type == 'password') {
        lenMin = 8; lenMax = 30; filter = FILTER_LETTERS +  FILTER_NUMS + FILTER_LETTERS_SPECIALS + FILTER_SPECIALS;
    } else if (type == 'description') {
        lenMin = 1; lenMax = 100; filter = FILTER_LETTERS +  FILTER_NUMS + FILTER_LETTERS_SPECIALS + FILTER_SPECIALS;
    }
    if (data.length >= lenMin && data.length <= lenMax) {
        sentinel = 0;
        for (let c = 0; c < data.length; c++) {
            for (let f = 0; f < filter.length; f++) {
                if (data.substr(c, 1) == filter.substr(f, 1)) {
                    sentinel++;
                    break;
                }
            }
        }
        if (sentinel == data.length) {
            result = 0;
        } else {
            result = -2;
        }
    } else {
        result = -3;
    }
    return result;
}

//Set validators for inputs
function setValidator(id, type) {
    $('#' + id).on('input', function (event) {
        if (validate($('#' + id).val(), type) == 0) {
            $('#' + id).removeClass('ht-inp-error');
        } else {
            $('#' + id).addClass('ht-inp-error');
        }
    });
}

//Get message from output validate()
function messageFromValidation(result) {
    switch (result) {
        case 0:
            return "";
            break;
        case -1:
            return " es un campo inválido";
            break;
        case -2:
            return " contiene caracteres no permitidos";
            break;
        case -3:
            return " tiene un tamaño muy pequeño o muy grande";
            break;
    }
}
