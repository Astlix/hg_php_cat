
// ACTIVAR LOS INPUTS DE EDITAR ACTIVOS
$(document).on("click", "#form_activar", function(e){
	$("#modal_asset_upd").prop('disabled', false);
	$("#modal_desc_upd").prop('disabled', false);
	$("#modal_num_serial_upd").prop('disabled', false);
	$("#modal_planta_upd").prop('disabled', false);
	$("#modal_columna_upd").prop('disabled', false);
	$("#modal_num_upd").prop('disabled', false);
	$("#modal_serv_1_upd").prop('disabled', false);
	$("#modal_serv_2_upd").prop('disabled', false);
	$("#modal_serv_3_upd").prop('disabled', false);
	$("#modal_serv_4_upd").prop('disabled', false);
	$("#modal_serv_5_upd").prop('disabled', false);
	$("#modal_inv_upd").prop('disabled', false);
	$("#btn_act_upd").css("visibility", "visible");
	$("#inputimg").css("visibility", "visible");

});


// MOSTRAL EL MODAL Y SUS DATOS
   $(document).on("click", "#ver_registro_act", function(e){
	let asset   = $(this).data("asset");
	let description   = $(this).data("description");
	let epc   = $(this).data("epc");
	let tagfind   = $(this).data("tagfind");
	let serial   = $(this).data("serial");
	let inventario   = $(this).data("inventario");
	let fecha   = $(this).data("fecha");
	let id   = $(this).data("id");
	let planta   = $(this).data("planta");
	let columna   = $(this).data("columna");
	let num_columna   = $(this).data("num");
	let s1   = $(this).data("s1");
	let s2   = $(this).data("s2");
	let s3   = $(this).data("s3");
	let s4   = $(this).data("s4");
	let s5   = $(this).data("s5");
	let ruta   = $(this).data("ruta");
	let newruta = ruta.slice(1); //quitamos el primer caracter de la ruta
	if (newruta=='' || newruta == './public/img/activos/') {
		newruta ="./public/img/activos/cat.png";
	}
	
	$('#modal_planta_upd > option[value="'+planta+'"]').attr('selected', 'selected');
	$('#modal_columna_upd > option[value="'+columna+'"]').attr('selected', 'selected');
	$('#modal_num_upd > option[value="'+num_columna+'"]').attr('selected', 'selected');
    $("#modal_asset_upd").val(asset);//mandamos los valores a los input para obtenerlos en js
    $("#modal_desc_upd").val(description);
    $("#modal_epc_upd").val(epc);
    $("#modal_tagfind_upd").val(tagfind);
    $("#modal_inv_upd").val(inventario);
    $("#modal_date_upd").val(fecha);
    $("#modal_num_serial_upd").val(serial);
    $("#activo_id_upd").val(id);
    $("#modal_serv_1_upd").val(s1);
    $("#modal_serv_2_upd").val(s2);
    $("#modal_serv_3_upd").val(s3);
    $("#modal_serv_4_upd").val(s4);
    $("#modal_serv_5_upd").val(s5);
    $("#imagen").attr("src",newruta);
	
    $("#ver_registro").modal("show");
  });

  //modal para ver los activos especificos

  $(document).on("click", "#btn_detalles_activo",function () {
		
    var planta =$(this).data('planta');
    var columna =$(this).data('ubicacion');
    var num_columna =$(this).data('numcolumna');
	
    
	$("#activos_detalles").modal("show");
 
 console.log(planta+columna+num_columna);

$.ajax({
  data: {"planta" : planta,
  		 "columna": columna,
  		 "num_columna": num_columna},
  url: "./views/detalles_activos.php",
  type: "post",
  success:  function (response) {
    data=$.parseJSON(response); //parse response string
    $('#datos_activos').html(data.resp);
  }  
});
});

const avatarInput = document.querySelector('#avatarInput');
const avatarName = document.querySelector('.input-file__name');
const imagePreview = document.querySelector('.image-preview');

avatarInput.addEventListener('change', e => {
	let input = e.currentTarget;
	let fileName = input.files[0].name;
	avatarName.innerText = `${fileName}`;

	const fileReader = new FileReader();
	fileReader.addEventListener('load', e => {
		let imageData = e.target.result;
		imagePreview.setAttribute('src', imageData);
	})

	fileReader.readAsDataURL(input.files[0]);
});
