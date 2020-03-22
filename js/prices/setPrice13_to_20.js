/**
 * Created by Antonio on 25/06/2017.
 */
$(document).ready(function () {

    $('#tipo_envio').change(function () {
        checkEnvio();
        checkButton();
    });


    function checkEnvio(){
        var precio = parseFloat($('#precioDocumentoOnline').html());
        if($('#tipo_envio').val()=='envio'){
            var suma = parseFloat(precio+4.95);
            $('#precioDocumentoOnline').html(suma.toFixed(2));
        }
    }

    function checkButton(){
        if(!isNaN($('#precioDocumentoOnline').html())){
            $('#addItem').prop('disabled',false);
        }else{
            $('#addItem').prop('disabled','disabled');
        }
    }
});