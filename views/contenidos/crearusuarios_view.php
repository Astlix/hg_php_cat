

<h2>CREAR USUARIOS</h2>
<br/>

<form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save">

    <div class="form-group">
        <label for="nombre">Nombre de Usuario</label>
        <input type="text" class="form-control" id="nickname" name="nickname_reg" required>
        <small id="emailHelp" class="form-text text-muted">Alias que se usara en la plataforma.</small>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre Completo</label>
        <input type="text" class="form-control" pattern="[a-zA-Z].{1,}" title="El nombre debe ser minusculas o mayusculas." maxlength="35" id="nombre" name="name_reg" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_reg" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Rol</label>
        <!-- <input type="text" class="form-control" id="rol" name="rol_reg" autocomplete="off"> -->
        <select class="form-control" name="rol_reg" aria-label="Default select example">
            <option selected disabled>Seleccione</option>
            <option value="1">Admin</option>
            <option value="2">Guest</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" name="pass_reg" id="pass1" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' required>
        <small class="form-text text-muted">Min 8 caracteres | Un numero | Un caracter especial | Mayusculas | Minusculas</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Repetir Contraseña</label>
        <input type="password" class="form-control" name="cpass_reg" pattern='[a-zA-Z0-9!#$%&"()=@].{7,}' id="cpass_reg" required>
    </div>
    <br />
    <button type="submit" class="btn btn-primary">Agregar</button>
</form>