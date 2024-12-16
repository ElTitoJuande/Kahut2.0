<?php
require_once '../src/Database.php';
require_once '../src/Resultado.php';

try {
    $db = new Database();
    $id_usuario = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultado = new Resultado($db, $id_usuario);
        $procesamientoRespuestas = $resultado->procesarRespuestas($_POST);

        if ($procesamientoRespuestas['estado'] === 'completo') {
            header("Location: resultados.php?id=" . $id_usuario);
            exit();
        } else {
            echo "Por favor, responda todas las preguntas.";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
