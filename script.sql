
DROP TABLE IF EXISTS cotizacion;
DROP TABLE IF EXISTS evento;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS item;

create table usuario(
id_usuario serial,
nombre varchar(100),
apellido varchar(100),
correo varchar(100) unique,
clave varchar(100),
roles json,
estado varchar(1),
constraint pk_usuario primary key (id_usuario)
);

create table item(
    id_item serial,
    tipo_item varchar(100),
    precio_item real,
	id_evento int,
	id_cotizacion int,
	
	constraint pk_item primary key (id_item)

);

create table cotizacion(
    id_cotizacion serial,
    costo_cotizacion real,
    cant_items int,
    id_item int,
	id_usuario int,

    constraint pk_cotizacion primary key (id_cotizacion),
    constraint fk_cotizacion_usuario foreign key(id_usuario)
		references usuario(id_usuario),
    constraint fk_cotizacion_item foreign key(id_item)
		references item(id_item)
);

create table evento(
    id_evento serial,
    costo_evento real,
    fecha timestamp,
	id_usuario int,

    constraint pk_evento primary key (id_evento),
    constraint fk_evento_usuario foreign key(id_usuario)
		references usuario(id_usuario)
);



INSERT INTO usuario(
nombre, apellido, correo, clave, roles, estado)
VALUES
(
'Josthin', 'Ayon', 'oswayon9@hotmail.com',
'$2y$13$yE9EI8TQZ04C9HWWmcpWOuLQbm8l/zAHa2SKr.EpkyQLhengUBMuS',
'["ROLE_ADMIN"]', 'A' 
);

