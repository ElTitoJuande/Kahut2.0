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

    public function procesarRespuestas()
    {
        try {
            // No es necesario iniciar sesión nuevamente aquí
            $preguntasRespondidas = $_SESSION['preguntas_respondidas'] ?? [];
            $puntaje = count($preguntasRespondidas);

            // Registrar el tiempo de finalización y el puntaje en la base de datos
            $sqlUpdate = "UPDATE usuarios SET tFin = NOW(), puntaje = :puntaje WHERE id = :id_usuario";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':puntaje', $puntaje, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':id_usuario', $this->usuarioId, PDO::PARAM_INT);
            $stmtUpdate->execute();

            // Destruir sesión después de finalizar
            session_destroy();

            return [
                'puntaje' => $puntaje,
                'estado' => 'completo'
            ];
        } catch (PDOException $e) {
            throw new Exception("Error al procesar respuestas: " . $e->getMessage());
        }
    }

    // Resto del código permanece igual...
}
