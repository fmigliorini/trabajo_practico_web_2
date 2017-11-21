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
    tipo VARCHAR(100),
	kilometrosService VARCHAR(100),
	
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
    fecha_inicio datetime,
    fecha_fin datetime,
    tiempo_estimado varchar(50),
    tiempo_real varchar(50),
    combustible_estimado int,
    combustible_real int,
    kilometro_estimado int,
    kilometro_real int,
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
    fecha_inicio date,
    hora_inicio time,
    hora_fin time,
    fecha_fin date,
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


insert into Cliente ( nombre , apellido, compania)
VALUES ('Federico','Rastelli','Claro'),
	   ('Andres','Oporto', 'Sancor'),
	   ('Franco','Zuccarelli', 'Muffin');

insert into Rol (descripcion)
VALUES ('admin'), ('chofer'), ('mantenimiento');

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
        ('reportes-dias'),
		('reportes-kilometrosService'),
		('graficos')
		;

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
        (1,12),
		(1,13);
		(1,14),
        (1,15),
		(1,16),
        (3,10);

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
    ('chofer2','202cb962ac59075b964b07152d234b70','2','3'),
    ('mantenimiento','202cb962ac59075b964b07152d234b70','3','4');

INSERT INTO tipoVehiculo(tipo,kilometrosService)
VALUES ('Camion', 1000),
	   ('Camioneta',750),
	   ('Tractor',800),
	   ('Acoplado',1500);


INSERT INTO estadoVehiculo (estado)
VALUES ('activo'),
	   ('inactivo'),
       ('Mantenimiento'),
       ('Viaje');

INSERT INTO vehiculo(patente, marca,nro_chasis, nro_motor,fecha_fabricacion, id_estadoVehiculo, id_tipoVehiculo)
VALUES ('HTR 128', 'Scania', '12346', '1254', '2010-09-16', '4', '1'),
		('ASD 123', 'Man', '787', '654', '2010-07-24', '1', '2'),
		('WQE 548', 'Volvo', '5587', '354', '2012-08-28', '1', '1'),
		('POI 741', 'Mercedes', '3214', '7785', '2016-06-12', '2', '2'),
		('QWE 789', 'Isuzu', '7854', '654', '2015-05-11', '2', '1'),
		('RET 715', 'GMC', '3214', '65463', '2017-11-03', '3', '3'),
		('ZXC 123', 'Hino', '7842', '6875', '2008-03-07', '4', '2'),
		('YTR 789', 'Ford', '6985', '6453', '2010-01-06', '1', '1'),
		('NBV 998', 'Hummer', '467', '646', '2010-12-05', '4', '1'),
		('OPU 215', 'Mack Trucks', '67', '654', '2009-10-07', '1', '1'),
		('SAD 213', 'Man', '7857', '654', '2010-07-24', '1', '1'),
		('QWE 458', 'Volvo', '87', '354', '2012-08-28', '1', '1'),
		('OPI 471', 'Mercedes', '34', '75', '2016-06-12', '2', '3'),
		('WQE 879', 'Isuzu', '754', '654', '2015-05-11', '2', '2'),
		('ERT 175', 'GMC', '14', '663', '2017-11-03', '3', '1'),
		('XZC 213', 'Hino', '72', '675', '2008-03-07', '4', '3'),
		('TYR 879', 'Ford', '85', '63', '2010-01-06', '1', '3'),
		('BNV 998', 'Hummer', '47', '6546', '2010-12-05', '2', '2'),
		('POU 215', 'Mack Trucks', '467', '654', '2009-10-07', '1', '2');

INSERT INTO mantenimiento(fecha_inicio, fecha_fin, kilometros, costo, id_servicio, id_vehiculo, mecanico, repuestoCambiado,externo)
 VALUES ('2017-11-01', '2017-11-30', '50000', '2300', '1', '1', 'Pedro', 'cubiertas',0),
		('2017-10-01', '2017-11-30', '30000', '2300', '3', '2', 'Cecilia', 'aceite, agua',1),
		('2017-01-01', '2017-11-30', '20000', '2300', '4', '3', 'Luis', 'disco de frenos',1),
		('2017-02-01', '2017-02-11', '10000', '2300', '5', '4', 'Juan', 'motor',0),
		('2017-07-01', '2017-07-07', '8000', '2300', '6', '5', 'Marcos', 'service completo',0),
		('2017-03-01', '2017-04-01', '8900', '2300', '7', '1', 'Pedro', 'Cambio de faros',1);

INSERT INTO viaje ( descripcion, origen, destino, fecha_inicio, fecha_fin, tiempo_estimado, tiempo_real, combustible_estimado, combustible_real,kilometro_estimado,kilometro_real,estado,id_cliente,id_vehiculo, id_vehiculoAcoplado, id_chofer, id_chofer2) 
VALUES ( 'transporte 01', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '10', '15', '30', 'activo', '1', '1', NULL, '1', NULL),
	    ('transporte 02', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '20', '15', '150', 'activo', '2', '2', NULL, '1', NULL),
	    ('transporte 03', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '15', '15', '30', 'activo', '3', '3', NULL, '1', NULL),
	    ('transporte 04', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '30', '15', '150', 'activo', '1', '4', NULL, '1', NULL),
	    ('transporte 05', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '35', '15', '30', 'activo', '2', '5', NULL, '1', NULL),
	    ('transporte 06', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '40', '15', '150', 'activo', '1', '6', NULL, '1', NULL),
	    ('transporte 07', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '18', '15', '30', 'activo', '3', '7', NULL, '1', NULL),
	    ('transporte 08', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '98', '15', '150', 'activo', '1', '8', NULL, '1', NULL),
		('transporte 09', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '20', '15', '150', 'activo', '3', '9', NULL, '1', NULL),
	    ('transporte 10', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '15', '15', '30', 'activo', '3', '10', NULL, '1', NULL),
	    ('transporte 11', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '30', '15', '150', 'activo', '1', '11', NULL, '1', NULL),
	    ('transporte 12', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '35', '15', '30', 'activo', '2', '12', NULL, '1', NULL),
	    ('transporte 13', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '40', '15', '150', 'activo', '2', '13', NULL, '1', NULL),
	    ('transporte 14', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '18', '15', '30', 'activo', '1', '14', NULL, '1', NULL),
	    ('transporte 15', 'calle 1 ', 'calle 1 ', '2017-11-30', '2017-11-30', '30', '30', '10', '98', '15', '150', 'activo', '3', '15', NULL, '1', NULL);
		
		
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

/*Grafico - tipo vehiculo combustible*/
SELECT t.tipo , avg(v.combustible_real)
FROM viaje v join  vehiculo ve on ve.id=v.id_vehiculo JOIN tipovehiculo t on t.id_tipo=ve.id_tipoVehiculo
GROUP by t.id_tipo , t.tipo
