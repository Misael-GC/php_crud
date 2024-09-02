<?php
include("db.php");

?>

<?php include("includes/header.php"); ?>


<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-body">
                <form action="save.php" method="POST">
                    <div class="form-group p-2">
                        <input type="text" name="nombre_persona" class="form-control" placeholder="Escribe el nombre de la persona" autofocus>
                    </div>
                    <div class="form-group p-2">
                        <input type="text" name="apellido_persona"  class="form-control" placeholder="Escribe el apellido"></input>
                    </div>
                    <div class="form-group p-2">
                        <input type="number" name="edad_persona"  class="form-control" placeholder="Escribe la edad"></input>
                    </div>
                    <div class="form-group p-2">
                        <label for="estado_persona">Activo</label>
                        <input type="checkbox" name="estado_persona" id="estado_persona" value="1" class="form-check-input">
                    </div>
                    <div class="form-group p-2">
                        <input type="text" name="nombre_proyecto"  class="form-control" placeholder="Escribe el nombre del proyecto"></input>
                    </div>

                    <div class="form-group p-2">
                        <label for="fecha_registro">Fecha de Registro</label>
                        <input type="datetime-local" name="fecha_registro" class="form-control" placeholder="Selecciona la fecha y hora">
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="save" value="Save task">
                </form>
            </div>
        </div>
        <div class="col-md-8 "></div>
    </div>
</div>

<?php include("includes/footer.php"); ?>