<?php
require_once '../src/Database.php';
require_once '../src/Resultado.php';

try {
    $db = new Database();
    $id_usuario = $_GET['id'];

    $resultado = new Resultado($db, $id_usuario);
    $detallesResultado = $resultado->obtenerResultadoUsuario();

    if ($detallesResultado) {
        echo "<h1>Resultados del Cuestionario</h1>";
        echo "<p>Nombre de usuario: " . htmlspecialchars($detallesResultado['nombreUsu']) . "</p>";
        echo "<p>Puntaje: " . htmlspecialchars($detallesResultado['puntaje']) . "/5</p>";
        echo "<p>Tiempo total: " . htmlspecialchars($detallesResultado['tiempo_total']) . " segundos</p>";
    } else {
        echo "No se encontraron resultados para este usuario.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
