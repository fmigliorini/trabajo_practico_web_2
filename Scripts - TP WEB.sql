DROP DATABASE IF EXISTS ViajesPepe;

CREATE DATABASE IF NOT EXISTS ViajesPepe;

use ViajesPepe;

CREATE TABLE Rol (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion varchar(50)
);

CREATE TABLE Empleado(
    id INT NOT NULL AUTO_INCREMENT primary key ,
    nombre varchar(50),
    apellido varchar(80),
    numeroDocumento varchar(15),
    telefono varchar(50)
);

select * from Empleado;
CREATE TABLE Usuario (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    usuario varchar (64),
    password varchar(225),
    estado enum('activo','inactivo') default 'activo',
    id_rol int ,
    id_empleado int,
    foreign key(id_rol) references Rol(id),
    foreign key(id_empleado) references Empleado(id)
);


create table tipoVehiculo(
    id_tipo INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(100)
);

CREATE TABLE Vehiculo (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    patente varchar (15),
    id_estadoVehiculo INT,
    id_tipoVehiculo INT,
    CONSTRAINT fk_estadoVehiculo_vehiculo_id_estadoVehiculo FOREIGN KEY (id_estadoVehiculo) REFERENCES estadoVehiculo(id_estado),
    CONSTRAINT fk_estadoVehiculo_vehiculo_id_tipoVehiculo FOREIGN KEY (id_tipoVehiculo) REFERENCES tipoVehiculo(id_tipo)
);

CREATE TABLE Cliente (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    nombre varchar (50),
    apellido varchar(100),
    compania varchar(100)
);

create table Viaje(
    id INT NOT NULL AUTO_INCREMENT primary key,
    descripcion varchar(225),
    origen varchar(100),
    destino varchar(100),
    fecha_inicio date,
    fecha_fin date,
    tiempo_estimado time,
    tiempo_real time,
    desviacion varchar(225),
    combustible_estimado int,
    id_cliente int,
    id_vehiculo int,
    id_chofer int,
    foreign key(id_cliente) references Cliente(id),
    foreign key(id_vehiculo) references Vehiculo(id),
    foreign key(id_chofer) references Empleado(id)
);

CREATE TABLE Servicio (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion text
);


CREATE TABLE Mantenimiento (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    fecha_inicio datetime,
    fecha_fin datetime,
    kilometros int,
    costo decimal ,
    id_servicio int,
    foreign key(id_servicio) references Servicio(id)
);


CREATE TABLE ViajeLog (
	id INT NOT NULL AUTO_INCREMENT primary key ,
    fecha datetime,
    descripción varchar(255),
    precio DECIMAL(6,3),
    id_viaje INT NOT NULL,
    foreign key(id_viaje) references Viaje(id)
);

select * from Empleado;
select * from Usuario;
insert into Rol (descripcion) VALUES ('admin');
insert into Empleado (nombre,apellido,numeroDocumento,telefono) values ('Facundo','Migliorini','35159952','1122334455');
insert into Usuario (usuario,password,id_rol,id_empleado) values ('admin','202cb962ac59075b964b07152d234b70','1','1');
INSERT INTO `tipovehiculo` (`id_tipo`, `tipo`) VALUES (NULL, 'Camion'), (NULL, 'Camioneta'), (NULL, 'Tractor'), (NULL, 'Acoplado');
INSERT INTO `estadovehiculo` (`id_estado`, `estado`) VALUES (NULL, 'activo'), (NULL, 'no activo');

