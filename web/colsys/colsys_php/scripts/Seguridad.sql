/* Tablas Básicas para Sistema de Seguridad */;

-- Table: tb_usuarios
CREATE TABLE public.tb_usuarios (
  ca_login varchar(15) NOT NULL, 
  ca_nombre varchar(250) NOT NULL, 
  ca_cargo varchar(40) NOT NULL, 
  ca_departamento varchar(50) NOT NULL, 
  ca_sucursal varchar (50) NOT NULL,
  ca_rutinas text, 
  CONSTRAINT pk_tb_usuarios PRIMARY KEY (ca_login)
) WITH OIDS;
REVOKE ALL ON TABLE tb_usuarios FROM PUBLIC;
GRANT ALL ON TABLE tb_usuarios TO "Administrador";
GRANT ALL ON TABLE tb_usuarios TO GROUP "Usuarios";


-- Table: tb_basededatos
CREATE TABLE public.tb_basededatos (
  ca_basededatos varchar(250) NOT NULL, 
  ca_descripcion varchar(250) NOT NULL, 
  ca_servidor varchar(250) NOT NULL, 
  CONSTRAINT pk_tb_basededatos PRIMARY KEY (ca_basededatos)
) WITH OIDS;
REVOKE ALL ON TABLE tb_basededatos FROM PUBLIC;
GRANT ALL ON TABLE tb_basededatos TO "Administrador";
GRANT ALL ON TABLE tb_basededatos TO GROUP "Usuarios";


-- Table: tb_niveles
CREATE TABLE tb_niveles (
  ca_login varchar(15) NOT NULL, 
  ca_basededatos varchar(250) NOT NULL, 
  ca_nivel varchar(15) NOT NULL, 
  CONSTRAINT pk_tb_niveles PRIMARY KEY (ca_login, ca_basededatos),
  CONSTRAINT fk_tb_niveles FOREIGN KEY (ca_login) REFERENCES tb_usuarios (ca_login) ON DELETE NO ACTION ON UPDATE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE
) WITH OIDS;
REVOKE ALL ON TABLE tb_niveles FROM PUBLIC;
GRANT ALL ON TABLE tb_niveles TO "Administrador";
GRANT ALL ON TABLE tb_niveles TO GROUP "Usuarios";


-- Table: tb_rutinas
CREATE TABLE tb_rutinas (
  ca_rutina varchar(15) NOT NULL, 
  ca_opcion varchar(25) NOT NULL, 
  ca_descripcion varchar(250) NOT NULL, 
  ca_programa varchar(25) NOT NULL, 
  CONSTRAINT pk_tb_rutinas PRIMARY KEY (ca_rutina)
) WITH OIDS;
REVOKE ALL ON TABLE tb_rutinas FROM PUBLIC;
GRANT ALL ON TABLE tb_rutinas TO "Administrador";
GRANT ALL ON TABLE tb_rutinas TO GROUP "Usuarios";


create table tb_permisos
( ca_rutina varchar(15) UNIQUE NOT NULL
, ca_descripcion varchar(250) NOT NULL
, ca_nivel varchar(15) NOT NULL
, constraint pk_tb_permisos PRIMARY KEY (ca_rutina)
);


create table tb_auditoria
( ca_rutina varchar(15) references tb_permisos NOT NULL
, ca_login varchar(15) references tb_usuarios NOT NULL
, ca_respuesta varchar(15) NOT NULL
, ca_maquina varchar(15) NOT NULL
, ca_fecha date NOT NULL
, ca_hora  time NOT NULL
, constraint pk_tb_auditoria PRIMARY KEY (ca_rutina, ca_fecha, ca_hora)
);


insert into tb_basededatos values ('Coltrans', 'Sistema de Infomación Coltrans S.A.', 'CCB-106');
insert into tb_usuarios values ('Administrador', 'Administrador del Motor PostgreSQL','0100100000|0100200000|0100300000|0100400000|0100500000|0100600000|0100700000|0100800000|0100900000|0200100000|0200200000|0300100000');

insert into tb_niveles values ('falopez', 'Coltrans', 'Superusuario');
insert into tb_usuarios values ('falopez', 'Administrador DB PostgreSQL','0100100000|0100200000|0100300000|0100400000|0100500000|0100600000|0100700000|0100800000|0100900000|0200100000|0200200000|0300100000');

GRANT ALL ON TABLE  TO GROUP "Usuarios";

GRANT ALL ON TABLE tb_agentes TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_ciudades TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_columnas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_conceptos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_contactos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_cotizaciones TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_fletes TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_grupos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_liberaciones TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_monedas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_planillas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_recargos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_recargosxtraf TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_representantes TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_tblgastos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_tiporecargo TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_traficos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_transporcontac TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_transporlineas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_transportistas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_trayectos TO GROUP "Usuarios";

GRANT ALL ON TABLE tb_auditoria TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_basededatos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_niveles TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_permisos TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_rutinas TO GROUP "Usuarios";
GRANT ALL ON TABLE tb_usuarios TO GROUP "Usuarios";

GRANT ALL PRIVILEGES ON vi_agentes TO PUBLIC;

GRANT ALL PRIVILEGES ON vi_agentes TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_ciudades TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_columnas TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_conceptos TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_contactos TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_cotizaimpo TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_fletes TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_liberaciones TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_monedas TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_planillas TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_recargos TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_recargosxtraf TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_representantes TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_tblgastos TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_traficos TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_transporcontac TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_transporlineas TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_transportistas TO PUBLIC;
GRANT ALL PRIVILEGES ON vi_trayectos TO PUBLIC;

GRANT ALL PRIVILEGES ON tb_agentes_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_columnas_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_conceptos_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_cotizaciones_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_grupos_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_liberaciones_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_tblgastos_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_tiporecargo_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_transporcontac_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_transporlineas_id TO PUBLIC;
GRANT ALL PRIVILEGES ON tb_trayectos_id TO PUBLIC;


CREATE USER carlopez WITH PASSWORD 'carlopez' NOCREATEDB NOCREATEUSER IN GROUP "Usuarios";

CREATE USER carlopez WITH ENCRYPTED PASSWORD 'carlopez' NOCREATEDB NOCREATEUSER IN GROUP "Usuarios";
