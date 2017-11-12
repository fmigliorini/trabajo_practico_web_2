$(function(){

    $('.btn-modal-edit-vehiculo').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let patente = $(this).data('patente');
        let tipo = $(this).data('tipo');
        let estado = $(this).data('estado');

        // set all data in form
        $('#form-edit #idVehiculo').val(id);
        $('#form-edit #patente').val(patente);
        $('#form-edit #tipo').val(tipo);
        $('#form-edit #estado').val(estado);
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