(function($){

    $('.btn-modal-edit-usuario').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let rol = $(this).data('rol');

        // set all data in form
        $('#form-edit #idUsuario').val(id);
        $('#form-edit #usuario').val(usuario);
        $('#form-edit #idRol').val(rol);
    });

    $('.btn-modal-delete-usuario').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let dni = $(this).data('dni');
        // set all data in form
        $('#form-delete #idEmpleado').val(id);
        $('#form-delete #dni').html(dni);

    });

})(jQuery);
