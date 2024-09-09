<?php

// Asegura que las sesiones solo se envíen por HTTPS y no sean accesibles por JavaScript
ini_set('session.cookie_secure', 1);  // Solo permite que las cookies se transmitan por HTTPS
ini_set('session.cookie_httponly', 1); // La cookie no es accesible desde JavaScript (previene XSS)
ini_set('session.use_strict_mode', 1); // No acepta identificadores de sesión no válidos (previene ataques de fijación de sesión)

// Opcional: puedes deshabilitar las sesiones en la URL para evitar que se filtren en URLs
ini_set('session.use_only_cookies', 1);

session_start(); //inicio una sesion y se guardan los datos

// Regenerar el ID de sesión después del login o eventos importantes (para evitar fijación de sesión)
if (!isset($_SESSION['user_logged_in'])) {
    session_regenerate_id(true);  // Regenerar el ID para sesiones nuevas o cambios de privilegios
}


// Verificar si el usuario está autenticado
// if (isset($_SESSION['usuario'])) {
//     echo "Bienvenido, " . $_SESSION['usuario'];
// } else {
//     echo "Por favor, inicia sesión.";
// }

// // Cerrar sesión de forma segura
// function cerrarSesion() {
//     session_unset();  // Eliminar todas las variables de sesión
//     session_destroy(); // Destruir la sesión actual
//     setcookie(session_name(), '', time() - 3600, '/'); // Eliminar la cookie de sesión
// }
  

$conn = mysqli_connect(
    'localhost',
    'root',
    "Misael_12",
    'bd'
);

// if(isset($conn)){
//     echo "Connected :)";
// }
// else{
//     echo "Not Connected";
// }

