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
    password varchar(225),
    id_rol int ,
    foreign key(id_rol) references Rol(id)
);

CREATE TABLE Empleado(
    id INT NOT NULL AUTO_INCREMENT primary key ,
    id_usuario int,
    nombre varchar(50),
    apellido varchar(80),
    id_tipoDoc int,
    numDoc varchar(15),
    telefono varchar(50),
    foreign key(id_usuario) references Usuario(id),
    foreign key(id_tipoDoc) references TipoDocumento(id)
);

CREATE TABLE VehiculoEstado (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion varchar(50)
);

CREATE TABLE VehiculoTipo (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    descripcion varchar(50)
);

CREATE TABLE Vehiculo (
    id INT NOT NULL AUTO_INCREMENT primary key ,
    patente varchar (15),
    id_tipoVehiculo int,
    id_estado int ,
    foreign key(id_estado) references VehiculoEstado(id),
    foreign key(id_tipoVehiculo) references VehiculoTipo(id)
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
