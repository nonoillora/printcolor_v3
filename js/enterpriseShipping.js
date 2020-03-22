/**
 * Created by Antonio on 15/09/2017.
 */

$(document).ready(function () {
    var url = "";
    if(window.location.host=="localhost"){
        url = window.location.protocol+'//'+window.location.host+'/'+window.location.pathname.split('/')[1];
    }else{
        url = "http://printcolor.antonioextremera.com";
    }
    //guardar nueva empresa de transporte
   $('#saveEnterpriseShipping').on('click', function () {
        if (checkFieldsShipping() == 5) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url+'/admin/shipping/addNewCompanyShipping',
                method: 'post',
                dataType: 'JSON',
                data: {
                    name_company: $('#name_company').val(),
                    address: $('#address').val(),
                    phone: $('#phone').val(),
                    url_company: $('#url_company').val(),
                    url_follow_package: $('#url_follow_package').val()
                },
                beforeSend: function () {
                    $('#saveEnterpriseShipping').prop('disabled', true);
                }, success: function (result) {
                    if (result.status) {
                        $('#saveEnterpriseShipping').prop('disabled', false);
                        $('.bs-example-modal-lg').modal('hide');
                    }

                }, error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    });

    //actualizar empresa
    $('.actualizarEmpresa').on('click', function () {
        var id = $(this).attr('idcompany');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url+'/admin/shipping/updateCompanyShipping',
                method: 'post',
                dataType: 'JSON',
                data: {
                    idCompany: id,
                    name_company: $('#name_company'+id).val(),
                    address: $('#address'+id).val(),
                    phone: $('#phone'+id).val(),
                    url_company: $('#url_company'+id).val(),
                    url_follow_package: $('#url_follow_package'+id).val()
                },
                beforeSend: function () {
                    $('this').prop('disabled', true);
                }, success: function (result) {
                    if (result.status) {
                        $(this).prop('disabled', false);
                        $('#infoEmpresa'+id).removeClass('hidden');
                        $('#name'+id).html($('#name_company'+id).val());
                        setTimeout(function(){
                            $('#infoEmpresa'+id).addClass('hidden');
                        },5000);
                    }

                }, error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
    });

    //eliminar empresa
    $('.borrarEmpresa').on('click', function () {
        var idCompany = $(this).attr('idempresa');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url+'/admin/shipping/deleteCompanyShipping',
            method: 'post',
            dataType: 'JSON',
            data: {
                id:idCompany
            },
            beforeSend: function () {
                $(this).prop('disabled', true);
            }, success: function (result) {
                if (result.status) {
                    $('#empresa'+idCompany).fadeOut();
                    setTimeout(function(){$('#empresa'+idCompany).remove();},2500);
                }

            }, error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });

    $('#clearForm').on('click', clearFormEnterprise);
});


function clearFormEnterprise() {
    $('#name_company').val("");
    $('#address').val("");
    $('#phone').val("");
    $('#url_company').val("");
    $('#url_follow_package').val("");
}

function checkFieldsShipping() {
    var counter = 0;
    if ($('#name_company').val() == "") {
        $('#name_company_info').removeClass('hidden');
    } else {
        $('#name_company_info').addClass('hidden');
        counter++;
    }
    if ($('#address').val() == "") {
        $('#address_info').removeClass('hidden');
    } else {
        $('#address_info').addClass('hidden');
        counter++;
    }
    if ($('#phone').val() == "") {
        $('#phone_info').removeClass('hidden');
    } else {
        $('#phone_info').addClass('hidden');
        counter++;
    }
    if ($('#url_company').val() == "") {
        $('#url_company_info').removeClass('hidden');
    } else {
        $('#url_company_info').addClass('hidden');
        counter++;
    }
    if ($('#url_follow_package').val() == "") {
        $('#url_follow_package_info').removeClass('hidden');
    } else {
        $('#url_follow_package_info').addClass('hidden');
        counter++;
    }
    return counter;
}