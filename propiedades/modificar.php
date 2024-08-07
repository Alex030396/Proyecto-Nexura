<?php
require '../includes/database.php';
$db = conectarBD();

// Verificar si hay un ID de empleado en la URL
if (isset($_GET['id'])) {
    $empleado_id = $_GET['id'];

    // Consulta para obtener los datos del empleado
    $query = "SELECT * FROM empleados WHERE id = $empleado_id";
    $result = mysqli_query($db, $query);

    // Verificar si se encontró el empleado
    if ($result && mysqli_num_rows($result) > 0) {
        $empleado = mysqli_fetch_assoc($result);
    } else {
        echo "Empleado no encontrado";
        exit;
    }
} else {
    echo "ID de empleado no proporcionado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
</head>
<body> 
    <div class="container">
        <div class="row">
            <div class="col"><h1>Modificar Empleado</h1></div>
            <div class="col text-end"> <a href="../tabla.php" class="enlace">Lista de empleados</a></div>
        </div>    
        <div class="advertencia">
            <p>Los campos con asteriscos (*) son obligatorios</p>
        </div>
        <form method="post" action="actualizar.php">   
            <!-- Formulario para modificar los usuarios-->
            <div class="formulario">
                <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
                <div class="input">
                    <label for="Nombre" class="label">Nombre completo *</label>
                    <input id="Nombre" name="Nombre" type="text" placeholder="Nombre completo del empleado" class="box" value="<?php echo $empleado['nombre']; ?>">
                </div>
                <div class="input">
                    <label for="email" class="label">Correo electronico *</label>
                    <input id="email" name="email" autocomplete="off" type="email" placeholder="Correo electrónico" class="box" value="<?php echo $empleado['email']; ?>">
                </div>
                <div class="input">
                    <label class="label sex">Sexo *</label>
                    <div class="mas"><input name="sexo" id="Masculino" value="M" type="radio" <?php echo $empleado['sexo'] == 'M' ? 'checked' : ''; ?>><p>Masculino</p></div>
                    <div class="fem"><input name="sexo" id="Femenino" value="F" type="radio" <?php echo $empleado['sexo'] == 'F' ? 'checked' : ''; ?>><p>Femenino </p></div>
                </div>
                <div class="input">
                    <label for="Area" class="label">Area *</label>
                    <select class="box" name="Area" id="Area">
                        <option value="">Seleccionar</option>
                        <option value="1" <?php echo $empleado['area_id'] == 1 ? 'selected' : ''; ?>>Ventas</option>
                        <option value="2" <?php echo $empleado['area_id'] == 2 ? 'selected' : ''; ?>>Calidad</option>
                        <option value="3" <?php echo $empleado['area_id'] == 3 ? 'selected' : ''; ?>>Producción</option>
                        <option value="4" <?php echo $empleado['area_id'] == 4 ? 'selected' : ''; ?>>Administración</option>
                    </select>
                </div>
                <div class="input">
                    <label for="Descripción" class="label">Descripción *</label>
                    <textarea class="textarea" name="descripcion" id="Descripción" placeholder="  Descripción de la experiencia del empleado"><?php echo $empleado['descripcion']; ?></textarea>
                </div>
                <div class="input">
                    <div class="checkbox">
                        <input id="boletin" name="boletin" value="1" type="checkbox" <?php echo $empleado['boletin'] ? 'checked' : ''; ?>><p>Deseo recibir boletín informativo</p>
                    </div>
                </div>
                <div class="input">
                    <label for="roles" class="label rol">Roles *</label>
                    <?php
                    // Consulta para obtener los roles del empleado
                    $queryRoles = "SELECT rol_id FROM empleado_rol WHERE empleado_id = $empleado_id";
                    $resultRoles = mysqli_query($db, $queryRoles);
                    $rolesEmpleado = [];
                    while ($rowRoles = mysqli_fetch_assoc($resultRoles)) {
                        $rolesEmpleado[] = $rowRoles['rol_id'];
                    }
                    ?>
                    <div class="checkbox"><input id="rol1" name="roles[]" type="checkbox" value="1" <?php echo in_array(1, $rolesEmpleado) ? 'checked' : ''; ?>><p>Profesional de proyectos - Desarrollador</p></div>
                    <div class="checkbox"><input id="rol2" name="roles[]" type="checkbox" value="2" <?php echo in_array(2, $rolesEmpleado) ? 'checked' : ''; ?>><p> Gerente estratégico</p></div>
                    <div class="checkbox"><input id="rol3" name="roles[]" type="checkbox" value="3" <?php echo in_array(3, $rolesEmpleado) ? 'checked' : ''; ?>><p> Auxiliar administrativo</p></div>
                </div>
                <div class="input">
                    <input type="submit" value="Actualizar" class="boton" >
                </div>  
            </div>
        </form>
</body>
<script src="jquery.js"></script>

</html>
