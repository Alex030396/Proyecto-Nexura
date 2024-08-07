<?php
function conectarBD() : mysqli {
    $db = mysqli_connect('localhost', 'root','25706096','nexura');
    
    if (!$db) {
    echo "Error de conexion";
    exit;
    }
    return $db;
}

conectarBD();
?>