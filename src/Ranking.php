<?php
class Ranking
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function obtenerTopJugadores($limite = 10)
    {
        try {
            $sql = "SELECT nombreUsu, puntaje, TIMESTAMPDIFF(SECOND, tInicio, tFin) AS tiempo_total 
                    FROM usuarios 
                    WHERE puntaje IS NOT NULL 
                    ORDER BY puntaje DESC, tiempo_total ASC 
                    LIMIT :limite";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener ranking: " . $e->getMessage());
        }
    }

    public function generarTablaRanking($jugadores)
    {
        $html = "<table class='ranking'>";
        $html .= "<tr><th>Posición</th><th>Nombre</th><th>Puntaje</th><th>Tiempo</th></tr>";

        foreach ($jugadores as $index => $jugador) {
            $html .= "<tr>";
            $html .= "<td>" . ($index + 1) . "</td>";
            $html .= "<td>" . htmlspecialchars($jugador['nombreUsu']) . "</td>";
            $html .= "<td>" . htmlspecialchars($jugador['puntaje']) . "/5</td>";
            $html .= "<td>" . htmlspecialchars($jugador['tiempo_total']) . " seg</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";
        return $html;
    }
}
    