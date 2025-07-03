-- Crear base de datos
CREATE DATABASE IF NOT EXISTS barberia_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE barberia_db;

-- Tabla: usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    rol ENUM('admin', 'barbero', 'cliente') NOT NULL,
    comision DECIMAL(5,2) DEFAULT NULL, -- Solo para barberos
    saldo DECIMAL(12,2) DEFAULT 0.00, -- Solo relevante para administrador
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE
);

-- Tabla: servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    barbero_id INT NOT NULL,
    servicio_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'realizada', 'cancelada') DEFAULT 'pendiente',
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id),
    FOREIGN KEY (barbero_id) REFERENCES usuarios(id),
    FOREIGN KEY (servicio_id) REFERENCES servicios(id)
);

-- Tabla: comisiones
CREATE TABLE comisiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cita_id INT NOT NULL,
    barbero_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'pagada') DEFAULT 'pendiente',
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    pagado_en DATETIME DEFAULT NULL,
    FOREIGN KEY (cita_id) REFERENCES citas(id),
    FOREIGN KEY (barbero_id) REFERENCES usuarios(id)
);

-- Tabla: pagos
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barbero_id INT NOT NULL,
    total_pagado DECIMAL(10,2) NOT NULL,
    observaciones TEXT,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (barbero_id) REFERENCES usuarios(id)
);

-- Tabla: detalle_pagos
CREATE TABLE detalle_pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pago_id INT NOT NULL,
    comision_id INT NOT NULL,
    FOREIGN KEY (pago_id) REFERENCES pagos(id),
    FOREIGN KEY (comision_id) REFERENCES comisiones(id)
);

-- Insertar usuario administrador inicial
INSERT INTO usuarios (nombre, usuario, password, correo, rol, saldo)
VALUES ('Admin General', 'admin', SHA2('admin123', 256), 'admin@barberia.com', 'admin', 0.00);

-- Insertar servicios de ejemplo
INSERT INTO servicios (nombre, descripcion, precio) VALUES
('Corte Clásico', 'Corte tradicional con tijeras y máquina', 25.00),
('Corte y Barba', 'Corte de cabello más arreglo de barba', 35.00),
('Solo Barba', 'Perfilado y arreglo de barba', 15.00),
('Corte Moderno', 'Cortes actuales y con estilo', 30.00),
('Tratamiento Capilar', 'Lavado y tratamiento especial', 20.00);

-- Insertar barbero de ejemplo
INSERT INTO usuarios (nombre, usuario, password, correo, rol, comision)
VALUES ('Carlos Mendez', 'carlos', SHA2('barbero123', 256), 'carlos@barberia.com', 'barbero', 40.00);
