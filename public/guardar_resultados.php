<?php
require_once '../src/Database.php';
require_once '../src/Resultado.php';

try {
    $db = new Database();
    $id_usuario = $_GET['id'];

    // Inicia sesión
    session_start();

    $resultado = new Resultado($db, $id_usuario);
    $procesamientoRespuestas = $resultado->procesarRespuestas();

    if ($procesamientoRespuestas['estado'] === 'completo') {
        header("Location: resultados.php?id=" . $id_usuario);
        exit();
    } else {
        echo "No se pudo procesar el cuestionario.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}