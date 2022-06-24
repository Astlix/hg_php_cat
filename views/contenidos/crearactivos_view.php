

<h2>CREAR ACTIVO</h2>
<br/>

<form class="form-group FormularioAjax" action="<?php echo SERVERURL; ?>ajax/activoAjax.php" method="POST" data-form="save">


    <div class="row">
        <div class="col-md-6">
            <label for="nombre">Asset</label>
            <input type="text" class="form-control" id="asset" name="asset_reg" required>
        </div>
        <div class="col-md-6">
            <label for="nombre">Descripción</label>
            <input type="text" class="form-control" id="desc" name="desc_reg" required>
        </div>
    </div>
    <div class="row">
        <label for="nombre">Ubicación</label>
        <div class="col">
            <select class="form-select" name="planta_reg" aria-label="Default select example" title="Planta" required>
                <option value="01" selected>Finsa1</option>
                <option value="02">Finsa3</option>
                <option value="03">Oradel</option>
                <option value="04">CLS</option>
            </select>
        </div>-
        <div class="col">
            <select class="form-select" name="columna_reg" aria-label="Default select example" title="Columna" required>
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
            <select class="form-select" name="num_col_reg" aria-label="Default select example" title="Número de la Coumna" required>
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
    <div class="col-6">
        <label for="nombre">Servicio 1</label>
        <input type="text" class="form-control" id="serv_1_reg" name="serv_1_reg" >
    </div>
    <div class="col-6">
        <label for="nombre">Servicio 2</label>
        <input type="text" class="form-control" id="serv_2_reg" name="serv_2_reg" >
    </div>
</div>
<div class="row">
    <div class="col-6">
        <label for="nombre">Servicio 3</label>
        <input type="text" class="form-control" id="serv_3_reg" name="serv_3_reg" >
    </div>
    <div class="col-6">
        <label for="nombre">Servicio 4</label>
        <input type="text" class="form-control" id="serv_4_reg" name="serv_4_reg" >
    </div>
</div>
<div class="row">
    <div class="col-12">
        <label for="nombre">Servicio 5</label>
        <input type="text" class="form-control" id="serv_5_reg" name="serv_5_reg" >
    </div>
</div>
<br>

<div class="row justify-content-around">
    <button type="submit" class="btn btn-primary col-3">Agregar</button>
</div>
</form>
