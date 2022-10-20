<!-- Modal para ver registros-->
<div class="modal fade" id="ver_registro" tabindex="-1" aria-labelledby="ver_registro2" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Ver Activo </h5>
        <button id="form_activar" class="btn btn-primary" style="width:50px;margin-left: 10px;"><i class="bx bx-edit-alt"></i></button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/activoAjax.php" method="POST" data-form="update">

          <!-- este  input es el que almacena el id para que el sistema sepa que se trata de un update -->

          <input type="hidden" class="form-control" name="activo_id_upd" id="activo_id_upd">

          <div class="input-file-container">
            <!-- <div class="input-file" style="cursor: pointer;visibility:hidden;" id="inputimg">
              <p class="input-file__name">Selecciona una imagen...</p>
              <button type="button" class="input-file__button">
                <i class='bx bx-upload'></i>
              </button>
              <input type="file" class="form-control" accept="image/png,image/jpeg" name="avatar" id="avatarInput">
            </div> -->
            <img src="https://i.ibb.co/0Jmshvb/no-image.png" class="image-preview" alt="preview image" id="imagen">
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="nombre">Asset</label>
              <input type="text" class="form-control" id="modal_asset_upd" name="asset_upd" required disabled>
            </div>
            <div class="col-md-6">
              <label for="nombre">Descripción</label>
              <input type="text" class="form-control" id="modal_desc_upd" name="desc_upd" required disabled>
            </div>
            <div class="col-md-6">
              <label for="nombre">Numero Serial</label>
              <input type="text" class="form-control" id="modal_num_serial_upd" name="num_serial_upd" value="" required disabled>
            </div>
            <div class="col-md-6">
              <label for="nombre">Tag EPC</label>
              <input type="text" class="form-control" id="modal_epc_upd" name="epc_upd" value="" required disabled>
            </div>
            <div class="col-md-6">
              <label for="nombre">Tag EPC Found</label>
              <input type="text" class="form-control" id="modal_tagfind_upd" name="tagfind_upd" value="" required disabled>
            </div>
          </div>
          <div class="row">
            <label for="nombre">Ubicación</label>
            <div class="col">
              <select class="form-select" id="modal_planta_upd" name="planta_upd" aria-label="Default select example" title="Planta" value="03" required disabled>
                <option value="01">Finsa1</option>
                <option value="02">Finsa3</option>
                <option value="03">Oradel</option>
                <option value="04">CLS</option>
              </select>
            </div>-
            <div class="col">
              <select class="form-select" id="modal_columna_upd" name="columna_upd" aria-label="Default select example" title="Columna" required disabled>
                <option value="01" selected>A</option>
                <option value="02">B</option>
                <option value="03">C</option>
                <option value="04">D</option>
                <option value="05">E</option>
                <option value="06">F</option>
                <option value="07">G</option>
                <option value="08">H</option>
                <option value="09">I</option>
                <option value="10">J</option>
                <option value="11">K</option>
                <option value="12">L</option>
                <option value="13">M</option>
                <option value="14">N</option>
                <option value="15">O</option>
                <option value="16">P</option>
                <option value="17">Q</option>
                <option value="18">R</option>
              </select>
            </div>-
            <div class="col">
              <select class="form-select" id="modal_num_upd" name="num_col_upd" aria-label="Default select example" title="Número de la Coumna" required disabled>
                <option value="01" selected>1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="nombre">Fecha de Inventario</label>
              <input type="datetime" class="form-control" id="modal_date_upd" name="date_upd" disabled>
            </div>
          </div>
          <br>

          <div class="row justify-content-around">
            <button type="submit" id="btn_act_upd" class="btn btn-success col-4" style="cursor: pointer;visibility:hidden;">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal  activos detalles -->
<div class="modal fade" id="activos_detalles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activos Específicos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="datos_activos"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Ver Correo -->
<div class="modal fade" id="ver_correo" tabindex="-1" aria-labelledby="ver_correo" aria-hidden="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" >Editar Cuenta de Correo Electrónico </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/correoAjax.php" method="POST" data-form="update">

          <!-- este  input es el que almacena el id para que el sistema sepa que se trata de un update -->

          <input type="hidden" class="form-control" name="correo_id_upd" id="correo_id_upd">

          <div class="row">
            <div class="col-md-12">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="modal_nombre_upd" name="nombre_upd" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Apellido Paterno</label>
              <input type="text" class="form-control" id="modal_apellidop_upd" name="apellidop_upd" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Apellido Materno</label>
              <input type="text" class="form-control" id="modal_apellidom_upd" name="apellidom_upd" value="" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Correo Electrónico</label>
              <input type="email" class="form-control" id="modal_correo_upd" name="correo_upd" value="" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Estado</label>
              <div class="col-md-12">
                <select class="form-select" id="modal_estado_upd" name="estado_upd" aria-label="Default select example" title="Planta" value="03" required>
                  <option value="1">Activo </option>
                  <option value="0">Bloqueado</option>
                </select>
              </div>
              <br>

              <div class="row justify-content-around">
                <button type="submit" id="btn_act_upd" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around;">Actualizar <i class='bx bx-refresh' style="font-size: 25px;"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ver HH Detalles -->
