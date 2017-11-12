$(function(){

    $('.btn-modal-edit-cliente').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let nombre = $(this).data('nombre');
        let apellido = $(this).data('apellido');
        let compania = $(this).data('compania');

        // set all data in form
        $('#form-edit #idCliente').val(id);
        $('#form-edit #nombre').val(nombre);
        $('#form-edit #apellido').val(apellido);
        $('#form-edit #compania').val(compania);
    });

    $('.btn-modal-delete-cliente').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let nombre = $(this).data('nombre');
        let apellido = $(this).data('apellido');
        // set all data in form
        $('#form-delete #idCliente').val(id);
        $('#form-delete #nombre').html(nombre);
        $('#form-delete #apellido').html(apellido);

    });

});