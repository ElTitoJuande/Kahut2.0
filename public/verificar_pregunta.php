<head>
    <meta charset="UTF-8">
    <title>Kahut 2.0</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<?php
require_once '../src/Database.php';
require_once '../src/Cuestionario.php';
require_once '../src/Resultado.php';
session_start();


// Verifica la respuesta y decide el siguiente paso
try {
    $db = new Database();
    $id_usuario = $_GET['id'];
    $resultado = new Resultado($db, $id_usuario);
    $cuestionario = new Cuestionario($db, $id_usuario);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cod_pregunta = $_POST['cod_pregunta'];
        $respuesta_usuario = $_POST['respuesta'];

        // Verifio respuesta
        $sql = "SELECT respuesta_correcta FROM preguntas WHERE cod = :cod_pregunta";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindParam(':cod_pregunta', $cod_pregunta, PDO::PARAM_INT);
        $stmt->execute();
        $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pregunta['respuesta_correcta'] == $respuesta_usuario) {
            // Guarda pregunta buena
            if (!isset($_SESSION['preguntas_respondidas'])) {
                $_SESSION['preguntas_respondidas'] = [];
            }
            $_SESSION['preguntas_respondidas'][] = $cod_pregunta;

            // Si ha respondido 5 preguntas termina
            if (count($_SESSION['preguntas_respondidas']) == 5) {
                header("Location: guardar_resultados.php?id=" . $id_usuario);
                exit();
            }

            // Siguiente pregunta
            $siguientePregunta = $cuestionario->obtenerPreguntaAleatoria($_SESSION['preguntas_respondidas']);
            echo $cuestionario->generarFormularioPregunta($siguientePregunta);
        } else {
            // Respuesta incorrecta y muestra la misma
            echo "<p>Respuesta incorrecta. Inténtalo de nuevo.</p>";
            $pregunta = $cuestionario->obtenerPreguntaAleatoria($_SESSION['preguntas_respondidas']);
            echo $cuestionario->generarFormularioPregunta($pregunta);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
