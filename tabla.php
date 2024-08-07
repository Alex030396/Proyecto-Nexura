<?php
require 'includes/database.php';
$db = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    $empleado_id = $_POST['id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body> 
    <div class="container">
        <!-- Lista de empleados-->
        <section class="contenedor">
            <h2>Lista de empleados</h2>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="formulario.php" class="btn btn-primary" role="button">
            <i class="fa-solid fa-user-plus"></i>
                <span>Crear</span>
            </a>
            </div>
            <table >
                <thead>
                    <tr>
                        <th>
                            <div class="flex">
                            <i class="fa-solid fa-user"></i>
                                <span class="icon">Nombre</span>
                            </div>
                        </th> 
                        <th>
                            <div class="flex">
                                <i class="fa-solid fa-at"></i>
                                <span class="icon">Email</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                                <i class="fa-solid fa-venus-mars"></i>
                                <span class="icon">Sexo</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                            <i class="fa-solid fa-briefcase"></i>
                                <span class="icon">Área</span>
                            </div>
                        </th>
                        <th>
                            <div class="flex">
                            <i class="fa-solid fa-envelope"></i>
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
                        $query2 = "SELECT id,nombre,email,sexo,area_id,boletin FROM empleados";
                        $result = $db->query($query2);
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$row['nombre']."</td>";
                            echo "<td>".$row['email']."</td>";
                            // echo "<td>".$row['sexo']."</td>";
                            echo "<td>";if ($row['sexo'] == 'F') { echo "Femenico"; } else {echo "Masculino";} echo"</td>";
                            // echo "<td>".$row['area_id']."</td>";
                            echo "<td>";if ($row['area_id'] == 1) { 
                                echo "Ventas"; 
                            } elseif ($row['area_id'] == 2) {
                                echo "Calidad";
                            } elseif ($row['area_id'] == 3) {
                                echo "Producción";
                            } elseif ($row['area_id'] == 4) {
                                echo "Administración";
                            }
                            echo"</td>";



                            echo "<td>";if ($row['boletin'] == 1) { echo "Si"; } else {echo "No";} echo"</td>";
                            // echo "<td>".$row['boletin']."</td>";
                            echo '<td> <a href="/propiedades/modificar.php?id='.$row['id'].'"> <i class="fa-solid fa-pen-to-square"></i> </a></td>';
                            // echo '<td> <a href="/propiedades/modificar.php"> <i class="fa-solid fa-pen-to-square"></i> </a></td>';
                            echo '<td> <a href="formulario.php"><i class="fa-solid fa-trash-can"></i> </a></td>';
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
