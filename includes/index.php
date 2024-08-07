<?php
require 'includes/database.php';
$db = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    $nombre =$_POST['Nombre'];
    $email =$_POST['email'];
    $sexo =$_POST['sexo'];
    $area =$_POST['Area'];
    $texto = $_POST['descripcion'];
    $boletin =isset($_POST['boletin']) ? 1 : 0;
    $roles = $_POST['roles'];

    $query = "INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion) VALUES ('$nombre','$email','$sexo',$area,$boletin,'$texto')";
    echo $query;
    
    
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
        echo "Empleado registrado correctamente";
    }
    
    if ($resultado) {
        // Obtener el ID del último registro insertado
        $empleado_id = mysqli_insert_id($db);
        echo "Nuevo empleado registrado con éxito. ID del empleado: " . $empleado_id;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
    $query1 = "INSERT INTO empleado_rol (empleado_id,rol_id) VALUES ($empleado_id,$roles)";
    echo $query1;
    
    $resultado1 = mysqli_query($db, $query1);
    if ($resultado1) {
        echo "Empleado registrado correctamente";
    }
    

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
        <h1 >Registrar Empleados</h1>
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
                        <div class="checkbox"><input id="rol1" name="roles" type="checkbox" value="1" > <p>Profesional de proyectos - Desarrollador</p></div>
                        <div class="checkbox"><input id="rol2" name="roles" type="checkbox" value="2"> <p> Gerente estratégico</p></div>
                        <div class="checkbox"><input id="rol3" name="roles" type="checkbox" value="3"> <p> Auxiliar administrativo</p></div>
                </div>
                <div class="input">
                    <input type="submit" value="Guardar" class="boton">
                </div>  
            </div>
        </form>
    
        <!-- Lista de empleados-->
        <section class="contenedor">
            <h2>Lista de empleados</h2>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="button">   
                    <svg class="icons a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg><span>  Crear</span>
                </button>
            </div>
            <table >
                <thead>
                    <tr>
                        <th>
                            <div class="flex">
                                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                                <span class="icon">Nombre</span>
                            </div>
                        </th> 
                        <th>
                            <div class="flex">
                                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256l0 32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32l0 80 0 32c0 17.7 14.3 32 32 32s32-14.3 32-32l0-32c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
                                <span class="icon">Email</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1l0 34.9 32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0 0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-32 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0 0-34.9C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0L616 0c13.3 0 24 10.7 24 24l0 112c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z"/></svg>
                                <span class="icon">Sexo</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z"/></svg>
                                <span class="icon">Área</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <span class="icon">Boletín</span>
                            </div>
                        </th>
                        <th>
                            
                            <span>Modificar</span>
                        </th>
                        <th>
                    
                            <span>Eliminar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query2 = "SELECT nombre,email,sexo,area_id,boletin FROM empleados";
                        $result = $db->query($query2);
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['sexo']."</td>";
                            echo "<td>".$row['area_id']."</td>";
                            echo "<td>".$row['boletin']."</td>";
                            echo '<td> <a href="#"> <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg> </a></td>';
                            echo '<td> <a href="#"><svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg> </a></td>';
                            echo "</tr>";
                        } 
                    ?>
                </tbody>
            </table>
        </section>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
<script src="jquery.js"></script>

</html>
