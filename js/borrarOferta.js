/**
 * Created by Antonio on 30/04/2017.
 */
$(document).ready(function () {
    var url = "";
    if(window.location.host=="localhost"){
       url = window.location.protocol+'//'+window.location.host+'/'+window.location.pathname.split('/')[1];
    }else{
        url = "http://printcolor.antonioextremera.com";
    }
    $('.deleteOffer').on('click',function(){
        setIdDeleteOffer($(this).data('id'),$(this).data('name'));
    });

    $('#closeDeleteOffer').on('click',function(){
        $('#deleteOffer').modal('hide');
    });

    $('#confirmDeleteOffer').on('click',function(){
        window.location.href = url+'/admin/ofertas/borrar/'+$('#idOffer').val();
    });
});

function setIdDeleteOffer(id, name){
    $('#idOffer').val(id);
    $('#nameOffer').html(name);
}