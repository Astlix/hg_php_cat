<script>
    let btn_salida=document.querySelector(".close");

    btn_salida.addEventListener('click',function(e){
        e.preventDefault();
        swal({
            title: "¿Estas seguro de dalir del sistema?",
            text: "La sesion actual se cerrara y saldras del sistema.",
            icon: "info",
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
            },
            dangerMode: true,
            })
            .then((result) => {
            if (result) {
                let url='<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $lc->encryption($_SESSION['token_sca']); ?>';
                let usuario = '<?php echo $lc->encryption($_SESSION['nickname_sca']); ?>';

                let data = new FormData();
                data.append("token",token);
                data.append("usuario",usuario);
                fetch(url,{
                    method: 'POST',
                    body: data
                }) //agregamos los datos del formulario
                .then(respuesta => respuesta.json()) //convetimos los datos a json
                .then(respuesta => {
                return alertas_ajax(respuesta);
                });
            }
            });

    });

</script>