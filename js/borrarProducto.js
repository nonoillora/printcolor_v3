/**
 * Created by Antonio on 30/04/2017.
 */
$(document).ready(function () {
    $('.deleteProduct').on('click',function(){
        setIdDeleteProduct($(this).data('id'),$(this).data('name'));
    });

    $('#closeDeleteProduct').on('click',function(){
        $('#deleteProduct').modal('hide');
    });

    $('#confirmDeleteProduct').on('click',function(){
        window.location.href = 'http://printcolor.antonioextremera.com/admin/producto/borrar/'+$('#idProduct').val();
    });
});

function setIdDeleteProduct(id, name){
    $('#idProduct').val(id);
    $('#nameProduct').html(name);
}