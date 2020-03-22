/**
 * Created by Antonio on 23/04/2017.
 */
$(document).ready(function () {
    var url = "";
    if(window.location.host=="localhost"){
        url = window.location.protocol+'//'+window.location.host+'/'+window.location.pathname.split('/')[1];
    }else{
        url = "http://printcolor.antonioextremera.com";
    }
    $('[data-toggle="tooltip"]').tooltip();

    $('#savePrice').on('click', function () {
        if (checkNewPrice() == 3) {
            $.ajax({
                    url: url+'/admin/producto/addNewPrice',
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
                    url: url+'/admin/producto/addNewTypePriceProduct',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        idProduct: location.pathname.split('/')[5],
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
    $('#updatePrice').on('click', function () {
            $.ajax({
                    url: url+'/admin/producto/editPriceProduct',
                    dataType: 'JSON',
                    method: 'post',
                    data: {
                        idPriceProduct: $('#idProductPriceEdit').val(),
                        idTypePriceProduct:$('#editType').val(),
                        count:$('#editCount').val(),
                        price: $('#editPrice').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    beforeSend: function () {
                        $('#updatePrice').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.exist) {
                            location.reload();
                        }
                    }, error: function (data) {
                        alert('casca');
                        console.log(data.responseText);
                    }
                }
            )
    })

    /* eliminar precio */
    $('#confirmDeletePrice').on('click', function () {
                    $.ajax({
                    url: url+'/admin/producto/deletePrice',
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
                        $('#confirmDeletePrice').prop('disabled', true);
                    }
                    ,
                    success: function (data) {
                        if (data.exist) {
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

    $('.editPriceProduct').on('click',function(){
       setEditPrice(this);
    });

    $('#deletePrice').on('show.bs.modal',function(){
        $('#dataPrice').html($('#idPriceDelete').val());
    });

    $('#deletePrice').on('hide.bs.modal',function(){
        $('#dataPrice').html('');
    });

    $('#editPRiceProduct').on('hide.bs.modal',function(){
       clearEditPrice();
    });

    $('.editNameTypePriceProduct').on('click',function(){
        setEditNameTypePriceProduct($(this).data('name'),$(this).data('id'));
    });
//actualizar el nombre del acabado
    $('#saveNameTypePriceProduct').on('click',function(){
        $.ajax({
                url: url+'/admin/producto/editNameTypePriceProduct',
                dataType: 'JSON',
                method: 'post',
                data: {
                    idTypeProductPrice: $('#idTypePRiceProduct').val(),
                    name: $('#editNameTypePriceProduct').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                ,
                beforeSend: function () {
                    $('#saveNameTypePriceProduct').prop('disabled', true);
                }
                ,
                success: function (data) {
                    if (data.exist) {
                        location.reload();
                    }
                }, error: function (data) {
                    alert('casca');
                    console.log(data.responseText);
                }
            }
        )
    });

    $('#closeEditNameTypePriceProduct').on('click',function(){
        closeDeleteTypePriceProduct();
    });

    $('.deleteTypePriceProduct').on('click',function(){
       setIdDeleteTypePriceProduct($(this).data('id'));
    });

    $('#confirmDeletetypePriceProduct').on('click',function(){
        $.ajax({
                url: url+'/admin/producto/deleteTypePriceProduct',
                dataType: 'JSON',
                method: 'post',
                data: {
                    idTypeProductPrice: $('#idTypePriceProductDelete').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                ,
                beforeSend: function () {
                    $('#saveNameTypePriceProduct').prop('disabled', true);
                }
                ,
                success: function (data) {
                    if (data.exist) {
                        location.reload();
                    }
                }, error: function (data) {
                    alert('casca');
                    console.log(data.responseText);
                }
            }
        )
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

function closeDeleteTypePriceProduct(){
    $('#deleteTypePriceProduct').modal('hide');
}
function setEditPrice(mythis){
    $('#editType').val($(mythis).data('type')).change();
    $('#editCount').val($(mythis).data('count'));
    $('#editPrice').val($(mythis).data('price'));
    $('#idProductPriceEdit').val($(mythis).data('id'));
}

function clearEditPrice(){
    $('#idProductPriceEdit').val('');
    $('#editType').prop('selectedIndex',0);
    $('#editCount').val('');
    $('#editPrice').val('');
}

function setEditNameTypePriceProduct(name,id){
    $('#editNameTypePriceProduct').val(name);
    $('#idTypePRiceProduct').val(id);
}

function setIdDeleteTypePriceProduct(id){
    $('#idTypePriceProductDelete').val(id);
}