/**
 * Created by Antonio on 13/05/2017.
 */
$(document).ready(function () {
    $('#numPaginas,#tipo_impresion,#encuadernado,#numEjemplares, #tipo_envio').change(function () {
        checkNumPaginas();
        checkEncuadernado();
        checkNumEjemplares();
        checkEnvio();
        checkButton();
    });
});


function checkNumPaginas() {
    var color = setColor();
    var b_n = setb_n();
    var suma = 0;
    var precio = parseFloat($('#precioDocumentoOnline').html());
    if ($('#tipo_impresion').val() == 'color') {
        suma = parseFloat($('#numPaginas').val() * color);
        $('#precioDocumentoOnline').html(suma.toFixed(2));
    } else {
        suma = parseFloat($('#numPaginas').val() * b_n);
        $('#precioDocumentoOnline').html(suma.toFixed(2));
    }
}

function checkEncuadernado() {
    var precio = parseFloat($('#precioDocumentoOnline').html());
    if ($('#encuadernado').val() == 'si_encuadernado') {
        var suma = parseFloat(precio + 1.50).toFixed(2);
        $('#precioDocumentoOnline').html(suma);
    }
}

function checkNumEjemplares(){
    var precio = parseFloat($('#precioDocumentoOnline').html());
    var suma = parseFloat(parseInt($('#numEjemplares').val())*precio);
    $('#precioDocumentoOnline').html(suma.toFixed(2));
}

function checkEnvio(){
    var precio = parseFloat($('#precioDocumentoOnline').html());
    if($('#tipo_envio').val()=='envio'){
        var suma = parseFloat(precio+4.95);
        $('#precioDocumentoOnline').html(suma.toFixed(2));
        setPriceHidden(suma.toFixed(2));
    }else{
        setPriceHidden(precio.toFixed(2));
    }

}


function checkButton(){
    if(!isNaN($('#precioDocumentoOnline').html())){
        $('#addItem').prop('disabled',false);
    }else{
        $('#addItem').prop('disabled','disabled');
    }
}


function setPriceHidden(suma){
    $('#precioDocumentoOnlineInput').val(suma);
}

function setColor(){
    return $('#precioDocumentoOnlineColor').val();
}
function setb_n(){
    return $('#precioDocumentoOnlineBN').val();
}
