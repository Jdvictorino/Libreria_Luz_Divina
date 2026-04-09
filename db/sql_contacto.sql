-- =============================================
-- Tabla de Contacto para Librería Luz Divina
-- =============================================
-- Ejecutar este script después de importar la base de datos "libreria"

USE libreria;

CREATE TABLE IF NOT EXISTS `contacto` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `fecha` DATETIME NOT NULL,
    `correo` VARCHAR(150) NOT NULL,
    `nombre` VARCHAR(100) NOT NULL,
    `asunto` VARCHAR(200) NOT NULL,
    `comentario` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
