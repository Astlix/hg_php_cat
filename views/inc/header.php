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
                                    <li><a class="dropdown-item" href="#" style="display: flex; align-items: center; color: #ffc107;" ><i style="padding-right: 5px;color: #ffc400e1;" class='bx bx-code-alt nav_icon'></i> Acerca del Software</a></li>
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