$(function(){

    $('.btn-modal-edit-vehiculo').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let patente = $(this).data('patente');
        let id_tipo = $(this).data('id_tipo');
        let id_estado = $(this).data('id_estado');

        // set all data in form
        $('#form-edit #idVehiculo').val(id);
        $('#form-edit #patente').val(patente);

        $('#form-edit #tipo option[value="'+id_tipo+'"]').attr('selected', 'selected');
        $('#form-edit #estado option[value="'+id_estado+'"]').attr('selected', 'selected');
    });

    $('.btn-modal-delete-vehiculo').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let patente = $(this).data('patente');
        // set all data in form
        $('#form-delete #idVehiculo').val(id);
        $('#form-delete #patente').html(patente);

    });

});