<?php
require_once ("./models/usermodel.php");


class Usercontroller{
    public function tabla_usuarios(){
        $rsp = UserModel::ver_usuarios();
        if (empty($rsp)) {
          $elemento  = '<div class="box-cont-negro titulo-box m-0">';
          $elemento .= '<h4>No se han cargado datos<hr><small>Esperando Registros de Movimientos</small></h4>';
          $elemento .= '</div>';
          echo $elemento;
        
        } else {
            $tabla  = '<table class="table table-striped table-dark salidas-tabla dt_active">';
            $tabla .= '<thead>';
            $tabla .= '<tr>';
            $tabla .= '<th scope="col">#</th>';
            $tabla .= '<th scope="col">Nombre</th>';       // Fecha
            $tabla .= '<th scope="col">Usuario</th>';        // Tipo
            $tabla .= '<th scope="col">Email</th>';        // Tipo
            $tabla .= '<th scope="col">Rol</th>';     // Nombre
            $tabla .= '<th scope="col">Fecha</th>';          // Nombre
            $tabla .= '<th scope="col">Acciones</th>';          // Nombre
            $tabla .= '</tr>';
            $tabla .= '</thead>';
            $tabla .= '<tbody>';
            $i = 0;

            foreach ($rsp as $dato) {
              $i++;
              $tabla .= '<tr class="elemento">';
              $tabla .= '<td scope="col">' . $i . '</td>';
              $tabla .= '<td scope="col" class="salida">' . $dato['UserName'] . '</td>';
              $tabla .= '<td scope="col" class="lote">' . $dato['UserNickname'] . '</td>';
              $tabla .= '<td scope="col" class="lote">' . $dato['UserEmail'] . '</td>';
              $tabla .= '<td scope="col" class="lote">' . $dato['UserRole'] . '</td>';
              $tabla .= '<td scope="col" class="lote">' . $dato['FechaCreacion'] . '</td>';
              $tabla .= '<td><a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" href="' . SERVERURL . 'editarusuario/"><i class="bx bx-edit nav_icon" aria-hidden="true" style="font-size:20px"></i></a></td>';
              
              $tabla .= '</tr>';
            }
            $tabla .= '</tbody>';
            $tabla .= '</table>';
            echo $tabla;
          }
  }
}