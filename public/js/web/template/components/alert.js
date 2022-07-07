/***** Alert *****/
$( document ).ready(function() {
    $('.web-alert-container a').click(closeAlert);
});

function showAlert(status, message, duration) { //Show Alert with Autoclose time
    $('.web-alert-container p ').text(message);
    switch (status) {
        case 0:
            $('.web-alert-container').addClass('color-bg-red');
            break;
        case 1:
            $('.web-alert-container').addClass('color-bg-orange');
            break;
    }
    $('.web-alert-container').removeClass('d-none');
    $('.web-alert-container p').removeClass('d-none');
    $('.web-alert-container a').removeClass('d-none');
    setTimeout(closeAlert, duration);
}

function closeAlert() { //Close alert
    $('.web-alert-container').addClass('d-none');
    $('.web-alert-container p').addClass('d-none');
    $('.web-alert-container a').addClass('d-none');
    $('.web-alert-container').removeClass('color-bg-red');
    $('.web-alert-container').removeClass('color-bg-orange');
}
