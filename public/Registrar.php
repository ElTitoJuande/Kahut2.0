<?php
require_once '../src/Database.php';
require_once '../src/Usuario.php';

try {
    $db = new Database();
    $usuario = new Usuario($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreUsu = trim($_POST['nombreUsu']);

        if (Usuario::validarNombre($nombreUsu)) {
            $id_usuario = $usuario->registrar($nombreUsu);
            header("Location: cuestionario.php?id=" . $id_usuario);
            exit();
        } else {
            echo "Error: El nombre de usuario no puede estar vacío.";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
