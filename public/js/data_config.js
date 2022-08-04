$(document).ready(function(){
    // Inicializacion de Data Table 
   

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
          title:  'CAT',
          className: 'btn-success',
          text: '<i class="bx bxs-file-export"></i> Excel',
        },
        'pageLength'
      ]   
    });
    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    // $('.dt_active thead tr').clone(true).appendTo( '.dt_active thead' );

    // $('.dt_active thead tr:eq(1) th').each( function (i) {
    //     var title = $(this).text(); //es el nombre de la columna
    //     $(this).html( '<input type="hidden" id="'+title+'" style="width:100%;" placeholder="Buscar" />' );
 

    //     $( 'input', this ).on( 'keyup change', function () {
    //         if ( table.column(i).search() !== this.value ) {
    //             table
    //                 .column(i)
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );  
    
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

    table.on( 'draw', function () {
    });
    
     // tabla con filtros independientes
     var table2 = $(".dt_active2").DataTable({
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
          title:  'CAT'
        },
        'pageLength'
      ]   
    });

    table2.on( 'draw', function () {
    });
    
    
  });