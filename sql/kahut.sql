-- Crear base de datos
CREATE DATABASE kahut CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kahut;

-- Tabla de preguntas (sin categoría)
CREATE TABLE preguntas (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    enunciado VARCHAR(500) NOT NULL,
    opcion_a VARCHAR(100) NOT NULL,
    opcion_b VARCHAR(100) NOT NULL,
    opcion_c VARCHAR(100) NOT NULL,
    opcion_d VARCHAR(100) NOT NULL,
    respuesta_correcta CHAR(1) NOT NULL
);

-- Insertar preguntas
INSERT INTO preguntas (enunciado, opcion_a, opcion_b, opcion_c, opcion_d, respuesta_correcta) VALUES
('¿Qué selección ganó la Copa Mundial de la FIFA 2018?', 'Alemania', 'Brasil', 'Francia', 'Argentina', 'C'),
('¿Quién es el máximo goleador en la historia de la Champions League?', 'Cristiano Ronaldo', 'Lionel Messi', 'Robert Lewandowski', 'Karim Benzema', 'A'),
('¿En qué año se jugó el primer Mundial de fútbol?', '1928', '1930', '1934', '1938', 'B'),
('¿Qué país ha ganado más Copas del Mundo?', 'Brasil', 'Italia', 'Alemania', 'Argentina', 'A'),
('¿Quién marcó el famoso gol conocido como "La Mano de Dios"?', 'Pelé', 'Diego Maradona', 'Zinedine Zidane', 'Johan Cruyff', 'B');

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreUsu VARCHAR(50) NOT NULL,
    tInicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tFin TIMESTAMP NULL,
    puntaje INT NULL
);