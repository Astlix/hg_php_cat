
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
  
  $(document).on("click", "#crear_cuenta_correo", function(e){
	// console.log('Click en crear correo');	
	$("#correo").modal("show");	
});

 

// ****************EQUIPOS*****************
 // MOSTRAL MODAL HH
  $(document).on("click", "#ver_dato_hh", function(e){
	  let id   = $(this).data("id");
	  let mac   = $(this).data("mac");
	  let marca   = $(this).data("marca");
	  let modelo   = $(this).data("modelo");
	  
	  $("#hh_id_upd").val(id);
	  $("#modal_mac_upd").val(mac);//mandamos los valores a los input para obtenerlos en js
	  $("#modal_marca_upd").val(marca);
	  $("#modal_modelo_upd").val(modelo);
	  
	  $("#ver_hh").modal("show");	
	});
  // AGREGAR HANDHELD
  $(document).on("click", "#crear_hh", function(e){
	  $("#modal_crear_hh").modal("show");	
});

  // AGREGAR READER
  $(document).on("click", "#crear_reader", function(e){
	  $("#modal_crear_reader").modal("show");	
});
  // AGREGAR INCIDENCIA ACTIVO
  $(document).on("click", "#boton_incidencia_activo", function(e){
	  $("#modal_incidencia_activo").modal("show");	
});
  // AGREGAR INCIDENCIA ACTIVO ALARMA
  $(document).on("click", "#ver_dato_alarma", function(e){
	let id   = $(this).data("id");
	let asset   = $(this).data("asset");
	let comentario	= $(this).data("comentario");
	let planta	= $(this).data("tipo");
	let description   = $(this).data("description");
	let tagepc   = $(this).data("tagepc");
	let tagsite   = $(this).data("tagsite");
	let tagsitefound   = $(this).data("tagsitefound");
	let inventory   = $(this).data("inventory");

	$("#id_alarma").val(id);
	$("#modal_asset_reg_alarm").val(asset);
	$("#modal_comentarios_alarma").val(comentario);
	$('#modal_tipo_alarma > option[value="' + planta + '"]').attr('selected', 'selected');


	$("#modal_description_reg").val(description);
	$("#modal_tagepc_reg").val(tagepc);
	$("#modal_tagsite_reg").val(tagsite);
	$("#modal_tagsitefound_reg").val(tagsitefound);
	$("#modal_inventory_reg").val(inventory);

	$("#modal_reg_inc_alarma").modal("show");	
});
// MOSTRAL MODAL READER
$(document).on("click", "#ver_dato_reader", function(e){
	let id   = $(this).data("id");
	let mac   = $(this).data("mac");
	let dns   = $(this).data("dns");
	let ip   = $(this).data("ip");
	let mask   = $(this).data("mask");
	let planta   = $(this).data("planta");
	let columna   = $(this).data("columna");
	let app   = $(this).data("app");
	let loc   = $(this).data("loc");
	let marca   = $(this).data("marca");
	let modelo   = $(this).data("modelo");
	let gateway   = $(this).data("gateway");
	let tx   = $(this).data("tx");
	
	$("#id_reader").val(id);
	$("#modal_mac_read_upd").val(mac);
	$("#modal_dns_read_upd").val(dns);
	$('#modal_planta_read_upd > option[value="'+planta+'"]').attr('selected', 'selected');
	$('#modal_columna_read_upd > option[value="'+columna+'"]').attr('selected', 'selected');
	$("#modal_loc_read_upd").val(loc);
	$("#modal_ip_read_upd").val(ip);
	$("#modal_mask_read_upd").val(mask);
	$("#modal_gateway_read_upd").val(gateway);
	$("#modal_app_read_upd").val(app);
	$("#modal_marca_read_upd").val(marca);
	$("#modal_modelo_read_upd").val(modelo);
	$("#modal_tx_read_upd").val(tx);
	
	$("#modal_ver_reader").modal("show");	
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
	$("#f1export").attr("disabled", false);	
	$("#cls_start_inv").attr("disabled", false);	
});
$(document).on("click", "#finsa3_stop_inv", function(e){
	$("#chartdiv3").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#finsa3_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#oradel_start_inv").attr("disabled", false);	
	$("#f3export").attr("disabled", false);	

	$("#cls_start_inv").attr("disabled", false);	
});

$(document).on("click", "#oradel_stop_inv", function(e){
	$("#chartdiv4").css("display", "none");
	$("#chartdiv").css("display", "block");	
	$("#oradel_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#finsa3_start_inv").attr("disabled", false);	
	$("#oradelexport").attr("disabled", false);	

	$("#cls_start_inv").attr("disabled", false);	
});

$(document).on("click", "#cls_stop_inv", function(e){
	$("#chartdiv5").css("display", "none");;
	$("#chartdiv").css("display", "block");	
	$("#cls_stop_inv").css("display", "none");	
	
	$("#finsa1_start_inv").attr("disabled", false);	
	$("#finsa3_start_inv").attr("disabled", false);	
	$("#oradel_start_inv").attr("disabled", false);
	$("#clsexport").attr("disabled", false);	

});

let startDate = document.getElementById('startDate')
let endDate = document.getElementById('endDate')

if (startDate) {
	startDate.addEventListener('change',(e)=>{
	  let startDateVal = e.target.value
	//   document.getElementById('startDateSelected').innerText = startDateVal
	  document.getElementById('startDateSelected').value = startDateVal
	})
}
if (endDate) {
	endDate.addEventListener('change',(e)=>{
	  let endDateVal = e.target.value
	//   document.getElementById('endDateSelected').innerText = endDateVal
	  document.getElementById('endDateSelected').value = endDateVal
	})  
}


//CAMBIO DE SELECT PARA REGISTRAR INCIDENCIAS EN ASSET
let asset = document.getElementById('modal_asset_reg');
if(asset){
	asset.addEventListener('change',(e)=>{
		let assetVal = e.target.value
		// document.getElementById('modal_nombre_reg').value = assetVal
	
		$data = {
			"asset" : assetVal,
			"action": 'ver_asset'
		}
	
		$.ajax ({
			url         : './ajax/alarmaAjax.php',
			type      : 'POST',
			data        : {"asset" : assetVal},
			success     : function(response){
				let data=$.parseJSON(response); //parse response string
				let json = JSON.stringify(data.resp);
	
				description = data.description;
				dateinv = data.dateinventory;
	
				$("#modal_description_reg").val(description);
			}
		  });	
	  }); 
}

//codigo para mostrar imagen al seleccionar un activo 
const avatarInput = document.querySelector('#avatarInput');
const avatarName = document.querySelector('.input-file__name');
const imagePreview = document.querySelector('.image-preview');


if (avatarInput) {
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
}