<div class="modal fade" id="ver_hh" tabindex="-1" aria-labelledby="ver_hh" aria-hidden="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="ver_hhlabel">Editar Datos de Hand Held </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="update">

          <!-- este  input es el que almacena el id para que el sistema sepa que se trata de un update -->

          <input type="hidden" class="form-control" name="hh_id_upd" id="hh_id_upd">

          <div class="row">
            <div class="col-md-12">
              <label for="nombre">MAC</label>
              <input type="text" class="form-control" id="modal_mac_upd" name="mac_upd" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Marca</label>
              <input type="text" class="form-control" id="modal_marca_upd" name="marca_upd" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Modelo</label>
              <input type="text" class="form-control" id="modal_modelo_upd" name="modelo_upd" value="" required>
            </div>
              <br>

            <div class="row justify-content-around">
                <button type="submit" id="btn_hh_upd" class="btn btn-success col-4" style="cursor: pointer; margin-top:10px;display: flex;justify-content: space-around;">Actualizar <i class='bx bx-refresh' style="font-size: 25px;"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar Reader -->
<div class="modal fade hh" id="modal_ver_reader" tabindex="-1" aria-labelledby="crear_read" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="crear_read">Editar Reader </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="save">
          <div class="row">
            <div class="col-md-12">
              <label for="nombre">MAC</label>
              <input type="hidden" id="id_reader" name="id_reader_upd">
              <input type="text" class="form-control" id="modal_mac_read_upd" name="mac_read_upd" title="MAC" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">DNSName</label>
              <input type="text" class="form-control" id="modal_dns_read_upd" name="dns_read_upd" title="Marca" required>
            </div>
            <!-- //ubicacion -->
            <div class="row"> 
              <label for="nombre">Ubicación</label>
              <div class="col-md-6">
                <select class="form-control" id="modal_planta_read_upd" name="planta_read_upd" title="Planta" required>
                  <option value="f1">Finsa 1</option>
                  <option value="f3">Finsa 3</option>
                  <option value="or">Oradel</option>
                  <option value="cls">CLS</option>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="modal_columna_read_upd" name="columna_read_upd" title="Columna" required>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                  <option value="G">G</option>
                  <option value="H">H</option>
                  <option value="I">I</option>
                  <option value="J">J</option>
                  <option value="L">L</option>
                  <option value="M">M</option>
                  <option value="N">N</option>
                  <option value="O">O</option>
                  <option value="P">P</option>
                  <option value="Q">Q</option>
                  <option value="R">R</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <label for="nombre">Locación</label>
              <input type="text" class="form-control" id="modal_loc_read_upd" name="loc_read_upd" title="Locación" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">IPAdress</label>
              <input type="text" class="form-control" id="modal_ip_read_upd" name="ip_read_upd" title="IpAddress" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">SubnetMask</label>
              <input type="text" class="form-control" id="modal_mask_read_upd" name="mask_read_upd" title="SubnetMask" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Gateway</label>
              <input type="text" class="form-control" id="modal_gateway_read_upd" name="gateway_read_upd" title="Gateway" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">App</label>
              <input type="text" class="form-control" id="modal_app_read_upd" name="app_read_upd" title="Gateway" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Tx Power</label>
              <input type="text" class="form-control" id="modal_tx_read_upd" name="tx_read_upd" title="Tx Power" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Marca</label>
              <input type="text" class="form-control" id="modal_marca_read_upd" name="marca_read_upd" title="Marca" required>
            </div>
            <div class="col-md-12">
              <label for="nombre">Modelo</label>
              <input type="text" class="form-control" id="modal_modelo_read_upd" name="modelo_read_upd" title="Modelo" required>
            </div>
              <br><br>
            <div class="row justify-content-around">
                <button type="submit" id="btn_upd_read_reg" class="btn btn-success col-4" style="cursor: pointer;display: flex;justify-content: space-around; margin-top:10px">Actualizar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

