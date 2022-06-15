<!-- NAV LATERAL -->
<div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="index.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i><span class="nav_logo-name">CATERPILLER</span>
                <div class="nav_list">
                    <a href="<?php echo SERVERURL;?>home" class="nav_link" id="home"  title="Home"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Home</span> </a>
                    <a href="<?php echo SERVERURL;?>activos" class="nav_link" title="Activos"> <i class='bx bxs-package nav_icon'></i> <span class="nav_name">Activos</span> </a>
                    <a href="<?php echo SERVERURL;?>equipo" class="nav_link" title="Equipo"> <i class='bx bx-mobile-alt nav_icon'></i> <span class="nav_name">Equipo</span> </a>
                    <a href="<?php echo SERVERURL;?>bitacora" class="nav_link" title="Bitacora"> <i class='bx bx-bar-chart-square nav_icon'></i> <span class="nav_name">Bitacora</span> </a>
                    <a href="<?php echo SERVERURL;?>alarma" class="nav_link" title="Alarma"> <i class='bx bx-timer nav_icon' ></i> <span class="nav_name">Alarma</span> </a>
                    <a href="<?php echo SERVERURL;?>ubicaciones" class="nav_link" title="Ubicaciones"> <i class='bx bx-radar nav_icon' ></i> <span class="nav_name">Ubicaciones</span> </a>
                    <?php if ($_SESSION['rol_sca']=='Admin') {
                    echo'<a href="'. SERVERURL .'usuarios" class="nav_link" title="Usuarios"> <i class="bx bx-user nav_icon"></i> <span class="nav_name">Usuarios</span></a>';
                    }?>
                    
                    <a href="<?php echo SERVERURL;?>correos" class="nav_link" title="Correos"> <i class='bx bx-envelope nav_icon' ></i> <span class="nav_name">Correos</span> </a>
                    <a href="<?php echo SERVERURL;?>readers" class="nav_link" title="Readers"> <i class='bx bx-wifi nav_icon'></i> <span class="nav_name">Readers</span> </a>
                </div>
            </div> <a href="#" class="nav_link close"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Cerrar Sesión</span> </a>
        </nav>
    </div>