<?php
class Resultado
{
    private $db;
    private $usuarioId;

    public function __construct(Database $db, $usuarioId)
    {
        $this->db = $db->getConnection();
        $this->usuarioId = $usuarioId;
    }

    public function procesarRespuestas($respuestas)
    {
        try {
            if (empty($respuestas)) {
                throw new Exception("No se recibieron respuestas");
            }

            // Obtener las respuestas correctas de la base de datos
            $sqlRespuestasCorrectas = "SELECT cod, respuesta_correcta FROM preguntas";
            $stmt = $this->db->query($sqlRespuestasCorrectas);
            $respuestasCorrectas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Convertir las respuestas correctas en un array asociativo
            $mapaRespuestas = [];
            foreach ($respuestasCorrectas as $respuesta) {
                $mapaRespuestas[$respuesta['cod']] = $respuesta['respuesta_correcta'];
            }

            // Contar las respuestas correctas del usuario
            $puntaje = 0;
            $preguntasRespondidas = 0;

            foreach ($respuestas as $clave => $valor) {
                if (strpos($clave, 'respuesta_') === 0) {
                    $codPregunta = str_replace('respuesta_', '', $clave);
                    $preguntasRespondidas++;

                    if (isset($mapaRespuestas[$codPregunta]) && $mapaRespuestas[$codPregunta] === $valor) {
                        $puntaje++;
                    }
                }
            }

            // Verificar si se respondieron todas las preguntas
            if ($preguntasRespondidas == 5) {
                // Registrar el tiempo de finalización y el puntaje en la base de datos
                $sqlUpdate = "UPDATE usuarios SET tFin = NOW(), puntaje = :puntaje WHERE id = :id_usuario";
                $stmtUpdate = $this->db->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':puntaje', $puntaje, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':id_usuario', $this->usuarioId, PDO::PARAM_INT);
                $stmtUpdate->execute();

                return [
                    'puntaje' => $puntaje,
                    'preguntas_respondidas' => $preguntasRespondidas,
                    'estado' => 'completo'
                ];
            }

            return [
                'puntaje' => $puntaje,
                'preguntas_respondidas' => $preguntasRespondidas,
                'estado' => 'incompleto'
            ];
        } catch (PDOException $e) {
            throw new Exception("Error al procesar respuestas: " . $e->getMessage());
        }
    }

    public function obtenerResultadoUsuario()
    {
        try {
            $sql = "SELECT nombreUsu, puntaje, TIMESTAMPDIFF(SECOND, tInicio, tFin) AS tiempo_total FROM usuarios WHERE id = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_usuario', $this->usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener resultados: " . $e->getMessage());
        }
    }
}
