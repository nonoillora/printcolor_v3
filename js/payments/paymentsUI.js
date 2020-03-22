/**
 * Created by Antonio on 28/06/2018.
 */
$(document).ready(function(){
    $('#trans_bancaria').on('click', function () {
        setMethodPay($('#trans_bancaria').data('content'));
        setPaymentActive('trans_bancaria');

    });
    $('#paypal-button').on('click', function () {
        setMethodPay($('#paypal-button').data('content'));
        setPaymentActive('paypal-button');
    });

});

function setMethodPay(type) {
    if (type != '') {
        $('#methodPayUserSelect').html(type);
        $('#divMethodPayUser').removeClass('alert-warning');
        $('#divMethodPayUser').addClass('alert-success');
    }
}

function setPaymentActive(id){
    if(id=='paypal-button'){
        $('#trans_bancaria').removeClass('alert alert-success');
        $('#paypal-button').addClass('alert alert-success');
    }
    if(id=='trans_bancaria'){
        $('#trans_bancaria').addClass('alert alert-success');
        $('#paypal-button').removeClass('alert alert-success');
    }
    $('#methodPayUserSelectInput').val($('#'+id).data('id'));
    $('#submitRegisterOrder').prop('disabled',false);
}