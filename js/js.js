$(document).ready(function () {

    $('#showEmpresa').on('click', function () {
        showEmpresa();
    });
    //$('.carousel').carousel();

});


function showEmpresa() {
    if ($('#showEmpresa').prop('checked')) {
        $('#datosEmpresa').removeClass('hidden');
    } else {
        $('#datosEmpresa').addClass('hidden');
    }
}

