
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
	let formato   = $(this).data("img");
	let newruta = "";

	if (formato == 'jpg') {
	 newruta = './public/img/activos/'+asset.trim()+'.jpg';	
	}
	if (formato == 'jpeg') {
	 newruta = './public/img/activos/'+asset.trim()+'.jpeg';	
	}
	if (formato == 'png') {
	 newruta = './public/img/activos/'+asset.trim()+'.png';	
	}
	if (formato == 'error') {
	 newruta = './public/img/activos/'+formato+'.jpg';	
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



// ****************CORREOS*****************

// MOSTRAL EL MODAL Y SUS DATOS
$(document).on("click", "#ver_registro_correo", function(e){
	let id   = $(this).data("id");
	let nombre   = $(this).data("nombre");
	let apellidop   = $(this).data("apellidop");
	let apellidom   = $(this).data("apellidom");
	let correo   = $(this).data("correo");
	let estado   = $(this).data("estado");
	
    $("#correo_id_upd").val(id);
    $("#modal_nombre_upd").val(nombre);//mandamos los valores a los input para obtenerlos en js
    $("#modal_apellidop_upd").val(apellidop);
    $("#modal_apellidom_upd").val(apellidom);
    $("#modal_correo_upd").val(correo);
	$('#modal_estado_upd > option[value="'+estado+'"]').attr('selected', 'selected');
	
    $("#ver_correo").modal("show");	
  });
  
  // MOSTRAL EL MODAL Y SUS DATOS
  $(document).on("click", "#crear_cuenta_correo", function(e){
	  // console.log('Click en crear correo');	
	  $("#correo").modal("show");	
});
// BOTONES DE INICIAR GRAFICAS 
$(document).on("click", "#finsa1_start_inv", function(e){
	$("#chartdiv2").css("display", "block");;
	$("#chartdiv").css("display", "none");	
	$("#finsa1_stop_inv").css("display", "block");	
	
	$("#finsa3_start_inv").attr("disabled", true);	
	$("#oradel_start_inv").attr("disabled", true);	
	$("#cls_start_inv").attr("disabled", true);	
});

$(document).on("click", "#finsa3_start_inv", function(e){
	$("#chartdiv3").css("display", "block");;
	$("#chartdiv").css("display", "none");	
	$("#finsa3_stop_inv").css("display", "block");	

	$("#finsa1_start_inv").attr("disabled", true);	
	$("#oradel_start_inv").attr("disabled", true);	
	$("#cls_start_inv").attr("disabled", true);	
});

$(document).on("click", "#oradel_start_inv", function(e){
	$("#chartdiv4").css("display", "block");;
	$("#chartdiv").css("display", "none");	
	$("#oradel_stop_inv").css("display", "block");	

	$("#finsa1_start_inv").attr("disabled", true);	
	$("#finsa3_start_inv").attr("disabled", true);	
	$("#cls_start_inv").attr("disabled", true);	
});

$(document).on("click", "#cls_start_inv", function(e){
	$("#chartdiv5").css("display", "block");;
	$("#chartdiv").css("display", "none");	
	$("#cls_stop_inv").css("display", "block");	

	$("#finsa1_start_inv").attr("disabled", true);	
	$("#finsa3_start_inv").attr("disabled", true);	
	$("#oradel_start_inv").attr("disabled", true);	
});

// BOTONES DE STOP GRAFICAS 
$(document).on("click", "#finsa1_stop_inv", function(e){
	$("#chartdiv2").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#finsa1_stop_inv").css("display", "none");	
	
	$("#finsa3_start_inv").attr("disabled", false);	
	$("#oradel_start_inv").attr("disabled", false);	
	$("#cls_start_inv").attr("disabled", false);	
});
$(document).on("click", "#finsa3_stop_inv", function(e){
	$("#chartdiv3").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#finsa3_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#oradel_start_inv").attr("disabled", false);	
	$("#cls_start_inv").attr("disabled", false);	
});

$(document).on("click", "#oradel_stop_inv", function(e){
	$("#chartdiv4").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#oradel_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#finsa3_start_inv").attr("disabled", false);	
	$("#cls_start_inv").attr("disabled", false);	
});

$(document).on("click", "#cls_stop_inv", function(e){
	$("#chartdiv5").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#cls_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#finsa3_start_inv").attr("disabled", false);	
	$("#oradel_start_inv").attr("disabled", false);	
});


//codigo para mostrar imagen al seleccionar un activo 
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