<?php
require 'includes/database.php';
$db = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // $empleado_id = $_POST['id'];
    $nombre =$_POST['Nombre'];
    $email =$_POST['email'];
    $sexo =$_POST['sexo'];
    $area =$_POST['Area'];
    $texto = $_POST['descripcion'];
    $boletin =isset($_POST['boletin']) ? 1 : 0;
    $roles = $_POST['roles'];

    $query = "INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion) VALUES ('$nombre','$email','$sexo',$area,$boletin,'$texto')";
    // echo $query;
    
    
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
        echo "Empleado registrado correctamente";
    }
    
    if ($resultado) {
        
        $empleado_id = mysqli_insert_id($db);
        // echo "Nuevo empleado registrado con éxito. ID del empleado: " . $empleado_id;
    // } else {
        // echo "Error: " . $query . "<br>" . $db->error;
    }
    $query1 = "INSERT INTO empleado_rol (empleado_id,rol_id) VALUES ($empleado_id,$roles)";
    // echo $query1;
    
    $resultado1 = mysqli_query($db, $query1);
    // if ($resultado1) {
    //     // echo "Empleado registrado correctamente";
    // }
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
</head>
<body> 
    <div class="container">
        <div class="row">
            <div class="col"><h1 >Registrar Empleados</h1></div>
            <div class="col text-end"> <a href="tabla.php" class="enlace">Lista de empleados</a></div>
        </div>    
        <div class="advertencia">
            <p>Los campos con asteriscos (*) son obligatorios</p>
        </div>
        <form method="post">   
        <!-- Formulario para registrar los usuarios-->
            <div class="formulario">
                <div class="input">
                    <label for="Nombre" class="label">Nombre completo *</label>
                    <input id="Nombre" name="Nombre" type="text" placeholder="Nombre completo del empleado" class="box">
                </div>
                <div class="input">
                    <label for="email" class="label">Correo electronico *</label>
                    <input id="email" name="email" autocomplete="off" type="email" placeholder="Correo electrónico" class="box">
                </div>
                <div class="input">
                    <label class="label sex">Sexo *</label>
                    <div class="mas"><input name="sexo" id="Masculino" value="M" type="radio" ><p>Masculino</p></div>
                    <div class="fem"><input name="sexo" id="Femenino" value="F" type="radio"><p>Femenino </p></div>
                </div>
                <div class="input">
                    <label for="Area" class="label">Area *</label>
                    <select class="box" name="Area" id="Area">
                        <option value="">Seleccionar</option>
                        <option value="1">Ventas</option>
                        <option value="2">Calidad</option>
                        <option value="3">Producción</option>
                        <option value="4">Administración</option>
                    </select>
                </div>
                <div class="input">
                    <label for="Descripción" class="label">Descripción *</label>
                    <textarea class="textarea" name="descripcion" id="Descripción" placeholder="  Descripción de la experiencia del empleado"></textarea>
                </div>
                <div class="input">
                    <div class="checkbox">
                        <input id="boletin" name="boletin" value="1" type="checkbox"><p>Deseo recibir boletín informativo</p>
                    </div>
                </div>
                <div class="input">
                    <label for="roles" class="label rol">Roles *</label>
                        <div class="checkbox"><input id="rol1" name="roles" type="checkbox" value="1"> <p>Profesional de proyectos - Desarrollador</p></div>
                        <div class="checkbox"><input id="rol2" name="roles" type="checkbox" value="2"> <p>Gerente estratégico</p></div>
                        <div class="checkbox"><input id="rol3" name="roles" type="checkbox" value="3"> <p>Auxiliar administrativo</p></div>
                </div>
                <div class="input">
                    <input type="submit" value="Guardar" class="boton">
                </div>  
            </div>
        </form>
</body>
<script src="jquery.js"></script>

</html>
