<?php
include("db.php");

?>

<?php include("includes/header.php"); ?>


<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?>
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
        <div class="col-md-8 ">
            <table class="table table-bordered">
                <tread>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Activo</th>
                        <th>Proyecto</th>
                        <th>Fecha de Registro</th>
                        <th>Actions</th>
                    </tr>
                </tread>
                <tbody>
                    <?php 
                       //$query = "SELECT * FROM cat_personas"; //cambio
                       $query = "SELECT cp.id, cp.nombre as nombre_p, cp.apellido, cp.edad, cp.estado, cpt.nombre, hpp.fecha_registro 
                       FROM cat_personas cp
                       INNER JOIN his_personas_proyecto hpp ON cp.id = id_cat_personas
                       INNER JOIN cat_proyecto cpt ON hpp.id_cat_proyecto = cpt.id;"; //cambio
                       //$query = "SELECT * FROM general";
                        $result_logs = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($result_logs)){
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre_p']; ?></td>
                            <td><?php echo $row['apellido']; ?></td>
                            <td><?php echo $row['edad']; ?></td>
                            <td><?php echo $row['estado']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['fecha_registro']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary p-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>