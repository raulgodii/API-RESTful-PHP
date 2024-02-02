CREATE DATABASE IF NOT EXISTS powerhispaniaAPI;
USE powerhispaniaAPI;

DROP TABLE IF EXISTS competiciones;

-- Crear la tabla Competiciones
CREATE TABLE IF NOT EXISTS competiciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    ubicacion VARCHAR(255) NOT NULL,
    organizador VARCHAR(255),
    nivel VARCHAR(50),
    division VARCHAR(255)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear la tabla Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    token VARCHAR(255),
    confirmado BOOL,
    fecha_expiracion_token VARCHAR(255),
    CONSTRAINT unique_email UNIQUE (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Insertar datos en la tabla Competiciones
INSERT INTO competiciones (nombre, fecha, ubicacion, organizador, nivel, division)
VALUES 
('Campeonato Castilla La Nueva', '2024-01-13', 'Miguelturra (Ciudad Real)', 'ZB Barbell', 'AEP3', 'OPEN'),
('Regional de Levante', '2024-01-13', 'Hellin (Albacete)', 'Fuerza Isabel-Atlas', 'AEP2', 'OPEN'),
('Campeonato de Hellin', '2024-01-13', 'Hellin (Albacete)', 'Fuerza Isabel-Atlas', 'AEP3', 'OPEN'),
('Campeonato SOB Madrid', '2024-01-20', 'Arganda del Rey (Madrid)', 'Sons of Barbell', 'AEP3', 'OPEN'),
('Regional Copa Catalana', '2024-01-20', 'Santa Susana (Barcelona)', 'Atenea Powerlifting', 'AEP2', 'OPEN'),
('Copa de los Pirineos', '2024-01-27', 'Alhaurín de la Torre (Málaga)', 'ESPAÑA EPF', 'OPEN (SUB-25)', 'OPEN'),
('Campeonato La Palomera', '2024-01-28', 'León', 'Fuerza Norte León', 'AEP3', 'OPEN'),
('Valkyria Cup NorOeste-1', '2024-02-03', 'Boecillo (Valladolid)', 'Valkyria PT', 'AEP2', 'OPEN'),
('Campeonato de Valladolid', '2024-02-03', 'Boecillo (Valladolid)', 'Valkyria PT', 'AEP3', 'OPEN'),
('Campeonato Goierri - PWR Navarra', '2024-02-04', 'Urretxu (Guipuzkoa)', 'Goierri KE', 'AEP3', 'OPEN'),
('European Masters Classic Powerlifting Championships', '2024-02-12', 'Torremolinos (Málaga)', 'ESPAÑA EPF', 'MASTERs', 'OPEN'),
('Campeonato Cold Moon', '2024-02-17', 'St. Adrià Besòs (Barcelona)', 'Força Laiesken', 'AEP3', 'OPEN'),
('Campeonato de Bizkaia', '2024-02-17', 'Getxo (Bizkaia)', 'Raw Barbell', 'AEP3', 'OPEN'),
('Regional Reino de Toledo', '2024-02-24', 'El Viso de San Juan (Toledo)', 'Berserkers Toledo', 'AEP2', 'OPEN'),
('Berserkers Championship de Toledo', '2024-02-24', 'El Viso de San Juan (Toledo)', 'Berserkers Toledo', 'AEP3', 'OPEN'),
('European University Cup Classic Powerlifting', '2024-02-29', 'Nancy FRANCIA', 'ESPAÑA EPF', 'OPEN (SUB-25)', 'OPEN'),
('Regional de Madrid', '2024-03-02', 'Buitrago de Lozoya (Madrid)', 'Gimnasio Crom', 'AEP2', 'OPEN'),
('España Copa de Powerlifting y Press Banca', '2024-03-09', 'Las Torres Cotillas (Murcia)', 'Myrtea Lifting Club', 'AEP1', 'OPEN'),
('European Open Classic Powerlifting Championships', '2024-03-12', 'Velika Gorica CROACIA', 'ESPAÑA EPF', 'OPEN', 'OPEN'),
('Campeonato Élite Canarias', '2024-03-23', 'Las Palmas', 'Élite Canarias', 'AEP3', 'OPEN'),
('Campeonato de Sevilla', '2024-03-23', 'Bollullos de la Mitación (Sevilla)', 'Elite Powerlifting Bollullos', 'AEP3', 'OPEN'),
('Regional NorOeste 2', '2024-03-23', 'Cantabria', 'Team EliteTrainer', 'AEP2', 'OPEN'),
('Campeonato Andalucia West', '2024-03-30', 'La Monacilla (Huelva)', 'Ironside Strength', 'AEP3', 'OPEN'),
('Regional Federacion Catalana', '2024-04-06', 'La Pobla de Montornès (Tarragona)', 'Federació Catalana', 'AEP2', 'OPEN'),
('Campeonato Black Oni', '2024-04-13', 'Las Torres Cotillas (Murcia)', 'Myrtea Lifting Club', 'AEP3', 'OPEN'),
('Interregional Centro', '2024-04-27', 'Soy Powerlifter', 'Castilla-La Mancha, Extremadura y Madrid (Madrid)', 'AEP2', 'OPEN P-B R'),
('European Master Equipped Powerlifting Championships', '2024-05-01', 'Hamm LUXEMBURGO', 'ESPAÑA EPF', 'MASTERs', 'P E'),
('European Open, Sub-Junior & Junior Equipped Powerlifting Championships', '2024-05-07', 'Hamm LUXEMBURGO', 'ESPAÑA EPF', 'OPEN-SBJ-JUN', 'P E'),
('Campeonato de España JUNIOR', '2024-05-17', 'Ferrol, Coruña', 'Fénix Galicia Power', 'AEP1', 'JUNIOR P-B R'),
('World Classic & Equipped Bench Press Championship', '2024-05-21', 'Austin, TEXAS USA', 'IPF', 'OPEN-SBJ-JUN-MASTERs', 'B R-E'),
('Interregional NorOeste', '2024-06-08', 'Strength Burgos', 'Asturia, Cantabria, Castilla y Leon, Euskadi, La Rioja y Navarra (Burgos)', 'AEP2', 'OPEN P-B R'),
('España Absoluto de Press Banca y Peso Muerto', '2024-06-08', 'Chiva (Valencia)', 'Fuerza Isabel-Atlas', 'AEP1', 'OPEN'),
('Regional Este-2', '2024-06-08', 'Chiva (Valencia)', 'Fuerza Isabel-Atlas', 'AEP2', 'OPEN'),
('Campeonato de Chipiona', '2024-06-15', 'Chipiona (Cádiz)', 'Powerlifting Chipiona', 'AEP3', 'OPEN P R'),
('World Open Classic Powerlifting Championships', '2024-06-16', 'Vilnius LITUANIA', 'IPF', 'OPEN', 'P R'),
('España Masters de Powerlifting y Press Banca', '2024-06-29', 'Huercal-Overa (Almería)', 'Energy Alhaurín', 'AEP1', 'MASTERS'),
('Interregional Andalucia-Canarias, Ceuta y Melilla', '2024-06-29', 'Huercal-Overa (Almería)', 'Energy Alhaurín', 'AEP2', 'OPEN'),
('Campeonato de España SUBJUNIOR', '2024-07-06', 'Elite Powerlifting Bollullos', 'Sevilla', 'AEP1', 'SUBJUNIOR'),
('FISU World University Classic Powerlifting', '2024-07-22', 'Tartu ESTONIA', 'FISU', 'OPEN (SUB-25)', 'P R'),
('European Open, Sub-Junior, Junior, Masters Classic & Equipped Bench Press Championships', '2024-08-05', 'Estambul TURQUIA', 'EPF', 'EPF', 'OPEN'),
('Campeonato Fuerza Guadaira', '2024-09-14', 'Alcalá de Guadaira (Sevilla)', 'Fuerza Guadaira', 'AEP3', 'OPEN'),
('2º Regional de Madrid', '2024-09-21', 'Soy Powerlifter', 'Madrid', 'AEP2', 'OPEN P-B R'),
('España Absoluto de Powerlifting Raw', '2024-09-28', 'Alhaurín de la Torre (Málaga)', 'Energy', 'AEP1', 'OPEN');