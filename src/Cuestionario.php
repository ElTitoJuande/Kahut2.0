<?php
class Cuestionario
{
    private $db;
    private $usuarioId;

    public function __construct(Database $db, $usuarioId)
    {
        $this->db = $db->getConnection();
        $this->usuarioId = $usuarioId;
    }

    // Obtengo una pregunta aleatoria que no se ha respondido
    public function obtenerPreguntaAleatoria($preguntasRespondidas = [])
    {
        try {
            // Excluiye preguntas ya respondidas
            $whereClause = $preguntasRespondidas ?
                "WHERE cod NOT IN (" . implode(',', $preguntasRespondidas) . ") " :
                "";

            $sql = "SELECT * FROM preguntas {$whereClause} ORDER BY RAND() LIMIT 1";

            $stmt = $this->db->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener pregunta: " . $e->getMessage());
        }
    }
    // HTML del formulario
    public function generarFormularioPregunta($pregunta)
    {
        echo "<form method='POST' action='verificar_pregunta.php?id=" . htmlspecialchars($this->usuarioId) . "' class='cuestionario'>";
        echo "<input type='hidden' name='cod_pregunta' value='" . htmlspecialchars($pregunta['cod']) . "'>";
        echo "<div class='pregunta'>";
        echo "<p>" . htmlspecialchars($pregunta['enunciado']) . "</p>";
        echo "<label><input type='radio' name='respuesta' value='A' required> " . htmlspecialchars($pregunta['opcion_a']) . "</label><br>";
        echo "<label><input type='radio' name='respuesta' value='B'> " . htmlspecialchars($pregunta['opcion_b']) . "</label><br>";
        echo "<label><input type='radio' name='respuesta' value='C'> " . htmlspecialchars($pregunta['opcion_c']) . "</label><br>";
        echo "<label><input type='radio' name='respuesta' value='D'> " . htmlspecialchars($pregunta['opcion_d']) . "</label><br>";
        echo "</div>";
        echo "<input type='submit' value='Responder'>";
        echo "</form>";
    }
}
