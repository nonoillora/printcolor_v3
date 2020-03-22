/**
 * Created by Antonio on 17/09/2017.
 */
$(document).ready(function () {
    var url = "";
    if (window.location.host == "localhost") {
        url = window.location.protocol + '//' + window.location.host + '/' + window.location.pathname.split('/')[1];
    } else {
        url = "http://printcolor.antonioextremera.com";
    }
    $('.empresaTransportePedido').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + '/admin/pedidos/setCompanyShipping',
            method: 'post',
            dataType: 'JSON',
            data: {
                idCompany: $(this).data('idcompany'),
                idPedido: $('#idPedido').html()
            },
            beforeSend: function () {
                $(this).prop('disabled', true);
            }, success: function (result) {
                if (result.status == 2) {
                    $('#showInfoProcessShipping').removeClass('hidden');
                    setTimeout(function () {
                        $('#showInfoProcessShipping').addClass('hidden');
                        $('#modalEmpresaSeguimiento').modal('hide');
                    }, 3000);
                }

            }, error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        })
    });

    $('#addNumSeguimientoPedido').on('click', function () {
        if (checkNumSeguimiento()) {
            $('#infoNumSeguimientoAlert').addClass('hidden');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/admin/pedidos/addNumSeguimiento',
                dataType: 'json',
                data: {
                    idPedido: $('#addNumSeguimientoPedido').data('id'),
                    numSeguimiento: $('#numSeguimientoPedido').val()
                },
                type: 'post',
                success: function (data) {
                    if (data.status) {
                        $('#infoNumSeguimientoSuccess').removeClass('hidden');
                        $('#idNumSeguimiento').html($('#numSeguimientoPedido').val());
                        setTimeout(function () {
                            $('#modalNumSeguimiento').modal('hide');
                            $('#infoNumSeguimientoSuccess').addClass('hidden');
                            $('#numSeguimientoPedido').val('');
                        }, 3000);
                    }
                }
            });
        } else {
            $('#infoNumSeguimientoAlert').removeClass('hidden');
        }
    });

    $('#setPaidPedido').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + '/admin/pedidos/setPaid',
            dataType: 'json',
            data: {
                idPedido: $('#setPaidPedido').data('id'),
            },
            type: 'post',
            success: function (data) {
                if (data.status) {
                    $('#divPedidoPaid').html('<span class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="left" title="pagado el ' + data.paid_at + '"></span>' +
                        ' Pagado <span class="glyphicon glyphicon-ok"></span></span>');
                }
            }
        });
    });

    $('#setSentPedido').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + '/admin/pedidos/setSent',
            dataType: 'json',
            data: {
                idPedido: $('#setSentPedido').data('id'),
            },
            type: 'post',
            success: function (data) {
                if (data.status) {
                    $('#divPedidoSent').html('<span class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-send" data-toggle="tooltip" data-placement="left"' +
                        'title="enviado el ' + data.sent_at + '"></span> Enviado <span class="glyphicon glyphicon-ok"></span></span>');
                    $('#SentAt').html(data.sent_at);
                }
            }
        });
    })
});


$('#EditarNumSeguimientoPedido').on('click', function () {
    if (window.location.host == "localhost") {
        url = window.location.protocol + '//' + window.location.host + '/' + window.location.pathname.split('/')[1];
    } else {
        url = "http://printcolor.antonioextremera.com";
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url + '/admin/pedidos/addNumSeguimiento',
        dataType: 'json',
        data: {
            idPedido: $('#idPedido').html(),
            numSeguimiento: $('#numSeguimientoEdit').val()
        },
        type: 'post',
        success: function (data) {
            if (data.status) {
                $('#showInfoUpdateNumSeguimiento').removeClass('hidden');
                $('#idNumSeguimiento').html($('#numSeguimientoEdit').val());
                setTimeout(function () {
                    $('#modalEditarNumSeguimiento').modal('hide');
                    $('#showInfoUpdateNumSeguimiento').addClass('hidden');
                }, 3000);
            }
        }
    });
});

function checkNumSeguimiento() {
    if ($('#numSeguimientoPedido').val().length > 0 && $('#numSeguimientoPedido').val() != '') {
        return true;
    } else {
        return false;
    }
}

