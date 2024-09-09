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
  $query = "SELECT * FROM general WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre_persona = $row['nombre_persona'];
    $apellido_persona = $row['apellido_persona'];
    $edad_persona = $row['edad_persona'];
    $estado_persona = $row['estado_persona'];
    $nombre_proyecto = $row['nombre_proyecto'];
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

  $query = "UPDATE general 
            SET nombre_persona = '$nombre_persona', 
                apellido_persona = '$apellido_persona', 
                edad_persona = '$edad_persona', 
                estado_persona = '$estado_persona', 
                nombre_proyecto = '$nombre_proyecto', 
                fecha_registro = '$fecha_registro' 
            WHERE id = $id";
  
  mysqli_query($conn, $query);
  
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
