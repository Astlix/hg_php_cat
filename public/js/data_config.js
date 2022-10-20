$(document).ready(function(){
    // Inicializacion de Data Table 
	let nombre   = $("#nombre").data("nombre");
	let nombre2   = $("#nombre2").data("nombre");
  

   

    // ESTA ES UNA TABLA PARA APLICAR FILTROS ESPECIFICOS}}}}}}}}}}}}}}}}}}}}}}}}}}}}
    var table = $(".dt_active").DataTable({
      orderCellsTop:true,
      fixedHeader:true,
      dom: 'Bfrtip',
      language: {
        "sProcessing":     '<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>',
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "_START_ al _END_ de _TOTAL_ Registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de 0 Registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "",
        "searchPlaceholder": "Buscar Registro",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": '<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>',
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      columnDefs: [{
        "targets": 'no-sort',
        "orderable": false
      }],
      lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10', '25', '50', 'Todos' ]
      ],
      buttons: [
        {
          extend: 'excelHtml5',
          title:  nombre,
          className: 'btn-success',
          text: '<i class="bx bxs-file-export"></i> Excel',
        },
        'pageLength'
      ]   
    });
    
    $('#filtro_asset').on('keyup change', function () {
      table
          .column(0)
          .search( this.value )
          .draw();
    } );

    $('#filtro_planta').change(function () {
      table
          .column(5)
          .search( this.value )
          .draw();
    } );

    $('#filtro_epc').change(function () {
      table
          .column(3)
          .search( this.value )
          .draw();
    } );


    // FILTRO PARA TABLA DE BITACORA
    $('#filtro_tipo').change(function () {
      table
          .column(1)
          .search( this.value )
          .draw();
    } );

    table.on( 'draw', function () {
    });
    
     // tabla con filtros independientes
     var table2 = $(".dt_active2").DataTable({
      orderCellsTop:true,
      responsive: true,
      fixedHeader:true,
      dom: 'Bfrtip',
      language: {
        "sProcessing":     '<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>',
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "_START_ al _END_ de _TOTAL_ Registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de 0 Registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "",
        "searchPlaceholder": "Buscar Registro",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": '<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>',
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      columnDefs: [{
        "targets": 'no-sort',
        "orderable": false
      }],
      lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10', '25', '50', 'Todos' ]
      ],
      buttons: [
        {
          extend: 'excelHtml5',
          title:  nombre2,
          className: 'btn-success',
          text: '<i class="bx bxs-file-export"></i> Excel',
        },
        'pageLength'
      ]   
    });

    table2.on( 'draw', function () {
    });
    
    
  });