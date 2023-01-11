repetirCadaSegundo();
function repetirCadaSegundo() {
    Intervalo = setInterval(activar, 1000);
  }

  function activar(){
      
      // VERIFICAMOS SI EXISTE EL ELEMENTO EN EL DOM PARA EJECUTAR EL TIEMPO REAL
      var status ="readers";
  
      $.ajax({
          data: {"status" : status},
          url: "./views/realtime.php",
          type: "post",
          success:  function (response) {
    if (document.getElementById('tabla')) {
      data=$.parseJSON(response); //parse response string
      let json = JSON.stringify(data.resp);
      //tabla
      tabla = data.datos;
        document.getElementById('tabla').innerHTML = tabla;
       console.log('Pintar Tabla');

    }else{
        console.log('No existe en el DOM');
        clearInterval(Intervalo);
    }
    }  
    });
};


// KEEP ALIVE
repetir_keep();
function repetir_keep() {
    keep = setInterval(keep, 10000);//60000 = 60 segundos
  }

  function keep(){
    var status ="keep_alive";

        $.ajax({
        data: {"status" : status},
        url: "./views/realtime.php",
        type: "post",
        success:  function (response) {
        // data=$.parseJSON(response); //parse response string
       console.log('Proceso Keep Funcionando');
  }
   });

   if (document.getElementById('tabla')) {

}else{
    // console.log('No existe en el DOM');
    clearInterval(keep);
}

    };
 