$(function(){

    $('.btn-modal-visualizar-viaje').on('click',function(){

        // gett all data
        let descripcion = $(this).data('descripcion');
        let origen = $(this).data('origen');
        let destino = $(this).data('destino');
        let fecha_inicio = $(this).data('fecha_inicio');
        let fecha_fin = $(this).data('fecha_fin');
        let tiempo_estimado = $(this).data('tiempo_estimado');
        let tiempo_real = $(this).data('tiempo_real');
        let desviacion = $(this).data('desviacion');
        let combustible_estimado = $(this).data('combustible_estimado');
        let nombre_cliente = $(this).data('nombre_cliente');
        let apellido_cliente = $(this).data('apellido_cliente');
        let nombre_chofer = $(this).data('nombre_chofer');
        let apellido_chofer = $(this).data('apellido_chofer');
        let patente = $(this).data('patente');
        let patenteAcoplado = $(this).data('patente_acoplado');

        // set all data in form
        $('#form-visualizar #descripcion').val(descripcion);
        $('#form-visualizar #origen').val(origen);
        $('#form-visualizar #destino').val(destino);
        $('#form-visualizar #fecha_inicio').val(fecha_inicio);
        $('#form-visualizar #fecha_fin').val(fecha_fin);
        $('#form-visualizar #tiempo_estimado').val(tiempo_estimado);
        $('#form-visualizar #tiempo_real').val(tiempo_real);
        $('#form-visualizar #desviacion').val(desviacion);
        $('#form-visualizar #combustible_estimado').val(combustible_estimado);
        $('#form-visualizar #id_cliente').val(nombre_cliente+' '+apellido_cliente);
        $('#form-visualizar #id_chofer').val(nombre_chofer+' '+apellido_chofer);
        $('#form-visualizar #id_vehiculo').val(patente);
        $('#form-visualizar #id_vehiculoAcoplado').val(patenteAcoplado);
    });

    
    $('.btn-modal-edit-viaje').on('click',function(){

        // gett all data
        let id = $(this).data('id');
        let descripcion = $(this).data('descripcion');
        let origen = $(this).data('origen');
        let destino = $(this).data('destino');
        let fecha_inicio = $(this).data('fecha_inicio');
        let fecha_fin = $(this).data('fecha_fin');
        let tiempo_estimado = $(this).data('tiempo_estimado');
        let tiempo_real = $(this).data('tiempo_real');
        let desviacion = $(this).data('desviacion');
        let combustible_estimado = $(this).data('combustible_estimado');
        let id_cliente = $(this).data('id_cliente');
        let id_chofer = $(this).data('id_chofer');
        let id_vehiculo = $(this).data('id_vehiculo');
        let id_vehiculoAcoplado = $(this).data('id_vehiculo_acoplado');

        // set all data in form
        $('#form-edit #descripcion').val(descripcion);
        $('#form-edit #origen').val(origen);
        $('#form-edit #destino').val(destino);
        $('#form-edit #fecha_inicio').val(fecha_inicio);
        $('#form-edit #fecha_fin').val(fecha_fin);
        $('#form-edit #tiempo_estimado').val(tiempo_estimado);
        $('#form-edit #tiempo_real').val(tiempo_real);
        $('#form-edit #desviacion').val(desviacion);
        $('#form-edit #combustible_estimado').val(combustible_estimado);
        $('#form-edit #idViaje').val(id);

        $('#form-edit #idChofer option[value='+id_chofer+']').attr('selected', 'selected');
        $('#form-edit #idCliente option[value='+id_cliente+']').attr('selected', 'selected');
        $('#form-edit #idVehiculo option[value='+id_vehiculo+']').attr('selected', 'selected');
        $('#form-edit #idVehiculoAcoplado option[value='+id_vehiculoAcoplado+']').attr('selected', 'selected');
        
    });

    
    $('.btn-modal-delete-viaje').on('click',function(){
        // gett all data
        let id = $(this).data('id');
        // set all data in form
        $('#form-delete #idViaje').val(id);

    });
    

});