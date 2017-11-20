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
    combustible_real int,
    estado varchar(50) default 'activo',
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
	  externo VARCHAR(10),
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


insert into Cliente ( nombre , apellido, compania)
VALUES ('Federico','Rastelli','Claro'),
	   ('Andres','Oporto', 'Sancor'),
	   ('Franco','Zuccarelli', 'Muffin');

insert into Rol (descripcion)
VALUES ('admin'), ('chofer');

insert into Modulo (descripcion)
 VALUES ('Roles'),
        ('Usuario'),
        ('Empleado'),
        ('home'),
		('Clientes'),
		('Viajes'),
		('Vehiculos'),
		('permisos'),
        ('pageNotFound'),
        ('mantenimiento'),
        ('reportes'),
        ('reportes-kilometros'),
        ('reportes-costo'),
        ('reportes-dias');

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
		(1,8),
        (1,9),
        (1,10),
        (1,11),
        (1,12);

insert into Empleado (nombre,apellido,numeroDocumento,telefono)
values ('Facundo','Migliorini','35159952','1122334455'),
	   ('Erika','Romanczuk','37481033','46512631'),
	   ('Pedro','Rodriguez','25987123','44448888'),
	   ('Marcela','Gonzalez','30789456','45612345'),
	   ('Tamara','Perez','27456789','45678912'),
	   ('Mauro','Mercado','33456789','41782356'),
	   ('Brian','Burgos','38456789','44561237');

insert into Usuario (usuario,password,id_rol,id_empleado)
values ('admin','202cb962ac59075b964b07152d234b70','1','1'),
    ('chofer','202cb962ac59075b964b07152d234b70','2','2'),
    ('chofer2','202cb962ac59075b964b07152d234b70','2','3');

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

INSERT INTO vehiculo(patente, marca,nro_chasis, nro_motor,fecha_fabricacion, id_estadoVehiculo, id_tipoVehiculo)
VALUES ('HTR 128', 'Scania', '12346', '1254', '2010-09-16', '4', '1'),
		('ASD 123', 'Man', '787', '654', '2010-07-24', '1', '1'),
		('WQE 548', 'Volvo', '5587', '354', '2012-08-28', '1', '1'),
		('POI 741', 'Mercedes', '3214', '7785', '2016-06-12', '2', '1'),
		('QWE 789', 'Isuzu', '7854', '654', '2015-05-11', '2', '1'),
		('RET 715', 'GMC', '3214', '65463', '2017-11-03', '3', '1'),
		('ZXC 123', 'Hino', '7842', '6875', '2008-03-07', '4', '1'),
		('YTR 789', 'Ford', '6985', '6453', '2010-01-06', '1', '1'),
		('NBV 998', 'Hummer', '467', '6546', '2010-12-05', '4', '1'),
		('OPU 125', 'Mack Trucks', '4567', '654', '2009-10-07', '1', '1');

INSERT INTO mantenimiento(fecha_inicio, fecha_fin, kilometros, costo, id_servicio, id_vehiculo, mecanico, repuestoCambiado)
 VALUES ('2017-11-01', '2017-11-30', '50000', '2300', '1', '1', 'Pedro', 'cubiertas'),
		('2017-10-01', '2017-11-30', '30000', '2300', '3', '2', 'Cecilia', 'aceite, agua'),
		('2017-01-01', '2017-11-30', '20000', '2300', '4', '3', 'Luis', 'disco de frenos'),
		('2017-02-01', '2017-02-11', '10000', '2300', '5', '4', 'Juan', 'motor'),
		('2017-07-01', '2017-07-07', '8000', '2300', '6', '5', 'Marcos', 'service completo'),
		('2017-03-01', '2017-04-01', '8900', '2300', '7', '1', 'Pedro', 'Cambio de faros');


select *
from Empleado;

select *
from Usuario;

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
