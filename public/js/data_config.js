$(document).ready(function(){
    // Inicializacion de Data Table
  
  
    var table = $(".dt_active").DataTable({
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
        "searchPlaceholder": "Buscar Articulo",
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
    table.on( 'draw', function () {
    });
    
  });