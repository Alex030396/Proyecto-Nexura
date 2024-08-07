
<?php
require '../includes/database.php';
$db = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado_id = $_POST['id'];
    $nombre = $_POST['Nombre'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $area = $_POST['Area'];
    $descripcion = $_POST['descripcion'];
    $boletin = isset($_POST['boletin']) ? 1 : 0;
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];

    // Validar los roles para asegurarse de que son enteros entre 1 y 3
    $roles = array_filter($roles, function($rol) {
        return filter_var($rol, FILTER_VALIDATE_INT) !== false && $rol >= 1 && $rol <= 3;
    });

    // Actualizar datos del empleado
    $query = "UPDATE empleados SET nombre='$nombre', email='$email', sexo='$sexo', area_id=$area, boletin=$boletin, descripcion='$descripcion' WHERE id=$empleado_id";
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        // Eliminar roles actuales
        $queryDeleteRoles = "DELETE FROM empleado_rol WHERE empleado_id=$empleado_id";
        mysqli_query($db, $queryDeleteRoles);

        // Insertar nuevos roles
        foreach ($roles as $rol) {
            $queryInsertRoles = "INSERT INTO empleado_rol (empleado_id, rol_id) VALUES ($empleado_id, $rol)";
            mysqli_query($db, $queryInsertRoles);
        }

        echo "Empleado actualizado correctamente";
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="flex container">
        <div>
            <a href="../formulario.php" class="btn btn-primary" role="button"><i class="fa-solid fa-user-plus"></i><span>Crear</span></a>
        </div>
        <div> 
            <a href="../tabla.php" class="enlace">Lista de empleados</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
