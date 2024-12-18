    <head>
        <meta charset="UTF-8">
        <title>Kahut 2.0</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <?php
    require_once '../src/Database.php';
    require_once '../src/Resultado.php';
    require_once '../src/Ranking.php';

    try {
        $db = new Database();
        $id_usuario = $_GET['id'];

        $resultado = new Resultado($db, $id_usuario);

        // Modifico para obtener los detalles del usuario
        $sql = "SELECT nombreUsu, TIMESTAMPDIFF(SECOND, tInicio, tFin) AS tiempo_total FROM usuarios WHERE id = :id_usuario";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $detallesResultado = $stmt->fetch(PDO::FETCH_ASSOC);

        $ranking = new Ranking($db);
        $topJugadores = $ranking->obtenerTopJugadores();

        if ($detallesResultado) {
            echo "<div id='magiaTop'>";
            echo "<div id='magia1' style='background-color: #ffffff73; border-radius: 10px; padding: 10px;'>";
            echo "<h1>Resultados del Cuestionario</h1>";
            echo "<p>Nombre de usuario: " . htmlspecialchars($detallesResultado['nombreUsu']) . "</p>";
            echo "<p>Tiempo total: " . htmlspecialchars($detallesResultado['tiempo_total']) . " segundos</p>";
            echo "</div>";
            echo "<div id='magia2'>";
            echo "<h2>Ranking de Jugadores</h2>";
            echo $ranking->generarTablaRanking($topJugadores);
            echo "</div>";
            echo "</div>";
        } else {
            echo "No se encontraron resultados para este usuario.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
