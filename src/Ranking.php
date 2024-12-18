<?php
class Ranking
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }
    // Jugadores ordenados por tiempo
    public function obtenerTopJugadores($limite = 10)
    {
        try {
            $sql = "SELECT nombreUsu, TIMESTAMPDIFF(SECOND, tInicio, tFin) AS tiempo_total 
                FROM usuarios 
                WHERE tFin IS NOT NULL 
                ORDER BY tiempo_total ASC 
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
        echo "<table class='ranking'>";
        echo "<tr><th>Posición</th><th>Nombre</th><th>Tiempo</th></tr>";

        foreach ($jugadores as $index => $jugador) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . htmlspecialchars($jugador['nombreUsu']) . "</td>";
            echo "<td>" . htmlspecialchars($jugador['tiempo_total']) . " seg</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
