(function($){

    $('.btn-modal-edit-empleado').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let nombre = $(this).data('nombre');
        let apellido = $(this).data('apellido');
        let telefono = $(this).data('telefono');
        let dni = $(this).data('dni');
        // set all data in form
        $('#form-edit #idEmpleado').val(id);
        $('#form-edit #nombre').val(nombre);
        $('#form-edit #apellido').val(apellido);
        $('#form-edit #telefono').val(telefono);
        $('#form-edit #dni').val(dni);
    });

    $('.btn-modal-delete-empleado').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let dni = $(this).data('dni');
        // set all data in form
        $('#form-delete #idEmpleado').val(id);
        $('#form-delete #dni').html(dni);

    });

})(jQuery);
