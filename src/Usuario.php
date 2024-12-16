<?php
class Usuario
{
    private $db;
    private $id;
    private $nombreUsu;
    private $tInicio;
    private $tFin;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function registrar($nombreUsu)
    {
        try {
            $sql = "INSERT INTO usuarios (nombreUsu, tInicio) VALUES (:nombreUsu, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombreUsu', $nombreUsu, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            } else {
                throw new Exception("No se pudo registrar el usuario");
            }
        } catch (PDOException $e) {
            throw new Exception("Error en registro: " . $e->getMessage());
        }
    }

    public static function validarNombre($nombre)
    {
        $nombre = trim($nombre);
        return !empty($nombre) && strlen($nombre) >= 3 && strlen($nombre) <= 20;
    }
}
