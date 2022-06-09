<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_usuario" style="display:flex;width:auto;justify-content: space-between;align-items: center;">
        <div class="header_name" style="padding-top: 5px; width: auto; display: flex; justify-content: flex-end;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" style="text-align: end;" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['rol_sca'].' | '. $_SESSION['nickname_sca']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="border-radius: 10px; background-color:#000000">
                                    <li><a class="dropdown-item" href="#" style="display: flex; align-items: center; color: #ffc400e1;" ><i style="padding-right: 5px;color: #ffc400e1;" class='bx bxs-user-detail nav_icon'></i> Perfil</a></li>
                                    <li><a class="dropdown-item" href="#" style="display: flex; align-items: center; color: #ffc400e1;" ><i style="padding-right: 5px;color: #ffc400e1;" class='bx bx-cog nav_icon'></i> Propiedades</a></li>
                                    <li><a class="dropdown-item" href="#" style="display: flex; align-items: center; color: #ffc400e1;" ><i style="padding-right: 5px;color: #ffc400e1;" class='bx bx-log-out nav_icon'></i> Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>

    </div>

</header>