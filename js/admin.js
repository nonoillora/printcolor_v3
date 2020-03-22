/**
 * Created by Antonio on 23/04/2017.
 */
$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('#savePrice').on('click', function () {
        if (checkNewPrice() == 3) {
            $.ajax({
                    url: 'http://printcolor.antonioextremera.com/admin/producto/addNewPrice',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        price: $('#newPrice').val(),
                        count: $('#newCount').val(),
                        typePriceProduct: $('#newType').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    beforeSend: function () {
                        $('#savePrice').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        }
                    }, error: function (data) {
                        alert('casca');
                    }
                }
            )
        }
    })
    ;

    $('#saveType').on('click', function () {
        if (checkNameTypePriceProduct()) {
            $.ajax({
                    url: 'http://printcolor.antonioextremera.com/admin/producto/addNewTypePriceProduct',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        idProduct: location.pathname.split('/')[4],
                        nameTypePrice: $('#nameTypePriceProduct').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    beforeSend: function () {
                        $('#saveType').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        }
                    }, error: function (data) {
                        alert('casca');
                        console.log(data.responseText);
                    }
                }
            )
        }
    })
    /* actualizar precio */
    $('#saveType').on('click', function () {
        if (checkNameTypePriceProduct()) {
            $.ajax({
                    url: 'http://printcolor.antonioextremera.com/admin/producto/addNewTypePriceProduct',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        idProduct: location.pathname.split('/')[4],
                        nameTypePrice: $('#nameTypePriceProduct').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    beforeSend: function () {
                        $('#saveType').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        }
                    }, error: function (data) {
                        alert('casca');
                        console.log(data.responseText);
                    }
                }
            )
        }
    })

    /* eliminar precio */
    $('#confirmDeletePrice').on('click', function () {
                    $.ajax({
                    url: 'localhost/printcolor/admin/producto/deletePrice',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        idPrice: $('#idPriceDelete').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    beforeSend: function () {
                        $('#saveType').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        }
                    }, error: function (data) {
                        alert('casca');
                        console.log(data.responseText);
                    }
                }
            )
    })

    $('#closedeletePrice').on('click',function(){
        closeModalDeletePrice();
    });

    $('.deletePriceProduct').on('click',function(){
        setIdPriceDelete($(this).data('id'));
    });

    $('#deletePrice').on('show.bs.modal',function(){
        $('#dataPrice').html($('#idPriceDelete').val());
    });

    $('#deletePrice').on('hide.bs.modal',function(){
        $('#dataPrice').html('');
    });
});

function setIdPriceDelete(id){
    $('#idPriceDelete').val(id);
}


function clearNewPrice() {
    $('#addPRiceProduct').on('hidden.bs.modal', function () {
        $('#newPrice').val('');
        $('#newCount').val('');
        $('#newType').selectedIndex(0);
    });
}

function checkNameTypePriceProduct() {
    if ($('#nameTypePriceProduct').val() == '') {
        $('#nameTypePriceProduct').css('border', '1px solid red');
        return false;
    } else {
        $('#nameTypePriceProduct').css('border', '1px solid #ccd0d2');
        return true;
    }
}

function checkNewPrice() {
    var total = 0;
    if ($('#newPrice').val() == '') {
        $('#newPrice').css('border', '1px solid red');
    } else {
        total++;
        $('#newPrice').css('border', '1px solid #ccd0d2');
    }
    if ($('#newCount').val() == '') {
        $('#newCount').css('border', '1px solid red');
    } else {
        $('#newCount').css('border', '1px solid #ccd0d2');
        total++;
    }
    if ($('#newType').prop('selectedIndex') == 0) {
        $('#newType').css('border', '1px solid red');
    } else {
        $('#newType').css('border', '1px solid #ccd0d2');
        total++;
    }
    return total;
}

function closeModalDeletePrice() {
    $('#deletePrice').modal('hide');
}
