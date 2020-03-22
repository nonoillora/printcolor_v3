/**
 * Created by Antonio on 09/08/2017.
 */
var precio = 0.00;
var precioOriginal = '';
var cellActive = '';
var precioUrgencia = 4.95;
var precioDesignOne = 12.00;
var precioDesignTwo = 20.00;
var idPriceProduct = null;
var nametypeend = null;

$(document).ready(function () {
    $('.precioProducto').on('click', function () {
        precio = $(this).html();
        precio = precio.replace(" \u20ac", "");
        precioOriginal = precio;
        idPriceProduct = $(this).data('idpriceproduct');
        nametypeend = $(this).data('nametypeend');
        setPrice();
        setInfoProductSelect(this);
        setCellSelectActive(this);
        setNameTypeEnd();
    });
    $('.precioProducto').hover(function () {
        $(this).addClass('amarillo');
    }, function () {
        $(this).removeClass('amarillo');
    });
})
;
function setInfoProductSelect(data) {
    var info = $(data).data('content');
    $('#InfoProductSelect').html(info);
}
function setPrice() {
    $('#precioProductoInput').val(precio);
    $('#precioProducto').html(precio);
    $('#idTypeProduct').val(idPriceProduct);
    checkButtonSave();
}

function checkButtonSave() {
    if ($('#precioProducto').html() == "") {
        $('#saveProductCart').prop('disabled', true);
    } else {
        $('#saveProductCart').removeAttr('disabled');
    }
}

function setCellSelectActive(cell) {
    if (cellActive != '') {
        $(cellActive).css('background-color', 'inherit');
    }
    cellActive = cell;
    $(cell).css('background-color', 'yellow');
}

function setNameTypeEnd(){
    $('#nametypeend').val(nametypeend);
}