const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();
}

formulario_ajax.forEach(formularios =>{
formularios.addEventListener("submit",enviar_formulario_ajax);
});

function alertas_ajax(alerta){
    if(alerta.Alerta==="simple"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: "Aceptar",
          });
    }else if(alerta.Alerta==="recargar"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })
    }else if(alerta.Alerta==="limpiar"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
          })
    }else if(alerta.Alerta==="redireccionar"){
        Window.location.href = alerta.URL;
    }
}