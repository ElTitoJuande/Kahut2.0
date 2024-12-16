<?php
require_once '../src/Database.php';
require_once '../src/Cuestionario.php';

try {
    $db = new Database();
    $id_usuario = $_GET['id'];

    $cuestionario = new Cuestionario($db, $id_usuario);
    $preguntas = $cuestionario->obtenerPreguntasAleatorias();

    if (count($preguntas) > 0) {
        echo $cuestionario->generarFormularioPreguntas($preguntas);
    } else {
        echo "No hay preguntas disponibles.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
