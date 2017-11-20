$(function(){

    $('.btn-modal-edit-mantenimiento').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let fechaFin = $(this).data('fechafin');
                let horaFin = $(this).data('horafin');
        let costo = $(this).data('costo');
        let mecanico = $(this).data('mecanico');
        let repuesto = $(this).data('repuestocambiado');

        // set all data in form
        $('#idEdit').val(id);
        $('#fechaFinEdit').val(fechaFin);
          $('#horaFinEdit').val(horaFin);
        $('#costoEdit').val(costo);
        $('#mecanicoEdit').val(mecanico);
        $('#repuestoCambiadoEdit').val(repuesto);
    });

    $('.btn-modal-delete-mantenimiento').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        let nombre = $(this).data('nombre');
        // set all data in form
        $('#idBorrar').val(id);
        $('#nombreBorrar').html(nombre);

    });

});
