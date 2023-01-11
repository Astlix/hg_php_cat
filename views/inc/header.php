<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_usuario" style="display:flex;width:auto;justify-content: space-between;align-items: center;">
        <div class="header_name" style="padding-top: 5px; width: auto; display: flex; justify-content: flex-end;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" style="text-align: end;color:black" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['nombre_sca']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="border-radius: 10px; background-color:black">
                                <h5 class="mb-2" style="color:#fff;text-align:center;"><strong> <?php echo $_SESSION['nickname_sca']; ?></strong></h5>
                                <p class="text-muted" style="text-align:center;"><span class="badge bg-primary"> <?php echo $_SESSION['rol_sca'] ?></span></p>
                                    <li><a class="dropdown-item" id="acerca" style="display: flex; align-items: center; color: #ffc107; cursor:pointer;" ><i style="padding-right: 5px;color: #ffc400e1;" class='bx bx-message-alt-error nav_icon'></i> Acerca del Software</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="header_img"><img src="<?php echo SERVERURL;?>public/img/avatar.png" alt=""> </div>

    </div>

</header>

<!-- Modal  acerca de -->
<div class="modal fade" id="acercade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Software Central RFID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="display:flex;flex-direction:column;align-items:center;">
        <div class="texto1">
          <h4>Astlix S.A. de C.V.</h4>
        </div>
        <div class="img" style="display:flex;justify-content:center;margin-botton:15px !important;">
          <img src="./public/img/astlix.png" alt="" style="width:30%;">
        </div>
        <div class="texto2" style="display:flex;justify-content:center;flex-direction:column;align-items:center;">
          <p style="line-height:0.2;margin-top:15px">Version 1.0.0</p>
          <p style="line-height:0.2;">Derechos Reservados 2022</p>
          <hr>
          Para soporte:
          <a href="mailto:soporte@astlix.com">soporte@astlix.com</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>