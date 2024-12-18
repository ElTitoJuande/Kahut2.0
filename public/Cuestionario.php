<head>
    <meta charset="UTF-8">
    <title>Kahut 2.0</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<?php
require_once '../src/Database.php';
require_once '../src/Cuestionario.php';

// Reinicio la sesion al empezar el cuestionario
session_start();
session_destroy();
session_start();

try {
    $db = new Database();
    $id_usuario = $_GET['id'];

    $cuestionario = new Cuestionario($db, $id_usuario);
    // Primera pregunta aleatoria
    $pregunta = $cuestionario->obtenerPreguntaAleatoria();

    if ($pregunta) {
        echo $cuestionario->generarFormularioPregunta($pregunta);
    } else {
        echo "No hay preguntas disponibles.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
