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
    $('.deleteCategory').on('click',function(){
        setIdDeleteCategory($(this).data('id'),$(this).data('name'));
    });

    $('#closeDeleteCategory').on('click',function(){
        $('#deleteCategory').modal('hide');
    });

    $('#confirmDeleteCategory').on('click',function(){
        window.location.href = url+'/admin/categoria/borrar/'+$('#idCategory').val();
    });
});

function setIdDeleteCategory(id, name){
    $('#idCategory').val(id);
    $('#nameCategory').html(name);
}