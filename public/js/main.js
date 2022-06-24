
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
    $("#ver_registro").modal("show");
  });
