CREATE DATABASE VijesPepe;

CREATE TABLE Rol (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 descripcion varchar(50)
);

CREATE TABLE TipoDocumento (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 descripcion varchar(50)
);

CREATE TABLE Usuario (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 usuario varchar (64),
 password varchar,
 id_rol int ,
 foreign key(id_rol) references  rol(id)
 
);

CREATE TABLE Empleado(
 id INT NOT NULL AUTO_INCREMENT primary key ,
 id_usuario int ,
 nombre varchar(50),
 apellido varchar(80),
 id_tipoDoc int ,
 numDoc varchar ,
 telefono varchar ,
 foreign key(id_usuario) references  usuario(id),
 foreign key(id_tipoDoc) references  TipoDocumento(id)
);

CREATE TABLE Estado (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 descripcion varchar
 
);

CREATE TABLE Vehiculo (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 descripcion varchar
 
);

CREATE TABLE Vehiculo (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 patente varchar (15),
 id_tipoVehiculo int,
 id_estado int ,
 foreign key(id_estado) references  estado(id),
 foreign key(id_tipoVehiculo) references  TipoVehiculo(id)
 
);

CREATE TABLE Cliente (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 nombre varchar (50),
 apellido varchar,
 compania varchar
 
);

create table Viaje(
id INT NOT NULL AUTO_INCREMENT primary key,
descripcion varchar,
origen varchar,
destino varchar,
fecha_inicio date,
fecha_fin date,
tiempo_estimado time ,
tiempo_real time,
desviacion varchar,
combustible_estimado int,
 foreign key(id_cliente) references  cliente(id),
 foreign key(id_vehiculo) references  vehiculo(id),
 foreign key(id_chofer) references  chofer(id)
 );
 
CREATE TABLE Servicio (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 descripcion varchar
);


CREATE TABLE Mantenimiento (
 id INT NOT NULL AUTO_INCREMENT primary key ,
 fecha_inicio datetime,
 fecha_fin datetime,
 kilometros int,
 costo decimal ,
 foreign key(id_servicio) references  Servicio(id)
);