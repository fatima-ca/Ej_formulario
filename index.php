<?php
// Configuración de conexión
$hostname = "localhost";
$username = "root";
$password = "eyj2508";
$database = "ejemplo";
$port = "3308";

// Establecer conexión con manejo de errores
$enlace = mysqli_connect($hostname, $username, $password, $database, $port);

// Verificar conexión
if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario</title>
    </head>
    <body>
        <form action="#" name="ejemplo" method="post">
            <input type="text" name="nombre" placeholder="nombre" required>
            <input type="email" name="correo" placeholder="correo" required>
            <input type="text" name="telefono" placeholder="telefono" required>

            <input type="submit" name="registro">
            <input type="reset">
        </form>
    </body>
</html>

<?php
if(isset($_POST["registro"])){
    // Sanitizar entradas
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $telefono = mysqli_real_escape_string($enlace, $_POST['telefono']);
    
    // Validar email
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Formato de correo inválido");
    }

    // Usar prepared statements sería aún mejor
    $insertarDatos = "INSERT INTO datos (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    
    $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);
    
    // Verificar resultado
    if (!$ejecutarInsertar) {
        die("Error al insertar: " . mysqli_error($enlace));
    } else {
        echo "Datos insertados correctamente";
    }
}
?>