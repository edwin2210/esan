$( document ).ready(function() {
    //Calculate total of products order
    let prefix = "web-public-products-container-container-";
    let nameContainer = $('.ht-container').attr('id').substr(prefix.length);
    updateTotalInOrder(nameContainer);
});

function addProductInOrder(nameContainer) {
    let container = $('#web-public-products-container-container-' + nameContainer);
    let product = $('#web-public-products-container-products-' + nameContainer + " option:selected");
    let productId = product.val(), productName = product.text(), productPrice = product.data('price');
    let quantity = $('#web-public-products-container-quantity-' + nameContainer).val();

    if (productId && productId > 0) {
        if (quantity && quantity > 0) {
            container.append(
                '<p class="ht-item fz-sm" id="' + productId + '" data-subtotal="' + (quantity * productPrice) + '" data-quantity="' + quantity + '">' +
                    quantity + ' - ' + productName +
                    '<i class="fa fa-times fz-md ht-close" onclick="removeProductInOrder(\'' + nameContainer + '\', \'' + productId + '\')"></i>' +
                '</p>'
            );
            updateTotalInOrder(nameContainer);
        } else {
            alert("Ingresa una cantidad");
        }
    } else {
        alert("Selecciona un producto");
    }
}

function removeProductInOrder(nameContainer, productId) {
    $('#web-public-products-container-container-' + nameContainer + " #" + productId).remove();
    updateTotalInOrder(nameContainer);
}

function updateTotalInOrder(nameContainer) {
    let container = $('#web-public-products-container-container-' + nameContainer);
    let total = 0;
    container.children('p').each(function() {
        total += parseFloat($(this).data('subtotal'));
    });
    $('#web-public-products-container-total-' + nameContainer).text('Total: $' + total);
}

function getOrder(nameContainer) {
    let container = $('#web-public-products-container-container-' + nameContainer);
    let products = [];
    container.children('p').each(function() {
        products.push([
            $(this).attr('id'),
            $(this).data('quantity'),
            $(this).data('subtotal')
        ]);
    });
    return products;
}
