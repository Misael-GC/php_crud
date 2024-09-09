<?php

include('db.php');

if(isset($_POST['save'])){
    $nombre_persona = $_POST['nombre_persona'];
    $apellido_persona = $_POST['apellido_persona'];
    $edad_persona = $_POST['edad_persona'];
    $estado_persona = $_POST['estado_persona'] ? 1 : 0;
    $nombre_proyecto =$_POST['nombre_proyecto'];
    $fecha_registro = $_POST['fecha_registro'];

    /*
    $query = "INSERT INTO general(nombre_persona, apellido_persona,  edad_persona, estado_persona, nombre_proyecto, fecha_registro) VALUES('$nombre_persona', '$apellido_persona', '$edad_persona', '$estado_persona', '$nombre_proyecto', '$fecha_registro')";
    
    $result1 = mysqli_query($conn, $query);
    if(!$result1){
        die("Query failed". mysqli_error($conn));
    }
    */

    $query1 = "INSERT INTO cat_personas(nombre, apellido,  edad, estado) VALUES('$nombre_persona', '$apellido_persona', '$edad_persona', '$estado_persona')";

     $result1 = mysqli_query($conn, $query1);
     if(!$result1){
         die("Query failed". mysqli_error($conn));
     }
     //Obtener el ID generado automáticamente para la tabla 'general'
     $id_persona = mysqli_insert_id($conn);

     $query2 = "INSERT INTO cat_proyecto(nombre) VALUES('$nombre_proyecto')";

      ///Ejecutar la segunda consulta
     $result2 = mysqli_query($conn, $query2);

     if (!$result2) {
         die("Error al insertar en la tabla 'proyectos': " . mysqli_error($conn));
     }
     $id_proyecto = mysqli_insert_id($conn);

     /// **Tercer INSERT en la tabla 'relaciones'**
      ///Suponiendo que la tabla 'relaciones' tiene columnas: id (autoincremental), id_persona, id_proyecto, fecha_registro
     $query3 = "INSERT INTO his_personas_proyecto(id_cat_personas, id_cat_proyecto, fecha_registro) 
                VALUES('$id_persona', '$id_proyecto', '$fecha_registro')";

     $result3 = mysqli_query($conn, $query3);

     if (!$result3) {
         die("Error al insertar en la tabla 'relaciones': " . mysqli_error($conn));
     }

    
    $_SESSION['message'] = 'Task Saved succesfully';
    $_SESSION['message_type'] = 'success';
    ///redireccionar
    header("Location: index.php");

}