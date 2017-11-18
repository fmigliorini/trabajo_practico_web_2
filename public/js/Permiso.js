(function($){

    $('.btn-modal-delete-permiso').on('click',function(){
        // gett all data
        let idPermiso = $(this).data('idPermiso');
        // set all data in form
        $('#form-delete #idPermiso').val(id);
    });

})(jQuery);
