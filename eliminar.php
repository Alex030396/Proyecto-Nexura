<?php 
require 'includes/database.php';
$db = conectarBD();

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
//     $empleado_id = $_POST['id'];
    
//     // Eliminar empleado de la tabla empleados
//     $queryEliminar = "DELETE FROM empleados WHERE id = $empleado_id";
//     $resultadoEliminar = mysqli_query($db, $queryEliminar);

//     if ($resultadoEliminar) {
//         echo "Empleado eliminado correctamente";
//     } else {
//         echo "Error al eliminar empleado: " . mysqli_error($db);
//     }
// }



// if(isset($_POST['id'])) {
//     $empleado_id = $_POST['id'];
//     $query = "DELETE FROM empleados WHERE id = $empleado_id";
//     $result = mysqli_query($db, $query);
    
//     echo $query;
// if(!$result) {
//     die("Consulta fallida.");
// }

// $_SESSION['message'] = 'Borrado con Exito';
// $_SESSION['message_type'] = 'danger';
// header('Location: ../formulario.php');
// }



// include("../includes/database.php.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM empleados WHERE id = $id";
  $result = mysqli_query($db, $query);
  if(!$result) {
    die("Consulta fallida.");
  }

  $_SESSION['message'] = 'Borrado con Exito';
  $_SESSION['message_type'] = 'danger';
   header('Location: formulario.php');
}
?>