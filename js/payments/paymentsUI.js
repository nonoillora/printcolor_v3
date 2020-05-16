/**
 * Created by Antonio on 28/06/2018.
 */
$(document).ready(function () {
    $('#trans_bancaria').on('click', function () {
        setPaymentActive('trans_bancaria');
    });
    $('#paypal-button').on('click', function () {
        setPaymentActive('paypal-button');
    });
    $('#tpv-button').on('click', function () {
        setPaymentActive('tpv-button');
    });
    /* haiblitamos el select para recogerlo en el request al creazr el pedido*/
    $('#registerOrderForm').on('submit', function() {
        $('#methodPayUserSelected').prop('disabled', false);
    });
    /*Actualizar pedido...*/
    $('#updateOrderForm').on('submit', function() {
        $('#methodPayUserSelected').prop('disabled', false);
    });
});

function setPaymentActive(id) {
    switch (id) {
        case 'paypal-button':
            $('#trans_bancaria').removeClass('alert-success');
            $('#trans_bancaria').addClass('alert-info');
            $('#paypal-button').removeClass('alert-info');
            $('#paypal-button').addClass('alert-success');
            $('#tpv-button').addClass('alert-info');
            $('#tpv-button').removeClass('alert-success');
            break;
        case 'trans_bancaria':
            $('#trans_bancaria').removeClass('alert-info');
            $('#trans_bancaria').addClass('alert-success');
            $('#paypal-button').addClass('alert-info');
            $('#paypal-button').removeClass('alert-success');
            $('#tpv-button').addClass('alert-info');
            $('#tpv-button').removeClass('alert-success');
            break;
        case 'tpv-button':
            $('#trans_bancaria').addClass('alert-info');
            $('#trans_bancaria').removeClass('alert-success');
            $('#paypal-button').addClass('alert-info');
            $('#paypal-button').removeClass('alert-success');
            $('#tpv-button').removeClass('alert-info');
            $('#tpv-button').addClass('alert-success');
            break;
    }
    $('#methodPayUserSelected').val($('#' + id).data('id')).change();
    $('#submitRegisterOrder').prop('disabled', false);
}