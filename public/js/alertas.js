const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let data = new FormData(this);
    let method= this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezados = new Headers();

    let config = {
      method: method,
      headers: encabezados,
      mode: 'cors',
      cache: 'no-cache',
      body: data
    }

    let text_alerta;
    
    if (tipo==="save") {
      texto_alerta = "Los datos quedaran guardados en el sistema.";
    }else if(tipo==="delete"){
      texto_alerta = "Los datos seran eliminados permanentemente del sistema";
    }else if(tipo==="update"){
      texto_alerta = "Los datos seran actualizados permanentemente.";
    }else if(tipo==="search"){
      texto_alerta = "Se eliminara el termino de busqueda y tendras que escribir uno nuevo.";
    }else if(tipo==="loans"){
      texto_alerta = "Desea eliminar los registros seleccionados.";
    }else{
      texto_alerta = "Quieres realizar la operacion solicitada.";
    }

    swal({
      title: '¿Estas seguro?',
      text: texto_alerta,
      icon: 'info',
      buttons: {
        cancel: {
          text: "Cancelar",
          value: null,
          visible: true,
          className: "warning",
          closeModal: true,
        },
        confirm: {
          text: "Aceptar",
          value: true,
          visible: true,
          className: "",
          closeModal: true
        }
      }
    }).then((result) => {
      if (result) {
        fetch(action,config) //agregamos los datos del formulario
        .then(respuesta => respuesta.json()) //convetimos los datos a json
        .then(respuesta => {
          return alertas_ajax(respuesta);
        });
      }
    })


}

formulario_ajax.forEach(formularios =>{
formularios.addEventListener("submit",enviar_formulario_ajax);
});

function alertas_ajax(alerta){ //alerta sera un archibo json 
    if(alerta.Alerta==="simple"){ //mensajes generales 
         swal({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            button: "Aceptar",
          });
    }else if(alerta.Alerta==="recargar"){ //recargar pagina despues de mandar un formulario
        swal({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            button: 'Aceptar'
          }).then((result) => {
            if (result) {
              location.reload();
            }
          })
    }else if(alerta.Alerta==="limpiar"){ //limpiar formularios
        swal({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            button: 'Aceptar'
          }).then((result) => {
            if (result) {
                location.reload();
            }
          })
    }else if(alerta.Alerta==="redireccionar"){
        Window.location.href = alerta.URL;
    }
}