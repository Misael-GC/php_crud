<?php
include("db.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Eliminar registros dependientes primero
    $deleteDependent = "DELETE FROM his_personas_proyecto WHERE id_cat_personas = '$id'";
    
    $resultDependent = mysqli_query($conn, $deleteDependent);
    if(!$resultDependent){
        die("Error al eliminar registros dependientes");
    }

    $query = "DELETE FROM cat_personas WHERE id = '$id'"; //CAMBIADO
    //$query = "DELETE FROM general WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Eliminado';
    $_SESSION['message_type'] = 'danger';
    header("Location: index.php");
}
?>