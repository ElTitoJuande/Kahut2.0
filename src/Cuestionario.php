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

    public function obtenerPreguntasAleatorias($cantidad = 5, $categoria = null)
    {
        try {
            $sql = "SELECT * FROM preguntas ORDER BY RAND() LIMIT :cantidad";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener preguntas: " . $e->getMessage());
        }
    }

    public function generarFormularioPreguntas($preguntas)
    {
        echo "<form method='POST' action='guardar_resultados.php?id=" . htmlspecialchars($this->usuarioId) . "' class='cuestionario'>";

        foreach ($preguntas as $pregunta) {
           echo "<div class='pregunta'>";
           echo "<p>" . htmlspecialchars($pregunta['enunciado']) . "</p>";
           echo "<label><input type='radio' name='respuesta_" . htmlspecialchars($pregunta['cod']) . "' value='A' required> " . htmlspecialchars($pregunta['opcion_a']) . "</label><br>";
           echo "<label><input type='radio' name='respuesta_" . htmlspecialchars($pregunta['cod']) . "' value='B'> " . htmlspecialchars($pregunta['opcion_b']) . "</label><br>";
           echo "<label><input type='radio' name='respuesta_" . htmlspecialchars($pregunta['cod']) . "' value='C'> " . htmlspecialchars($pregunta['opcion_c']) . "</label><br>";
           echo "<label><input type='radio' name='respuesta_" . htmlspecialchars($pregunta['cod']) . "' value='D'> " . htmlspecialchars($pregunta['opcion_d']) . "</label><br>";
           echo "</div><hr>";
        }

        echo "<input type='submit' value='Enviar'>";
        echo "</form>";

        return $html;
    }
}
