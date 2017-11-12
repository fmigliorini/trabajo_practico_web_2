$(function(){
	$("table").dataTable({
		"ordering": false,
		"info": false,
		"lengthChange": false,
		"searching": false,
		"language": {
			"emptyTable":     "No hay resultados",
		    "loadingRecords": "Loading...",
		    "processing":     "Procesando...",
		    "search":         "Buscar:",
		    "zeroRecords":    "No hay resultados",
		    "paginate": {
		        "first":      "Primero",
		        "last":       "Ultimo",
		        "next":       "Siguiente",
		        "previous":   "Anterior",
		    },
		},

	});
});
