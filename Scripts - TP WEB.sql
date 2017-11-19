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

create table estadoVehiculo(
    id_estado INT PRIMARY KEY AUTO_INCREMENT,
    estado VARCHAR(100)
);

create table tipoVehiculo(
    id_tipo INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(100)
);

CREATE TABLE Vehiculo (
    id INT NOT NULL AUTO_INCREMENT primary key,
    patente varchar(15) DEFAULT NULL,
    marca varchar(100) DEFAULT NULL,
    nro_chasis varchar(40) DEFAULT NULL,
    nro_motor varchar(40) DEFAULT NULL,
    fecha_fabricacion date DEFAULT NULL,
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
    tiempo_estimado varchar(50),
    tiempo_real varchar(50),
    combustible_estimado int,
    id_cliente int,
    id_vehiculo int,
    id_vehiculoAcoplado int,
    id_chofer int,
    id_chofer2 int,
    foreign key(id_cliente) references Cliente(id),
    foreign key(id_vehiculo) references Vehiculo(id),
    foreign key(id_chofer) references Empleado(id),
    foreign key(id_chofer2) references Empleado(id)
);

CREATE TABLE Servicio (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion text
);


 CREATE TABLE Mantenimiento (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    fecha_inicio datetime,
    fecha_fin datetime,
    kilometros decimal,
    costo decimal ,
    id_servicio int,
    id_vehiculo int,
    mecanico VARCHAR(100),
    repuestoCambiado VARCHAR(100),
	externo bool,
    foreign key(id_servicio) references Servicio(id),
    foreign key(id_vehiculo) references Vehiculo(id)
);


CREATE TABLE LogViaje (
	id INT NOT NULL AUTO_INCREMENT primary key ,
    razon varchar(255),
    fecha datetime,
    latitud varchar(255),
    longitud varchar(255),
    detalle varchar(255),
    combustible int,
    kilometros int,
    precio DECIMAL(6,2),
    id_viaje INT NOT NULL,
    id_chofer INT NOT NULL,
    foreign key(id_viaje) references Viaje(id),
    foreign key(id_chofer) references Usuario(id)
);

CREATE TABLE Modulo (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion varchar(50)
);


CREATE TABLE Permiso (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    id_Rol int ,
    id_Modulo int,
    foreign key(id_Rol) references Rol(id),
    foreign key(id_Modulo) references Modulo(id)
);

select *
from Empleado;

select *
from Usuario;

insert into Cliente ( nombre , apellido, compania)
VALUES ('Federico','Rastelli','Claro'),
	   ('Andres','Oporto', 'Sancor'),
	   ('Franco','Zuccarelli', 'Muffin');

insert into Rol (descripcion)
VALUES ('admin'), ('chofer');

insert into Modulo (descripcion)
 VALUES ('Roles'),('Usuario'),('Empleado'),('home'),
		('Clientes'),
		('Viajes'),
		('Vehiculos'),
		('Mantenimiento de Vehiculos'),
		('permisos'),
        ('pageNotFound'),
        ('requierePermiso');

insert into Servicio (descripcion)
 VALUES ('Cambio de cubiertas'),
		('Alinear los ejes'),
		('Cambio de aceite'),
        ('Cambio de frenos'),
		('Reparacion'),
		('Chequeo'),
		('otros');

insert into Permiso(id_Rol,id_Modulo)
 VALUES (1,1),
		(1,2),
		(1,3),
		(1,4),
		(1,5),
		(1,6),
		(1,7),
		(1,8);

insert into Empleado (nombre,apellido,numeroDocumento,telefono)
values ('Facundo','Migliorini','35159952','1122334455'),
	   ('Erika','Romanczuk','37481033','46512631'),
	   ('Pedro','Rodriguez','25987123','44448888'),
	   ('Marcela','Gonzalez','30789456','45612345'),
	   ('Tamara','Perez','27456789','45678912'),
	   ('Mauro','Mercado','33456789','41782356'),
	   ('Brian','Burgos','38456789','44561237');

insert into Usuario (usuario,password,id_rol,id_empleado)
values ('admin','202cb962ac59075b964b07152d234b70','1','1');

INSERT INTO tipoVehiculo(tipo)
VALUES ('Camion'),
	   ('Camioneta'),
	   ('Tractor'),
	   ('Acoplado');


INSERT INTO estadoVehiculo (estado)
VALUES ('activo'),
	   ('inactivo'),
       ('Mantenimiento'),
       ('Viaje');
       
/*Vehiculo:Dias fuera de servicio*/

SELECT v.id, v.marca, v.patente, sum(DATEDIFF(m.fecha_inicio, m.fecha_fin)) AS 'DiasInactivo'
FROM Vehiculo v JOIN Mantenimiento m
ON v.id=m.id_vehiculo
Group BY v.id , v.marca, v.patente

/*Vehiculo: Costo mantenimiento*/

SELECT v.id, v.marca, v.patente, sum(m.costo) AS 'CostoMantenimiento'
FROM Vehiculo v JOIN Mantenimiento m
ON v.id=m.id_vehiculo
Group BY v.id , v.marca, v.patente

/*Vehiculo: Kilometros Recorridos - Mantenimiento*/
SELECT v.id, v.marca, v.patente,MAX(m.kilometros) AS 'KilometrosRecorridos'
FROM Vehiculo v JOIN Mantenimiento m ON v.id=m.id_vehiculo
Group BY v.id , v.marca, v.patente
>>>>>>> Reportes
