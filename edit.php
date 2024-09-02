<?php
include("db.php");
$title = '';
$description= '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM general WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    // $title = $row['title'];
    // $description = $row['description'];
    $nombre_persona = $_POST['nombre_persona'];
    $apellido_persona = $_POST['apellido_persona'];
    $edad_persona = $_POST['edad_persona'];
    $estado_persona = $_POST['estado_persona']; //? 1 : 0;
    $nombre_proyecto =$_POST['nombre_proyecto'];
    $fecha_registro = $_POST['fecha_registro'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  //$title= $_POST['title'];
  //$description = $_POST['description'];
    $nombre_persona = $_POST['nombre'];
    $apellido_persona = $_POST['apellido_persona'];
    $edad_persona = $_POST['edad_persona'];
    $estado_persona = $_POST['estado_persona'];//? 1 : 0;
    $nombre_proyecto =$_POST['nombre_proyecto'];
    $fecha_registro = $_POST['fecha_registro'];

  $query = "UPDATE general set nombre_persona = '$nombre_persona', apellido_persona = '$apellido_persona', edad_persona= '$edad_persona', estado_persona='$estado_persona', nombre_proyecto='$nombre_proyecto', fecha_registro='$fecha_registro' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
        </div>
        <div class="form-group">
        <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>