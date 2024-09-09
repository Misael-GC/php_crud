<?php
include("db.php");

// Inicializamos las variables para evitar errores
$nombre_persona = '';
$apellido_persona = '';
$edad_persona = '';
$estado_persona = '';
$nombre_proyecto = '';
$fecha_registro = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  //$query = "SELECT * FROM general WHERE id=$id";
  $query = "SELECT cp.id, cp.nombre as nombre_p, cp.apellido, cp.edad, cp.estado, cpt.nombre, hpp.fecha_registro 
            FROM cat_personas cp
            INNER JOIN his_personas_proyecto hpp ON cp.id = id_cat_personas
            INNER JOIN cat_proyecto cpt ON hpp.id_cat_proyecto = cpt.id WHERE cp.id=$id";

  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre_persona = $row['nombre_p'];
    $apellido_persona = $row['apellido'];
    $edad_persona = $row['edad'];
    $estado_persona = $row['estado'];
    $nombre_proyecto = $row['nombre'];
    $fecha_registro = $row['fecha_registro'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nombre_persona = $_POST['nombre_persona'];
  $apellido_persona = $_POST['apellido_persona'];
  $edad_persona = $_POST['edad_persona'];
  $estado_persona = isset($_POST['estado_persona']) ? 1 : 0;
  $nombre_proyecto = $_POST['nombre_proyecto'];
  $fecha_registro = $_POST['fecha_registro'];

  // $query2 = "UPDATE general 
  //           SET nombre_persona = '$nombre_persona', 
  //               apellido_persona = '$apellido_persona', 
  //               edad_persona = '$edad_persona', 
  //               estado_persona = '$estado_persona', 
  //               nombre_proyecto = '$nombre_proyecto', 
  //               fecha_registro = '$fecha_registro' 
  //           WHERE id = $id";
  
  // mysqli_query($conn, $query2);
  
   // Actualiza la tabla cat_personas
  $query1 = "UPDATE cat_personas 
  SET nombre = '$nombre_persona', 
      apellido = '$apellido_persona', 
      edad = '$edad_persona', 
      estado = '$estado_persona' 
  WHERE id = $id";

  mysqli_query($conn, $query1);

  // Actualiza la tabla his_personas_proyecto (si quieres actualizar la fecha)
  $query2 = "UPDATE his_personas_proyecto 
    SET fecha_registro = '$fecha_registro'
    WHERE id_cat_personas = $id";

  mysqli_query($conn, $query2);

  // Actualiza la tabla cat_proyecto (solo si cambias el proyecto, necesitarías el ID del proyecto)
  // Aquí asumo que el nombre del proyecto es único. Si no lo es, deberías manejar la actualización
  // por id_cat_proyecto en lugar de solo el nombre.
  $query3 = "UPDATE cat_proyecto 
    SET nombre = '$nombre_proyecto'
    WHERE id = (
        SELECT id_cat_proyecto FROM his_personas_proyecto WHERE id_cat_personas = $id
    )";

  mysqli_query($conn, $query3);

  $_SESSION['message'] = 'Datos actualizados correctamente';
  $_SESSION['message_type'] = 'info';
  
  header('Location: index.php');
}

?>

<?php include('includes/header.php'); ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group p-2">
            <input type="text" name="nombre_persona" class="form-control" value="<?php echo $nombre_persona; ?>" placeholder="Escribe el nombre de la persona" autofocus>
          </div>
          <div class="form-group p-2">
            <input type="text" name="apellido_persona" class="form-control" value="<?php echo $apellido_persona; ?>" placeholder="Escribe el apellido">
          </div>
          <div class="form-group p-2">
            <input type="number" name="edad_persona" class="form-control" value="<?php echo $edad_persona; ?>" placeholder="Escribe la edad">
          </div>
          <div class="form-group p-2">
            <label for="estado_persona">Activo</label>
            <input type="checkbox" name="estado_persona" id="estado_persona" value="1" class="form-check-input" <?php echo $estado_persona ? 'checked' : ''; ?>>
          </div>
          <div class="form-group p-2">
            <input type="text" name="nombre_proyecto" class="form-control" value="<?php echo $nombre_proyecto; ?>" placeholder="Escribe el nombre del proyecto">
          </div>
          <div class="form-group p-2">
            <label for="fecha_registro">Fecha de Registro</label>
            <input type="datetime-local" name="fecha_registro" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($fecha_registro)); ?>" placeholder="Selecciona la fecha y hora">
          </div>

          <input type="submit" class="btn btn-success btn-block" name="update" value="Actualizar datos">
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
