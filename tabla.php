<?php
require 'includes/database.php';
$db = conectarBD();

$query2 = "SELECT id, nombre, email, sexo, area_id, boletin FROM empleados";
$result = $db->query($query2);

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
                     <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['sexo'] === 'F' ? 'Femenino' : 'Masculino'; ?></td>
                    <td>
                        <?php 
                        switch ($row['area_id']) {
                            case 1: echo 'Ventas'; break;
                            case 2: echo 'Calidad'; break;
                            case 3: echo 'Producción'; break;
                            case 4: echo 'Administración'; break;
                        }
                        ?>
                    </td>
                    <td><?php echo $row['boletin'] == 1 ? 'Sí' : 'No'; ?></td>
                    <td>
                        <a href="/propiedades/modificar.php?id=<?php echo $row['id']; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="eliminar.php?id=<?php echo $row['id']; ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
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
