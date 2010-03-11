/* Sistema de Información Coltrans S.A. - Script SLQ */;

/* Tabla de monedas con su equivalencia en dolares y de dolar a pesos Col. */;

create table tb_monedas
( ca_idmoneda varchar (3) UNIQUE NOT NULL
, ca_nombre varchar (30) UNIQUE NOT NULL
, ca_referencia varchar (3) references tb_monedas NOT NULL
, constraint pk_tb_monedas PRIMARY KEY (ca_idmoneda)
);


/* Ojo se necesita una tabla para llevar La T.R.M. por periodo
, ca_fecha date NOT NULL
, ca_dolar real
, ca_tasacambio real

*/

/* Generador de Id para la tabla tb_agentes */;

create sequence tb_agentes_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_agentes_id FROM PUBLIC;
GRANT ALL ON tb_agentes_id TO "Administrador";
GRANT ALL ON tb_agentes_id TO GROUP "Usuarios";


/* Tabla de Agentes */;

create table tb_agentes
( ca_idagente numeric(9) UNIQUE NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_direccion varchar (100) NOT NULL
, ca_telefonos varchar (30) NOT NULL
, ca_fax varchar (30) NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_zipcode varchar (20) NOT NULL
, ca_website varchar (60) NOT NULL
, ca_email varchar (40) NOT NULL
, ca_tipo varchar (10) NOT NULL
, ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_agentes PRIMARY KEY (ca_idagente)
);



/* Tabla de Contactos */;

create table tb_contactos
( ca_idcontacto varchar(9) UNIQUE NOT NULL
, ca_idagente numeric(9) references tb_agentes NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_direccion varchar (100)
, ca_telefonos varchar (30)
, ca_fax varchar (30) NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_email varchar (50)
, ca_impoexpo text NOT NULL
, ca_transporte text NOT NULL
, ca_cargo varchar (20)
, ca_detalle varchar (100)
, ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_contactos PRIMARY KEY (ca_idcontacto)
);


/* Generador de Id para la tabla tb_grupos */;

create sequence tb_grupos_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_grupos_id FROM PUBLIC;
GRANT ALL ON tb_grupos_id TO "Administrador";
GRANT ALL ON tb_grupos_id TO GROUP "Usuarios";


/* Tabla de Grupos */;

create table tb_grupos
( ca_idgrupo smallint DEFAULT nextval('tb_grupos_id') UNIQUE NOT NULL
, ca_descripcion varchar (40) NOT NULL
, constraint pk_tb_grupos PRIMARY KEY (ca_idgrupo)
);


/* Generador de Id para la tabla tb_costos */;

create sequence tb_costos_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_costos_id FROM PUBLIC;
GRANT ALL ON tb_costos_id TO "Administrador";
GRANT ALL ON tb_costos_id TO GROUP "Usuarios";


/* Tabla de Costos para Cargues */;

create table tb_costos
( ca_idcosto smallint DEFAULT nextval('tb_costos_id') UNIQUE NOT NULL
, ca_costo varchar (30) NOT NULL
, ca_transporte varchar (10) NOT NULL
, ca_impoexpo varchar (15) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_comisionable varchar (2) NOT NULL
, constraint pk_tb_costos PRIMARY KEY (ca_idcosto)
);
REVOKE ALL ON tb_costos FROM PUBLIC;
GRANT ALL ON tb_costos TO "Administrador";
GRANT ALL ON tb_costos TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_deducciones */;

create sequence tb_deducciones_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_costos_id FROM PUBLIC;
GRANT ALL ON tb_deducciones_id TO "Administrador";
GRANT ALL ON tb_deducciones_id TO GROUP "Usuarios";


/* Tabla de Costos para Cargues */;

create table tb_deducciones
( ca_iddeduccion smallint DEFAULT nextval('tb_deducciones_id') UNIQUE NOT NULL
, ca_deduccion varchar (30) NOT NULL
, ca_transporte varchar (10) NOT NULL
, ca_impoexpo varchar (15) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, constraint pk_tb_deducciones PRIMARY KEY (ca_iddeduccion)
);
REVOKE ALL ON tb_deducciones FROM PUBLIC;
GRANT ALL ON tb_deducciones TO "Administrador";
GRANT ALL ON tb_deducciones TO GROUP "Usuarios";


/* Tabla de Traficos */;

create table tb_traficos
( ca_idtrafico varchar (6) UNIQUE NOT NULL
, ca_nombre varchar (40) NOT NULL
, ca_bandera varchar (30) NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_idgrupo smallint references tb_grupos NOT NULL
, ca_link varchar (30)
, constraint pk_tb_traficos PRIMARY KEY (ca_idtrafico)
);


/* Tabla de Ciudades */;

create table tb_ciudades
( ca_idciudad varchar (8) UNIQUE NOT NULL
, ca_ciudad varchar (50) NOT NULL
, ca_idtrafico varchar (6) references tb_traficos NOT NULL
, ca_puerto varchar (10) NOT NULL
, constraint pk_tb_ciudades PRIMARY KEY (ca_idciudad, ca_idtrafico)
);


/* Tabla de Transportistas */;

create table tb_transportistas
( ca_idtransportista numeric(9) UNIQUE NOT NULL
, ca_digito numeric(1) NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_direccion varchar (80) NOT NULL
, ca_telefonos varchar (30) NOT NULL
, ca_fax varchar (30) NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_website varchar (60) NOT NULL
, ca_email varchar (40) NOT NULL
, constraint pk_tb_transportistas PRIMARY KEY (ca_idtransportista)
);


/* Generador de Id para la tabla tb_transporcontac */;

create sequence tb_transporcontac_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_transporcontac_id FROM PUBLIC;
GRANT ALL ON tb_transporcontac_id TO "Administrador";
GRANT ALL ON tb_transporcontac_id TO GROUP "Usuarios";


/* Tabla de Contactos en Transportistas */;

create table tb_transporcontac
( ca_idcontacto smallint DEFAULT nextval('tb_transporcontac_id') UNIQUE NOT NULL
, ca_idtransportista numeric(9) references tb_transportistas NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_telefonos varchar (30)
, ca_fax varchar (30) NOT NULL
, ca_email varchar (40)
, ca_observaciones text
, constraint pk_tb_transporcontac PRIMARY KEY (ca_idcontacto)
, constraint fk_tb_transporcontac FOREIGN KEY (ca_idtransportista) REFERENCES tb_transportistas (ca_idtransportista)
);


/* Generador de Id para la tabla tb_transporcontac */;

create sequence tb_transporlineas_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_transporlineas_id FROM PUBLIC;
GRANT ALL ON tb_transporlineas_id TO "Administrador";
GRANT ALL ON tb_transporlineas_id TO GROUP "Usuarios";


/* Tabla de Líneas en Transportistas */;

create table tb_transporlineas
( ca_idlinea smallint DEFAULT nextval('tb_transporlineas_id') UNIQUE NOT NULL
, ca_idtransportista numeric(9) references tb_transportistas NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_sigla varchar (20)
, ca_transporte varchar (10) NOT NULL
, constraint pk_tb_transporlineas PRIMARY KEY (ca_idlinea)
);


/* Generador de Id para la tabla tb_trayectos */;

create sequence tb_trayectos_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_trayectos_id FROM PUBLIC;
GRANT ALL ON tb_trayectos_id TO "Administrador";
GRANT ALL ON tb_trayectos_id TO GROUP "Usuarios";


/* Tabla de Trayectos */;

create table tb_trayectos
( ca_idtrayecto smallint DEFAULT nextval('tb_trayectos_id') UNIQUE NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_idlinea smallint references tb_transporlineas NOT NULL
, ca_transporte varchar (10) NOT NULL
, ca_terminal text
, ca_impoexpo varchar (15) NOT NULL
, ca_frecuencia varchar (20) NOT NULL
, ca_tiempotransito varchar (25) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_fchcreado date NOT NULL
, ca_idtarifas smallint DEFAULT currval('tb_trayectos_id')
, ca_observaciones text
, ca_idagente numeric(9)
, constraint pk_tb_trayectos PRIMARY KEY (ca_idtrayecto, ca_idagente, ca_idtarifas)
, constraint fk_tb_trayectos_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_trayectos_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_trayectos_t FOREIGN KEY (ca_idtarifas) REFERENCES tb_trayectos (ca_idtrayecto)
, constraint fk_tb_trayectos_tr FOREIGN KEY (ca_idlinea) REFERENCES tb_transporlineas (ca_idlinea)
);
REVOKE ALL ON tb_trayectos FROM PUBLIC;
GRANT ALL ON tb_trayectos TO "Administrador";
GRANT ALL ON tb_trayectos TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_conceptos */;

create sequence tb_conceptos_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_conceptos_id FROM PUBLIC;
GRANT ALL ON tb_conceptos_id TO "Administrador";
GRANT ALL ON tb_conceptos_id TO GROUP "Usuarios";


/* Tabla de Traficos */;

create table tb_conceptos
( ca_idconcepto smallint DEFAULT nextval('tb_conceptos_id') UNIQUE NOT NULL
, ca_concepto varchar (30) NOT NULL
, ca_unidad varchar (20) NOT NULL
, ca_transporte varchar (10) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_pregunta varchar (250)
, ca_liminferior smallint NOT NULL
, constraint pk_tb_conceptos PRIMARY KEY (ca_idconcepto)
);


/* Tabla de Fletes */;

create table tb_fletes
( ca_idtrayecto smallint references tb_trayectos NOT NULL
, ca_idconcepto smallint references tb_conceptos NOT NULL
, ca_vlrneto decimal (15,6) NOT NULL
, ca_vlrminimo decimal (15,6)
, ca_vlrsenior decimal (15,6)
, ca_vlrjunior decimal (15,6)
, ca_fleteminimo decimal (15,6)
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_observaciones text
, ca_fchinicio date NOT NULL
, ca_fchvencimiento date NOT NULL
, ca_sugerida varchar (1)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_fletes PRIMARY KEY (ca_idtrayecto, ca_idconcepto, ca_fchinicio)
);



/* Generador de Id para la tabla tb_tiporecargo */;

create sequence tb_tiporecargo_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_tiporecargo_id FROM PUBLIC;
GRANT ALL ON tb_tiporecargo_id TO "Administrador";
GRANT ALL ON tb_tiporecargo_id TO GROUP "Usuarios";


/* Tabla de Traficos */;

create table tb_tiporecargo
( ca_idrecargo smallint DEFAULT nextval('tb_tiporecargo_id') UNIQUE NOT NULL
, ca_recargo varchar (50) NOT NULL
, ca_tipo varchar (20) NOT NULL
, ca_transporte varchar (10) NOT NULL
, ca_incoterms text NOT NULL
, constraint pk_tb_tiporecargo PRIMARY KEY (ca_idrecargo)
);

/* Tabla de Recargos */;

create table tb_recargos
( ca_idtrayecto smallint references tb_trayectos NOT NULL
, ca_idconcepto smallint references tb_conceptos NOT NULL
, ca_idrecargo smallint references tb_tiporecargo NOT NULL
, ca_aplicacion varchar (10) NOT NULL
, ca_fchinicio date
, ca_fchvencimiento date
, ca_vlrfijo decimal (15,6)
, ca_porcentaje decimal ( 5,2)
, ca_baseporcentaje varchar (20) NOT NULL
, ca_vlrunitario decimal (15,6)
, ca_baseunitario varchar (30) NOT NULL
, ca_recargominimo decimal (15,6)
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_recargos PRIMARY KEY (ca_idtrayecto, ca_idconcepto, ca_idrecargo, ca_fchinicio)
);


/* Tabla de Recargos para Trafico o Ciudad de Trafico*/;

create table tb_recargosxtraf
( ca_idtrafico varchar (6) references tb_traficos NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_idrecargo smallint references tb_tiporecargo NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_impoexpo varchar (15) NOT NULL
, ca_aplicacion varchar (10) NOT NULL
, ca_fchinicio date
, ca_fchvencimiento date
, ca_vlrfijo decimal (15,6)
, ca_porcentaje decimal ( 5,2)
, ca_baseporcentaje varchar (20) NOT NULL
, ca_vlrunitario decimal (15,6)
, ca_baseunitario varchar (30) NOT NULL
, ca_recargominimo decimal (15,6)
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_observaciones text
, constraint pk_tb_recargosxtra PRIMARY KEY (ca_idtrafico, ca_idciudad, ca_idrecargo)
);
REVOKE ALL ON tb_recargosxtraf FROM PUBLIC;
GRANT ALL ON tb_recargosxtraf TO "Administrador";
GRANT ALL ON tb_recargosxtraf TO GROUP "Usuarios";



/* Generador de Id para la tabla tb_fileheader */;

drop sequence tb_fileheader_id;
create sequence tb_fileheader_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_fileheader_id FROM PUBLIC;
GRANT ALL ON tb_fileheader_id TO "Administrador";
GRANT ALL ON tb_fileheader_id TO GROUP "Usuarios";


/* Maestra de Cabeceras Importación Archivos */;

drop table tb_fileheader cascade;
create table tb_fileheader
( ca_idfileheader smallint DEFAULT nextval('tb_fileheader_id') UNIQUE NOT NULL
, ca_descripcion varchar (40) NOT NULL
, ca_tipoarchivo varchar (40) NOT NULL
, ca_separador varchar (1) NOT NULL
, ca_separadordec varchar (1) NOT NULL
, ca_in_out varchar (3) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_fileheader PRIMARY KEY (ca_idfileheader)
);
REVOKE ALL ON tb_fileheader FROM PUBLIC;
GRANT ALL ON tb_fileheader TO "Administrador";
GRANT ALL ON tb_fileheader TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_filecolumns */;

drop sequence tb_filecolumns_id;
create sequence tb_filecolumns_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_filecolumns_id FROM PUBLIC;
GRANT ALL ON tb_filecolumns_id TO "Administrador";
GRANT ALL ON tb_filecolumns_id TO GROUP "Usuarios";


/* Tabla de Columnas en Importación de Archivos */;

drop table tb_filecolumns cascade;
create table tb_filecolumns
( ca_idfileheader smallint NOT NULL
, ca_idcolumna smallint DEFAULT nextval('tb_filecolumns_id') UNIQUE NOT NULL
, ca_columna varchar (40) NOT NULL
, ca_label varchar (250) NOT NULL
, ca_mascara varchar (40)
, ca_tipo varchar (20) NOT NULL
, ca_longitud smallint NOT NULL
, ca_precision smallint
, ca_condicion boolean NOT NULL DEFAULT false
, ca_idregistro smallint NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_filecolumns PRIMARY KEY (ca_idfileheader, ca_idcolumna)
, constraint fk_tb_filecolumns FOREIGN KEY (ca_idfileheader) REFERENCES tb_fileheader (ca_idfileheader)
, constraint fk_tb_filecolumns_rf FOREIGN KEY (ca_idregistro) REFERENCES tb_filecolumns (ca_idcolumna)
);
REVOKE ALL ON tb_filecolumns FROM PUBLIC;
GRANT ALL ON tb_filecolumns TO "Administrador";
GRANT ALL ON tb_filecolumns TO GROUP "Usuarios";


/* Tabla de Bitacora sobre Archivos Importados */;

drop table tb_fileimported;
create table tb_fileimported
( ca_idfileheader smallint NOT NULL
, ca_fchimportacion timestamp NOT NULL
, ca_content text
, ca_procesado boolean NOT NULL
, ca_usuario varchar (20) NOT NULL
, constraint pk_tb_fileimported PRIMARY KEY (ca_idfileheader, ca_fchimportacion)
, constraint fk_tb_fileimported FOREIGN KEY (ca_idfileheader) REFERENCES tb_fileheader (ca_idfileheader)
);
REVOKE ALL ON tb_fileimported FROM PUBLIC;
GRANT ALL ON tb_fileimported TO "Administrador";
GRANT ALL ON tb_fileimported TO GROUP "Usuarios";


/* Tabla de Campos para la Salida */;

drop table tb_fileoutput;
create table tb_fileoutput
( ca_idfileheader smallint NOT NULL
, ca_idfilesource smallint NOT NULL
, ca_idcolumna smallint DEFAULT nextval('tb_filecolumns_id') UNIQUE NOT NULL
, ca_idcolsource smallint NOT NULL
, ca_default_val varchar (250)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_fileoutput PRIMARY KEY (ca_idfileheader, ca_idcolumna)
, constraint fk_tb_fileoutput_id FOREIGN KEY (ca_idfileheader) REFERENCES tb_fileheader (ca_idfileheader)
, constraint fk_tb_fileoutput_rf FOREIGN KEY (ca_idfilesource) REFERENCES tb_fileheader (ca_idfileheader)
);
REVOKE ALL ON tb_fileoutput FROM PUBLIC;
GRANT ALL ON tb_fileoutput TO "Administrador";
GRANT ALL ON tb_fileoutput TO GROUP "Usuarios";


/* Tabla de Bitacora sobre Archivos Exportados */;

drop table tb_fileexported;
create table tb_fileexported
( ca_idfileheader smallint references tb_fileheader NOT NULL
, ca_fchexportacion timestamp NOT NULL
, ca_filename varchar (250) NOT NULL
, ca_content text
, ca_usuario varchar (20) NOT NULL
, constraint pk_tb_fileexported PRIMARY KEY (ca_idfileheader, ca_fchexportacion)
, constraint fk_tb_fileexported FOREIGN KEY (ca_idfileheader) REFERENCES tb_fileheader (ca_idfileheader)
);
REVOKE ALL ON tb_fileexported FROM PUBLIC;
GRANT ALL ON tb_fileexported TO "Administrador";
GRANT ALL ON tb_fileexported TO GROUP "Usuarios";



http://www.avis.com/ 2351500  32%


/* Tabla de Clientes */;

create table tb_clientes
( ca_idcliente numeric(11) UNIQUE NOT NULL
, ca_digito numeric(1) NOT NULL
, ca_compania varchar (60) NOT NULL
, ca_papellido varchar (15) NOT NULL
, ca_sapellido varchar (15) NOT NULL
, ca_nombres varchar (30) NOT NULL
, ca_saludo varchar (15) NOT NULL
, ca_sexo varchar (10) NOT NULL
, ca_cumpleanos varchar (30) NOT NULL
, ca_direccion varchar (80) NOT NULL
, ca_oficina varchar (15) NOT NULL
, ca_torre varchar (15) NOT NULL
, ca_bloque varchar (15) NOT NULL
, ca_interior varchar (15) NOT NULL
, ca_localidad varchar (20) NOT NULL
, ca_complemento varchar (50) NOT NULL
, ca_telefonos varchar (30) NOT NULL
, ca_fax varchar (30) NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_website varchar (60) NOT NULL
, ca_email varchar (40) NOT NULL
, ca_actividad text
, ca_sectoreco varchar (30) NOT NULL
, ca_vendedor text NOT NULL
, ca_coordinador varchar(15)
, ca_status varchar (20) NOT NULL
, ca_calificacion varchar (1) NOT NULL
, ca_preferencias text
, ca_fchcircular date
, ca_nvlriesgo varchar (25)
, ca_fchcotratoag date
, ca_listaclinton varchar (2)
, ca_leyinsolvencia varchar (2)
, ca_comentario varchar (255)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_clientes PRIMARY KEY (ca_idcliente)
, constraint pk_tb_clientes_name PRIMARY KEY (ca_compania)
);
REVOKE ALL ON tb_clientes FROM PUBLIC;
GRANT ALL ON tb_clientes TO "Administrador";
GRANT ALL ON tb_clientes TO GROUP "Usuarios";


select ca_idcliente, ca_digito, ca_compania, ca_papellido, ca_sapellido, ca_nombres, ca_saludo, ca_sexo, ca_cumpleanos, ca_direccion, ca_oficina, ca_torre, ca_bloque, ca_interior, ca_localidad, ca_complemento, ca_telefonos, ca_fax, ca_idciudad, ca_website, ca_email, ca_actividad, ca_sectoreco, ca_vendedor, ca_status, ca_calificacion, ca_preferencias, ca_fchcreado, ca_fchactualizado from or_clientes;

/* Generador de Id para la tabla tb_concliente */;

create sequence tb_concliente_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_concliente_id FROM PUBLIC;
GRANT ALL ON tb_concliente_id TO "Administrador";
GRANT ALL ON tb_concliente_id TO GROUP "Usuarios";


/* Tabla de Contactos en Clientes */;

create table tb_concliente
( ca_idcontacto smallint DEFAULT nextval('tb_concliente_id') UNIQUE NOT NULL
, ca_idcliente numeric(11) references tb_clientes NOT NULL
, ca_papellido varchar (15) NOT NULL
, ca_sapellido varchar (15) NOT NULL
, ca_nombres varchar (30) NOT NULL
, ca_saludo varchar (15) NOT NULL
, ca_cargo varchar (40) NOT NULL
, ca_departamento varchar (30) NOT NULL
, ca_telefonos varchar (30)
, ca_fax varchar (30) NOT NULL
, ca_email varchar (40)
, ca_observaciones text
, ca_cumpleanos varchar (20)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_concliente PRIMARY KEY (ca_idcontacto)
);
REVOKE ALL ON tb_concliente FROM PUBLIC;
GRANT ALL ON tb_concliente TO "Administrador";
GRANT ALL ON tb_concliente TO GROUP "Usuarios";


/* Tabla de Liberaciones Automáticas por Cliente */;

// Drop table tb_libcliente cascade;
create table tb_libcliente
( ca_idcliente numeric(11) UNIQUE NOT NULL
, ca_diascredito numeric(5)
, ca_cupo numeric (12)
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_libcliente PRIMARY KEY (ca_idcliente)
, constraint fk_tb_libcliente FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
) WITH OIDS;
REVOKE ALL ON tb_libcliente FROM PUBLIC;
GRANT ALL ON tb_libcliente TO "Administrador";
GRANT ALL ON tb_libcliente TO GROUP "Usuarios";


/* Tabla de Contrato de Comodato por Cliente */;

// Drop table tb_comcliente cascade;
create table tb_comcliente
( ca_idcliente numeric(11) NOT NULL
, ca_fchfirmado date NOT NULL
, ca_fchvencimiento date NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_comcliente PRIMARY KEY (ca_idcliente, ca_fchfirmado)
, constraint fk_tb_comcliente FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
) WITH OIDS;
REVOKE ALL ON tb_comcliente FROM PUBLIC;
GRANT ALL ON tb_comcliente TO "Administrador";
GRANT ALL ON tb_comcliente TO GROUP "Usuarios";



/* Generador de Id para la tabla tb_enccliente */;

create sequence tb_enccliente_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_enccliente_id FROM PUBLIC;
GRANT ALL ON tb_enccliente_id TO "Administrador";
GRANT ALL ON tb_enccliente_id TO GROUP "Usuarios";


/* Tabla de Contactos en Clientes */;

// Drop table tb_enccliente cascade;
create table tb_enccliente
( ca_idencuesta smallint DEFAULT nextval('tb_enccliente_id') UNIQUE NOT NULL
, ca_idcliente numeric(11) references tb_clientes NOT NULL
, ca_fchvisita date
, ca_idcontacto smallint  references tb_concliente NOT NULL
, ca_instalaciones varchar (15) NOT NULL
, ca_compartidas varchar (2) NOT NULL
, ca_condiciones varchar (10) NOT NULL
, ca_vivienda varchar (2) NOT NULL
, ca_vigilancia varchar (10) NOT NULL
, ca_alarma varchar (2) NOT NULL
, ca_masseguridad varchar (2) NOT NULL
, ca_detseguridad varchar (255) NOT NULL
, ca_peracorde varchar (2) NOT NULL
, ca_percarne varchar (2) NOT NULL
, ca_perpresentado varchar (2) NOT NULL
, ca_peruniformado varchar (2) NOT NULL
, ca_mermovimiento varchar (2) NOT NULL
, ca_merorganizado varchar (2) NOT NULL
, ca_merexistencias varchar (2) NOT NULL
, ca_mercontrol varchar (2) NOT NULL
, ca_merinfraestructura varchar (255) NOT NULL
, ca_mersupervision varchar (2) NOT NULL
, ca_mercargue varchar (2) NOT NULL
, ca_merseguridad varchar (2) NOT NULL
, ca_recomendable varchar (2) NOT NULL
, ca_legalidad varchar (2) NOT NULL
, ca_peligro varchar (2) NOT NULL
, ca_explicacion text NOT NULL
, ca_actividad varchar (25) NOT NULL
, ca_estado varchar (15) NOT NULL
, ca_traaereos text NOT NULL
, ca_tramaritimos text NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_enccliente PRIMARY KEY (ca_idencuesta)
, constraint fk_tb_enccliente_cl FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
, constraint fk_tb_enccliente_co FOREIGN KEY (ca_idcontacto) REFERENCES tb_concliente (ca_idcontacto)
);
REVOKE ALL ON tb_enccliente FROM PUBLIC;
GRANT ALL ON tb_enccliente TO "Administrador";
GRANT ALL ON tb_enccliente TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_evecliente */;

create sequence tb_evecliente_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_evecliente_id FROM PUBLIC;
GRANT ALL ON tb_evecliente_id TO "Administrador";
GRANT ALL ON tb_evecliente_id TO GROUP "Usuarios";


/* Tabla de Contactos en Clientes */;

// Drop table tb_evecliente cascade;
create table tb_evecliente
( ca_idevento smallint DEFAULT nextval('tb_evecliente_id') UNIQUE NOT NULL
, ca_idcliente numeric(11) references tb_clientes NOT NULL
, ca_fchevento timestamp NOT NULL
, ca_tipo varchar (25) NOT NULL
, ca_asunto varchar (50) NOT NULL
, ca_detalle text NOT NULL
, ca_compromisos text NOT NULL
, ca_fchcompromiso date NOT NULL
, ca_idantecedente smallint NOT NULL
, ca_usuario varchar (20) NOT NULL
, constraint pk_tb_evecliente PRIMARY KEY (ca_idevento)
);
REVOKE ALL ON tb_evecliente FROM PUBLIC;
GRANT ALL ON tb_evecliente TO "Administrador";
GRANT ALL ON tb_evecliente TO GROUP "Usuarios";


// Drop table tb_stdcliente cascade;
create table tb_stdcliente
( ca_idcliente numeric(11) references tb_clientes NOT NULL
, ca_fchestado timestamp
, ca_estado varchar (25) NOT NULL
, ca_empresa varchar (10) NOT NULL
, constraint pk_tb_stdcliente PRIMARY KEY (ca_idcliente, ca_fchestado, ca_empresa)
);
REVOKE ALL ON tb_stdcliente FROM PUBLIC;
GRANT ALL ON tb_stdcliente TO "Administrador";
GRANT ALL ON tb_stdcliente TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_terceros */;

create sequence tb_terceros_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_terceros_id FROM PUBLIC;
GRANT ALL ON tb_terceros_id TO "Administrador";
GRANT ALL ON tb_terceros_id TO GROUP "Usuarios";


/* Tabla de terceros */;

create table tb_terceros
( ca_idtercero smallint DEFAULT nextval('tb_terceros_id') UNIQUE NOT NULL
, ca_nombre varchar (60) NOT NULL
, ca_contacto varchar (60) NOT NULL
, ca_direccion varchar (100) NOT NULL
, ca_telefonos varchar (30) NOT NULL
, ca_fax varchar (30) NOT NULL
, ca_idciudad varchar (8) NOT NULL
, ca_email varchar (250) NOT NULL
, ca_vendedor text NOT NULL
, ca_tipo varchar (20) NOT NULL
, constraint pk_tb_terceros PRIMARY KEY (ca_idtercero)
);
REVOKE ALL ON tb_terceros FROM PUBLIC;
GRANT ALL ON tb_terceros TO "Administrador";
GRANT ALL ON tb_terceros TO GROUP "Usuarios";

/* Tabla de Clientes Potenciales */;

create table tb_potenciales
( ca_idcliente numeric(11) NOT NULL
, ca_compania varchar (60) NOT NULL
, ca_ncompleto varchar (60) NOT NULL
, ca_departamento varchar (30) NOT NULL
, ca_ciudad varchar (30) NOT NULL
, ca_direccion varchar (80) NOT NULL
, ca_telefonos varchar (30) NOT NULL
, ca_fax varchar (30) NOT NULL
, ca_email varchar (60) NOT NULL
, constraint pk_tb_potenciales PRIMARY KEY (ca_idcliente)
);
REVOKE ALL ON tb_potenciales FROM PUBLIC;
GRANT ALL ON tb_potenciales TO "Administrador";
GRANT ALL ON tb_potenciales TO GROUP "Usuarios";



/* Generador de Id para la tabla tb_cotizaciones */;

drop sequence tb_cotizaciones_id;
create sequence tb_cotizaciones_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_cotizaciones_id FROM PUBLIC;
GRANT ALL ON tb_cotizaciones_id TO "Administrador";
GRANT ALL ON tb_cotizaciones_id TO GROUP "Usuarios";


/* Tablas de Cotizaciones */;

drop table tb_cotizaciones cascade;
create table tb_cotizaciones
( ca_idcotizacion smallint DEFAULT nextval('tb_cotizaciones_id') UNIQUE NOT NULL
, ca_fchcotizacion date NOT NULL
, ca_fchpresentacion timestamp
, ca_idcontacto smallint NOT NULL
, ca_asunto varchar (255) NOT NULL
, ca_saludo varchar (255) NOT NULL
, ca_entrada text NOT NULL
, ca_despedida text NOT NULL
, ca_anexos varchar (255)
, ca_usuario varchar (20) NOT NULL
, ca_fchsolicitud date
, ca_horasolicitud time
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, ca_fchanulado timestamp
, ca_usuanulado varchar (20)
, constraint pk_tb_cotizaciones PRIMARY KEY (ca_idcotizacion)
);
REVOKE ALL ON tb_cotizaciones FROM PUBLIC;
GRANT ALL ON tb_cotizaciones TO "Administrador";
GRANT ALL ON tb_cotizaciones TO GROUP "Usuarios";

alter table tb_cotizaciones add column ca_fchanulado timestamp;
alter table tb_cotizaciones add column ca_usuanulado varchar (20);


/* Generador de Id para la tabla tb_cotproductos_id */;

drop sequence tb_cotproductos_id;
create sequence tb_cotproductos_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_cotproductos_id FROM PUBLIC;
GRANT ALL ON tb_cotproductos_id TO "Administrador";
GRANT ALL ON tb_cotproductos_id TO GROUP "Usuarios";


/* Tablas de Productos en Cotizaciones */;

drop table tb_cotproductos cascade;
create table tb_cotproductos
( ca_idcotizacion smallint NOT NULL
, ca_idproducto smallint DEFAULT nextval('tb_cotproductos_id') NOT NULL
, ca_producto varchar (250) NOT NULL
, ca_impoexpo text NOT NULL
, ca_transporte text NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_incoterms varchar (50) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_frecuencia varchar (20)
, ca_tiempotransito varchar (25)
, ca_locrecargos text
, ca_datosag text
, ca_observaciones text
, ca_imprimir varchar (15) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_cotproductos PRIMARY KEY (ca_idcotizacion, ca_idproducto)
, constraint fk_tb_cotizaciones FOREIGN KEY (ca_idcotizacion) REFERENCES tb_cotizaciones (ca_idcotizacion)
, constraint fk_tb_cotproductos_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_cotproductos_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
);
REVOKE ALL ON tb_cotproductos FROM PUBLIC;
GRANT ALL ON tb_cotproductos TO "Administrador";
GRANT ALL ON tb_cotproductos TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_cotproductos_id */;

drop sequence tb_cotopciones_id;
create sequence tb_cotopciones_id
minvalue     1
maxvalue 2147483647
increment    1
start        1;
REVOKE ALL ON tb_cotopciones_id FROM PUBLIC;
GRANT ALL ON tb_cotopciones_id TO "Administrador";
GRANT ALL ON tb_cotopciones_id TO GROUP "Usuarios";


/* Tablas de Opciones en Cotizaciones */;

drop table tb_cotopciones cascade;
create table tb_cotopciones
( ca_idcotizacion smallint NOT NULL
, ca_idproducto smallint NOT NULL
, ca_idopcion integer DEFAULT nextval('tb_cotopciones_id') NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_valor_tar decimal (10,2)
, ca_aplica_tar varchar (25)
, ca_valor_min decimal (10,2)
, ca_aplica_min varchar (25)
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_tarifa varchar (250) NOT NULL
, ca_oferta varchar (250) NOT NULL
, ca_recargos text
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_cotopciones PRIMARY KEY (ca_idcotizacion, ca_idproducto, ca_idopcion)
, constraint fk_tb_cotopciones FOREIGN KEY (ca_idcotizacion) REFERENCES tb_cotizaciones (ca_idcotizacion)
, constraint fk_tb_cotproductos FOREIGN KEY (ca_idcotizacion, ca_idproducto) REFERENCES tb_cotproductos (ca_idcotizacion, ca_idproducto)
, constraint fk_tb_cotopciones_c FOREIGN KEY (ca_idconcepto) REFERENCES tb_conceptos (ca_idconcepto)
);
REVOKE ALL ON tb_cotopciones FROM PUBLIC;
GRANT ALL ON tb_cotopciones TO "Administrador";
GRANT ALL ON tb_cotopciones TO GROUP "Usuarios";


/* Tablas de Recargos en Cotizaciones */;

drop table tb_cotrecargos cascade;
create table tb_cotrecargos
( ca_idcotizacion smallint NOT NULL
, ca_idproducto smallint NOT NULL
, ca_idopcion integer NOT NULL
, ca_idconcepto smallint NOT NULL references tb_conceptos NOT NULL
, ca_idrecargo smallint references tb_tiporecargo NOT NULL
, ca_tipo varchar (1) NOT NULL
, ca_valor_tar decimal (10,2) NOT NULL
, ca_aplica_tar varchar (25) NOT NULL
, ca_valor_min decimal (10,2) NOT NULL
, ca_aplica_min varchar (25) NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_cotrecargos PRIMARY KEY (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_modalidad)
, constraint fk_tb_cotrecargos FOREIGN KEY (ca_idcotizacion) REFERENCES tb_cotizaciones (ca_idcotizacion)
) WITH OIDS;
REVOKE ALL ON tb_cotrecargos FROM PUBLIC;
GRANT ALL ON tb_cotrecargos TO "Administrador";
GRANT ALL ON tb_cotrecargos TO GROUP "Usuarios";


/* Tablas de OTM's en Cotizaciones */;

drop table tb_cotcontinuacion cascade;
create table tb_cotcontinuacion
( ca_idcotizacion smallint NOT NULL
, ca_tipo varchar (3) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_idequipo smallint NOT NULL
, ca_valor_tar decimal (10,2)
, ca_valor_min decimal (10,2)
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_tarifa varchar (250) NOT NULL
, ca_frecuencia varchar (20)
, ca_tiempotransito varchar (25)
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_cotcontinuacion PRIMARY KEY (ca_idcotizacion, ca_tipo, ca_origen, ca_destino, ca_idconcepto, ca_idequipo)
, constraint fk_tb_cotcontinuacion FOREIGN KEY (ca_idcotizacion) REFERENCES tb_cotizaciones (ca_idcotizacion)
, constraint fk_tb_cotcontinuacion_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_cotcontinuacion_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
) WITH OIDS;;
REVOKE ALL ON tb_cotcontinuacion FROM PUBLIC;
GRANT ALL ON tb_cotcontinuacion TO "Administrador";
GRANT ALL ON tb_cotcontinuacion TO GROUP "Usuarios";


/* Tablas de Seguro en Cotizaciones */;

drop table tb_cotseguro cascade;
create table tb_cotseguro
( ca_idcotizacion smallint NOT NULL
, ca_prima_tip varchar (1)
, ca_prima_vlr decimal (10,2)
, ca_prima_min decimal (10,2)
, ca_prima varchar (250) NOT NULL
, ca_obtencion varchar (250) NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
) WITH OIDS;;
REVOKE ALL ON tb_cotseguro FROM PUBLIC;
GRANT ALL ON tb_cotseguro TO "Administrador";
GRANT ALL ON tb_cotseguro TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_bodegas */;

create sequence tb_bodegas_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_bodegas_id FROM PUBLIC;
GRANT ALL ON tb_bodegas_id TO "Administrador";
GRANT ALL ON tb_bodegas_id TO GROUP "Usuarios";


/* Tabla de Grupos */;

create table tb_bodegas
( ca_idbodega smallint DEFAULT nextval('tb_bodegas_id') UNIQUE NOT NULL
, ca_nombre varchar (80) NOT NULL
, ca_tipo varchar (40) NOT NULL
, ca_transporte varchar (255) NOT NULL
, constraint pk_tb_bodegas PRIMARY KEY (ca_idbodega)
);
REVOKE ALL ON tb_bodegas FROM PUBLIC;
GRANT ALL ON tb_bodegas TO "Administrador";
GRANT ALL ON tb_bodegas TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_reportes */;

drop sequence tb_reportes_id;
create sequence tb_reportes_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_reportes_id FROM PUBLIC;
GRANT ALL ON tb_reportes_id TO "Administrador";
GRANT ALL ON tb_reportes_id TO GROUP "Usuarios";


/* Tabla de Reporte de Ventas */;

drop table tb_reportes cascade;
create table tb_reportes
( ca_idreporte integer DEFAULT nextval('tb_reportes_id') UNIQUE NOT NULL
, ca_fchreporte date NOT NULL
, ca_consecutivo varchar (10) NOT NULL
, ca_version smallint NOT NULL DEFAULT 1
, ca_idcotizacion numeric(8) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_impoexpo text NOT NULL
, ca_fchdespacho date NOT NULL
, ca_idagente numeric(9) NOT NULL
, ca_incoterms varchar (250) NOT NULL
, ca_mercancia_desc text NOT NULL
, ca_idproveedor varchar (255) NOT NULL
, ca_orden_prov  varchar (255) NOT NULL
, ca_idconcliente smallint NOT NULL
, ca_orden_clie varchar (255) NOT NULL
, ca_confirmar_clie varchar (300) NOT NULL
, ca_idrepresentante numeric(9) NOT NULL
, ca_informar_repr varchar (2) NOT NULL
, ca_idconsignatario numeric(9) NOT NULL
, ca_informar_cons varchar (2) NOT NULL
, ca_idnotify numeric(9) NOT NULL
, ca_informar_noti varchar (2) NOT NULL
, ca_idmaster numeric(9) NOT NULL
, ca_informar_mast varchar (2) NOT NULL
, ca_notify numeric(1) NOT NULL
, ca_transporte varchar (30) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_colmas varchar (2) NOT NULL
, ca_seguro varchar (2) NOT NULL
, ca_liberacion varchar (2) NOT NULL
, ca_tiempocredito varchar (20) NOT NULL
, ca_preferencias_clie text NOT NULL
, ca_instrucciones text NOT NULL
, ca_idlinea smallint NOT NULL
, ca_idconsignar smallint references tb_bodegas NOT NULL
, ca_idbodega smallint references tb_bodegas NOT NULL
, ca_mastersame varchar (2) NOT NULL
, ca_continuacion varchar (10) NOT NULL
, ca_continuacion_dest varchar (8)
, ca_continuacion_conf varchar (250)
, ca_etapa_actual varchar (50)
, ca_login varchar (15) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, ca_fchanulado timestamp
, ca_usuanulado varchar (20)
, ca_fchcerrado timestamp
, ca_usucerrado varchar (20)
, constraint pk_tb_reportes PRIMARY KEY (ca_idreporte)
, constraint uq_tb_reportes UNIQUE (ca_consecutivo, ca_version)
, constraint fk_tb_reportes_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_reportes_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_concliente FOREIGN KEY (ca_idconcliente) REFERENCES tb_concliente (ca_idcontacto)
);
REVOKE ALL ON tb_reportes FROM PUBLIC;
GRANT ALL ON tb_reportes TO "Administrador";
GRANT ALL ON tb_reportes TO GROUP "Usuarios";


/* Tabla unificada de tarifas para Aéreo, Marítimo, Importación y Exportación
drop table tb_reptarifas cascade;
create table tb_reptarifas
( ca_idreporte integer NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_cantidad numeric(5,2)
, ca_neta_tar numeric(10,2)
, ca_neta_min numeric(10,2)
, ca_neta_idm character varying(3)
, ca_reportar_tar numeric(10,2) NOT NULL
, ca_reportar_min numeric(10,2) NOT NULL
, ca_reportar_idm character varying(3) NOT NULL
, ca_cobrar_tar numeric(10,2) NOT NULL
, ca_cobrar_min numeric(10,2) NOT NULL
, ca_cobrar_idm character varying(3) NOT NULL
, ca_observaciones character varying(255)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_reptarifas PRIMARY KEY (ca_idreporte, ca_idconcepto)
, constraint tb_reptarifas_ca_cobrar_idm_fkey FOREIGN KEY (ca_cobrar_idm) REFERENCES tb_monedas (ca_idmoneda)
, constraint tb_reptarifas_ca_neta_idm_fkey FOREIGN KEY (ca_neta_idm) REFERENCES tb_monedas (ca_idmoneda)
, constraint tb_reptarifas_ca_reportar_idm_fkey FOREIGN KEY (ca_reportar_idm) REFERENCES tb_monedas (ca_idmoneda)
) WITH OIDS;
REVOKE ALL ON tb_reptarifas FROM PUBLIC;
GRANT ALL ON tb_reptarifas TO "Administrador";
GRANT ALL ON tb_reptarifas TO GROUP "Usuarios";


/* Tabla de Gastos en Reporte de Ventas */;

drop table tb_repgastos cascade;
create table tb_repgastos
( ca_idreporte integer NOT NULL
, ca_idrecargo smallint references tb_tiporecargo NOT NULL
, ca_aplicacion varchar (25) NOT NULL
, ca_tipo varchar (1) NOT NULL
, ca_neta_tar decimal (10,3) NOT NULL
, ca_neta_min decimal (10,3) NOT NULL
, ca_reportar_tar decimal (10,3) NOT NULL
, ca_reportar_min decimal (10,3) NOT NULL
, ca_cobrar_tar decimal (10,3) NOT NULL
, ca_cobrar_min decimal (10,3) NOT NULL
, ca_idmoneda varchar (3) NOT NULL
, ca_detalles text NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_fchcreado timestamp;
, ca_usucreado varchar (20);
, ca_fchactualizado timestamp;
, ca_usuactualizado varchar (20);
, constraint pk_tb_repgastos PRIMARY KEY (ca_idreporte, ca_idrecargo, ca_idconcepto)
, constraint fk_tb_repgastos FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
, constraint fk_tb_repgastos_t FOREIGN KEY (ca_idrecargo) REFERENCES tb_tiporecargo (ca_idrecargo)
, constraint fk_tb_repgastos_m FOREIGN KEY (ca_idmoneda) REFERENCES tb_monedas (ca_idmoneda)
);
REVOKE ALL ON tb_repgastos FROM PUBLIC;
GRANT ALL ON tb_repgastos TO "Administrador";
GRANT ALL ON tb_repgastos TO GROUP "Usuarios";


drop table tb_repseguro cascade;
create table tb_repseguro
( ca_idreporte integer NOT NULL
, ca_vlrasegurado numeric(15,2) NOT NULL
, ca_idmoneda_vlr character varying(3) NOT NULL
, ca_primaventa numeric(8,2) NOT NULL
, ca_minimaventa numeric(8,2) NOT NULL
, ca_idmoneda_vta character varying(3) NOT NULL
, ca_obtencionpoliza numeric(15,2) NOT NULL
, ca_idmoneda_pol character varying(3) NOT NULL
, ca_seguro_conf character varying(250)
, constraint pk_tb_repseguro PRIMARY KEY (ca_idreporte)
, constraint fk_tb_repseguro FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
, constraint fk_tb_repseguro_ivlr FOREIGN KEY (ca_idmoneda_vlr) REFERENCES tb_monedas (ca_idmoneda)
, constraint fk_tb_repseguro_ipol FOREIGN KEY (ca_idmoneda_pol) REFERENCES tb_monedas (ca_idmoneda)
);
REVOKE ALL ON tb_repseguro FROM PUBLIC;
GRANT ALL ON tb_repseguro TO "Administrador";
GRANT ALL ON tb_repseguro TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_repaduana */;

drop sequence tb_repaduana_id;
create sequence tb_repaduana_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_repaduana_id FROM PUBLIC;
GRANT ALL ON tb_repaduana_id TO "Administrador";
GRANT ALL ON tb_repaduana_id TO GROUP "Usuarios";


drop table tb_repaduana cascade;
create table tb_repaduana
( ca_idreporte integer UNIQUE NOT NULL
, ca_idrepaduana smallint DEFAULT nextval('tb_repaduana_id') UNIQUE NOT NULL
, ca_coordinador varchar(15) NOT NULL
, ca_transnacarga varchar(2) NOT NULL
, ca_transnatipo varchar(25) NOT NULL
, ca_instrucciones text NOT NULL
, ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_repaduana PRIMARY KEY (ca_idreporte, ca_idrepaduana)
, constraint fk_tb_repaduana FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repaduana FROM PUBLIC;
GRANT ALL ON tb_repaduana TO "Administrador";
GRANT ALL ON tb_repaduana TO GROUP "Usuarios";


drop table tb_repaduanadet cascade;
create table tb_repaduanadet
( ca_idreporte integer NOT NULL
, ca_idrepaduana smallint NOT NULL
, ca_idcosto smallint NOT NULL
, ca_tipo varchar(1) NOT NULL
, ca_netcosto decimal (15,2) NOT NULL
, ca_vlrcosto decimal (15,2) NOT NULL
, ca_mincosto decimal (15,2) NOT NULL
, ca_idmoneda varchar (3) NOT NULL
, ca_detalles text NOT NULL
, ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_repaduanadet PRIMARY KEY (ca_idreporte, ca_idrepaduana, ca_idcosto)
, constraint fk_tb_repaduanadet FOREIGN KEY (ca_idreporte, ca_idrepaduana) REFERENCES tb_repaduana (ca_idreporte, ca_idrepaduana)
);
REVOKE ALL ON tb_repaduanadet FROM PUBLIC;
GRANT ALL ON tb_repaduanadet TO "Administrador";
GRANT ALL ON tb_repaduanadet TO GROUP "Usuarios";


drop table tb_repborrador cascade;
create table tb_repborrador
( ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_accion varchar (20)
, ca_contenido text
);
REVOKE ALL ON tb_repborrador FROM PUBLIC;
GRANT ALL ON tb_repborrador TO "Administrador";
GRANT ALL ON tb_repborrador TO GROUP "Usuarios";


drop table tb_repstatus cascade;
create table tb_repstatus
( ca_idreporte integer NOT NULL
, ca_idemail integer references tb_emails NOT NULL
, ca_fchstatus date NOT NULL
, ca_status text NOT NULL
, ca_comentarios text NOT NULL
, ca_etapa varchar (50)
, ca_fchrecibo timestamp NOT NULL
, ca_fchenvio timestamp NOT NULL
, ca_usuenvio varchar(20) NOT NULL
, constraint pk_tb_repstatus PRIMARY KEY (ca_idreporte, ca_idemail)
, constraint fk_tb_repstatus FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repstatus FROM PUBLIC;
GRANT ALL ON tb_repstatus TO "Administrador";
GRANT ALL ON tb_repstatus TO GROUP "Usuarios";


drop table tb_repavisos cascade;
create table tb_repavisos
( ca_idreporte integer NOT NULL
, ca_idemail integer references tb_emails NOT NULL
, ca_introduccion text NOT NULL
, ca_fchsalida date NOT NULL
, ca_fchllegada date NOT NULL
, ca_fchcontinuacion date
, ca_piezas varchar(50) NOT NULL
, ca_peso varchar(50) NOT NULL
, ca_volumen varchar(50) NOT NULL
, ca_doctransporte character varying(20) NOT NULL
, ca_docmaster character varying(20)
, ca_idnave character varying(50) NOT NULL
, ca_notas text NOT NULL
, ca_equipos text
, ca_etapa varchar (50)
, ca_fchenvio timestamp NOT NULL
, ca_usuenvio varchar(20) NOT NULL
, constraint pk_tb_repavisos PRIMARY KEY (ca_idreporte, ca_idemail)
, constraint fk_tb_repavisos FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repavisos FROM PUBLIC;
GRANT ALL ON tb_repavisos TO "Administrador";
GRANT ALL ON tb_repavisos TO GROUP "Usuarios";

 
  ca_notas text NOT NULL,
  ca_fchenvio timestamp without time zone NOT NULL,
  ca_usuenvio character varying(20) NOT NULL,



/* Generador de Id para la tabla tb_emails */;

create sequence tb_emails_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_emails_id FROM PUBLIC;
GRANT ALL ON tb_emails_id TO "Administrador";
GRANT ALL ON tb_emails_id TO GROUP "Usuarios";


/* Tabla para el Control de Emails enviados por el sistema */;

// drop table tb_emails cascade;
create table tb_emails
( ca_idemail integer DEFAULT nextval('tb_emails_id') UNIQUE NOT NULL
, ca_fchenvio timestamp NOT NULL
, ca_usuenvio varchar(20) NOT NULL
, ca_tipo varchar(20) NOT NULL
, ca_idcaso varchar(20) NOT NULL
, ca_from varchar(50) NOT NULL
, ca_fromname varchar(250) NOT NULL
, ca_cc varchar(250) NOT NULL
, ca_replyto varchar(50) NOT NULL
, ca_address varchar(250) NOT NULL
, ca_attachment varchar(250)
, ca_subject varchar(250) NOT NULL
, ca_body text NOT NULL
, constraint pk_tb_emails PRIMARY KEY (ca_idemail)
, constraint uq_tb_emails UNIQUE (ca_idcaso, ca_idemail)
);
REVOKE ALL ON tb_emails FROM PUBLIC;
GRANT ALL ON tb_emails TO "Administrador";
GRANT ALL ON tb_emails TO GROUP "Usuarios";



/* Generador de Id para la tabla tb_attachments */;

create sequence tb_attachments_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_attachments_id FROM PUBLIC;
GRANT ALL ON tb_attachments_id TO "Administrador";
GRANT ALL ON tb_attachments_id TO GROUP "Usuarios";


/* Tabla para el Control de Adjuntos enviados por el sistema */;

// drop table tb_attachments cascade;
create table tb_attachments
( ca_idattachment smallint DEFAULT nextval('tb_attachments_id') UNIQUE NOT NULL
, ca_idemail integer references tb_emails NOT NULL
, ca_extension varchar (4) NOT NULL
, ca_header_file varchar (255) NOT NULL
, ca_filesize varchar (8) NOT NULL
, ca_content bytea NOT NULL
, constraint pk_tb_attachments PRIMARY KEY (ca_idattachment)
);
REVOKE ALL ON tb_attachments FROM PUBLIC;
GRANT ALL ON tb_attachments TO "Administrador";
GRANT ALL ON tb_attachments TO GROUP "Usuarios";



/* Tabla de Información de Cuadros I.N.O. */;
/* ###.##.##.###.##vi_inofacturacion_sea    Composición de la Referencia */

create table tb_inomaestra_sea
( ca_fchreferencia date NOT NULL
, ca_referencia varchar (16) UNIQUE NOT NULL
, ca_impoexpo varchar (15) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_fchembarque date NOT NULL
, ca_fcharribo date NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_idlinea smallint references tb_transporlineas NOT NULL
, ca_motonave varchar (50) NOT NULL
, ca_ciclo varchar (12)
, ca_mbls text
, ca_observaciones text
, ca_fchconfirmacion date
, ca_horaconfirmacion time
, ca_registroadu varchar (20)
, ca_fchregistroadu date
, ca_registrocap varchar (20)
, ca_bandera varchar (20)
, ca_fchdesconsolidacion date
, ca_mnllegada varchar (50)
, ca_fchliberacion date
, ca_nroliberacion varchar (20)
, ca_anulado varchar (1)
, ca_mensaje text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, ca_fchliquidado timestamp
, ca_usuliquidado varchar (20)
, ca_fchcerrado timestamp
, ca_usucerrado varchar (20)
, ca_mensaje text
, ca_fchdesconsolidacion varchar(10)
, ca_mnllegada varchar(50)
, ca_fchregistroadu varchar(10)
, ca_fchconfirmado timestamp
, ca_usuconfirmado varchar (20)
, ca_asunto_otm varchar(255)
, ca_mensaje_otm text
, ca_fchllegada_otm varchar(10)
, ca_ciudad_otm varchar(50)
, ca_fchconfirma_otm timestamp
, ca_usuconfirma_otm varchar (20)
, constraint pk_tb_inomaestra_sea PRIMARY KEY (ca_fchreferencia, ca_referencia)
, constraint fk_tb_inomaestra_sea_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_inomaestra_sea_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_inomaestra_sea FOREIGN KEY (ca_idlinea) REFERENCES tb_transporlineas (ca_idlinea)
);
REVOKE ALL ON tb_inomaestra_sea FROM PUBLIC;
GRANT ALL ON tb_inomaestra_sea TO "Administrador";
GRANT ALL ON tb_inomaestra_sea TO GROUP "Usuarios";


create table tb_inoequipos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idconcepto smallint references tb_conceptos NOT NULL
, ca_cantidad decimal (9,3) NOT NULL
, ca_idequipo varchar (12) NOT NULL
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inoequipos_sea PRIMARY KEY (ca_referencia, ca_idequipo)
, constraint fk_tb_inoequipos_sea FOREIGN KEY (ca_referencia) REFERENCES tb_inomaestra_sea (ca_referencia)
, constraint fk_tb_inoequipos_sea_c FOREIGN KEY (ca_idconcepto) REFERENCES tb_conceptos (ca_idconcepto)
);
create unique index in_tb_inoequipos_sea on tb_inoequipos_sea (ca_idequipo, ca_referencia);
REVOKE ALL ON tb_inoequipos_sea FROM PUBLIC;
GRANT ALL ON tb_inoequipos_sea TO "Administrador";
GRANT ALL ON tb_inoequipos_sea TO GROUP "Usuarios";


create table tb_inocontratos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idequipo varchar (12) NOT NULL
, ca_idcontrato varchar (12) NOT NULL
, ca_fchcontrato date
, ca_inspeccion_nta varchar (10)
, ca_inspeccion_fch date
, ca_observaciones text
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inocontratos_sea PRIMARY KEY (ca_referencia, ca_idequipo)
, constraint fk_tb_inocontratos_sea FOREIGN KEY (ca_referencia, ca_idequipo) REFERENCES tb_inoequipos_sea (ca_referencia, ca_idequipo)
);
REVOKE ALL ON tb_inocontratos_sea FROM PUBLIC;
GRANT ALL ON tb_inocontratos_sea TO "Administrador";
GRANT ALL ON tb_inocontratos_sea TO GROUP "Usuarios";


create table tb_inoclientes_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_idreporte numeric(8) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_idproveedor numeric(9) NOT NULL
, ca_proveedor varchar (50) NOT NULL
, ca_numpiezas numeric(6) NOT NULL
, ca_peso decimal (9,2) NOT NULL
, ca_volumen decimal (9,2) NOT NULL
, ca_numorden varchar (100) NOT NULL
, ca_confirmar text
, ca_mensaje text
, ca_login varchar (15) NOT NULL
, ca_observaciones text
, ca_fchliberacion date
, ca_notaliberacion text
, ca_fchliberado timestamp
, ca_usuliberado varchar (20)
, ca_continuacion varchar (10) NOT NULL
, ca_continuacion_dest varchar (8)
, ca_idbodega smallint NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inoclientes_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls)
, constraint fk_tb_inoclientes_sea FOREIGN KEY (ca_referencia) REFERENCES tb_inomaestra_sea (ca_referencia)
, constraint fk_tb_inoclientes_sea_cl FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
);
REVOKE ALL ON tb_inoclientes_sea FROM PUBLIC;
GRANT ALL ON tb_inoclientes_sea TO "Administrador";
GRANT ALL ON tb_inoclientes_sea TO GROUP "Usuarios";

create table tb_inoingresos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_factura varchar(15) NOT NULL
, ca_fchfactura date NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_neto decimal (15,2) NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_reccaja varchar(15) NOT NULL
, ca_fchpago date
, ca_tcambio decimal (7,2) NOT NULL
, ca_observaciones character (100)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inoingresos_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_factura)
, constraint fk_tb_inoingresos_sea FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
, constraint fk_tb_inoingresos_sea_i FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
) WITH OIDS;
create index in_tb_inoingresos_sea on tb_inoingresos_sea (ca_factura, ca_referencia);
REVOKE ALL ON tb_inoingresos_sea FROM PUBLIC;
GRANT ALL ON tb_inoingresos_sea TO "Administrador";
GRANT ALL ON tb_inoingresos_sea TO GROUP "Usuarios";


create table tb_inodeduccion_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_factura varchar(15) NOT NULL
, ca_iddeduccion smallint NOT NULL
, ca_neto decimal (15,2) NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inodeduccion_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion)
, constraint fk_tb_inodeduccion_sea FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
, constraint fk_tb_inodeduccion_sea_c FOREIGN KEY (ca_iddeduccion) REFERENCES tb_deducciones (ca_iddeduccion)
) WITH OIDS;
REVOKE ALL ON tb_inodeduccion_sea FROM PUBLIC;
GRANT ALL ON tb_inodeduccion_sea TO "Administrador";
GRANT ALL ON tb_inodeduccion_sea TO GROUP "Usuarios";


create table tb_inoutilidad_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_idcosto smallint references tb_costos NOT NULL
, ca_factura varchar (15) NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inoutilidad_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_idcosto, ca_factura)
, constraint fk_tb_inoutilidad_sea FOREIGN KEY (ca_idcosto) REFERENCES tb_costos (ca_idcosto)
, constraint fk_tb_inoutilidad_sea_c FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
);
REVOKE ALL ON tb_inoutilidad_sea FROM PUBLIC;
GRANT ALL ON tb_inoutilidad_sea TO "Administrador";
GRANT ALL ON tb_inoutilidad_sea TO GROUP "Usuarios";


create table tb_inocostos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcosto smallint references tb_costos NOT NULL
, ca_factura varchar (15) NOT NULL
, ca_fchfactura date NOT NULL
, ca_proveedor varchar (50) NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_tcambio decimal (7,2) NOT NULL
, ca_neto decimal (15,2) NOT NULL
, ca_venta decimal (15,2) NOT NULL
, ca_login varchar (15) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inocostos_sea PRIMARY KEY (ca_referencia, ca_idcosto, ca_factura)
, constraint fk_tb_inocostos_sea FOREIGN KEY (ca_referencia) REFERENCES tb_inomaestra_sea (ca_referencia)
, constraint fk_tb_inocostos_sea_c FOREIGN KEY (ca_idcosto) REFERENCES tb_costos (ca_idcosto)
, constraint fk_tb_inocostos_sea_m FOREIGN KEY (ca_idmoneda) REFERENCES tb_monedas (ca_idmoneda)
);
REVOKE ALL ON tb_inocostos_sea FROM PUBLIC;
GRANT ALL ON tb_inocostos_sea TO "Administrador";
GRANT ALL ON tb_inocostos_sea TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_inocomisiones_sea */;

create sequence tb_inocomisiones_sea_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_inocomisiones_sea_id FROM PUBLIC;
GRANT ALL ON tb_inocomisiones_sea_id TO "Administrador";
GRANT ALL ON tb_inocomisiones_sea_id TO GROUP "Usuarios";


create table tb_inocomisiones_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_comprobante smallint NOT NULL
, ca_fchliquidacion date NOT NULL
, ca_vlrcomision decimal (15,2) NOT NULL
, ca_sbrcomision decimal (15,2) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inocomisiones_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_comprobante)
, constraint fk_tb_inocomisiones_sea FOREIGN KEY (ca_referencia) REFERENCES tb_inomaestra_sea (ca_referencia)
);
REVOKE ALL ON tb_inocomisiones_sea FROM PUBLIC;
GRANT ALL ON tb_inocomisiones_sea TO "Administrador";
GRANT ALL ON tb_inocomisiones_sea TO GROUP "Usuarios";


/* Generador de Id para la tabla tb_inoauditor_sea */;

create sequence tb_inoauditor_sea_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_inoauditor_sea_id FROM PUBLIC;
GRANT ALL ON tb_inoauditor_sea_id TO "Administrador";
GRANT ALL ON tb_inoauditor_sea_id TO GROUP "Usuarios";


/* Tabla de Contactos en Clientes */;

// Drop table tb_inoauditor_sea cascade;
create table tb_inoauditor_sea
( ca_idevento smallint DEFAULT nextval('tb_inoauditor_sea_id') UNIQUE NOT NULL
, ca_referencia varchar (16) NOT NULL
, ca_fchevento timestamp NOT NULL
, ca_tipo varchar (25) NOT NULL
, ca_asunto varchar (50) NOT NULL
, ca_detalle text NOT NULL
, ca_compromisos text NOT NULL
, ca_fchcompromiso date NOT NULL
, ca_idantecedente smallint NOT NULL
, ca_usuario varchar (20) NOT NULL
, constraint pk_tb_inoauditor_sea PRIMARY KEY (ca_idevento)
, constraint fk_tb_inoauditor_sea FOREIGN KEY (ca_referencia) REFERENCES tb_inomaestra_sea (ca_referencia)
);
REVOKE ALL ON tb_inoauditor_sea FROM PUBLIC;
GRANT ALL ON tb_inoauditor_sea TO "Administrador";
GRANT ALL ON tb_inoauditor_sea TO GROUP "Usuarios";


-- drop table tb_inoavisos_sea cascade;
create table tb_inoavisos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_idemail integer references tb_emails NOT NULL
, ca_fchaviso date NOT NULL
, ca_aviso text NOT NULL
, ca_idbodega smallint
, ca_fchllegada date
, ca_fchenvio timestamp NOT NULL
, ca_usuenvio varchar(20) NOT NULL
, constraint pk_tb_inoavisos_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_idemail)
, constraint fk_tb_inoavisos_sea FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
);
REVOKE ALL ON tb_inoavisos_sea FROM PUBLIC;
GRANT ALL ON tb_inoavisos_sea TO "Administrador";
GRANT ALL ON tb_inoavisos_sea TO GROUP "Usuarios";


/* Tabla histórica de Días Festivos por Año*/
create table tb_festivos
( ca_fchfestivo date UNIQUE NOT NULL
, constraint pk_tb_festivos PRIMARY KEY (ca_fchfestivo)
);
REVOKE ALL ON tb_festivos FROM PUBLIC;
GRANT ALL ON tb_festivos TO "Administrador";
GRANT ALL ON tb_festivos TO GROUP "Usuarios";


/* Tabla de Registros para Lista Clinton*/
create table tb_sdn
( ca_uid smallint UNIQUE NOT NULL
, ca_firstName varchar (100)
, ca_lastName varchar (100)
, ca_title varchar (100)
, ca_sdnType varchar (12)
, ca_remarks text
, constraint pk_tb_sdn PRIMARY KEY (ca_uid)
);
REVOKE ALL ON tb_sdn FROM PUBLIC;
GRANT ALL ON tb_sdn TO "Administrador";
GRANT ALL ON tb_sdn TO GROUP "Usuarios";

create table tb_sdnid
( ca_uid smallint NOT NULL
, ca_uid_id smallint NOT NULL
, ca_idType varchar (35)
, ca_idNumber varchar (25)
, ca_idCountry varchar (50)
, ca_issueDate varchar (12)
, ca_expirationDate varchar (12)
, constraint pk_tb_sdnid PRIMARY KEY (ca_uid, ca_uid_id)
, constraint fk_tb_sdnid FOREIGN KEY (ca_uid) REFERENCES tb_sdn (ca_uid)
);
REVOKE ALL ON tb_sdnid FROM PUBLIC;
GRANT ALL ON tb_sdnid TO "Administrador";
GRANT ALL ON tb_sdnid TO GROUP "Usuarios";

create table tb_sdnaka
( ca_uid smallint NOT NULL
, ca_uid_aka smallint NOT NULL
, ca_type varchar (12)
, ca_category varchar (25)
, ca_firstName varchar (100)
, ca_lastName varchar (100)
, constraint pk_tb_sdnaka PRIMARY KEY (ca_uid, ca_uid_aka)
, constraint fk_tb_sdnaka FOREIGN KEY (ca_uid) REFERENCES tb_sdn (ca_uid)
);
REVOKE ALL ON tb_sdnaka FROM PUBLIC;
GRANT ALL ON tb_sdnaka TO "Administrador";
GRANT ALL ON tb_sdnaka TO GROUP "Usuarios";

create table tb_sdnaddress
( ca_uid smallint NOT NULL
, ca_uid_address smallint NOT NULL
, ca_address1 varchar (100)
, ca_address2 varchar (100)
, ca_address3 varchar (100)
, ca_city varchar (25)
, ca_state varchar (50)
, ca_postal varchar (25)
, ca_country varchar (50)
, constraint pk_tb_sdnaddress PRIMARY KEY (ca_uid, ca_uid_address)
, constraint fk_tb_sdnaddress FOREIGN KEY (ca_uid) REFERENCES tb_sdn (ca_uid)
);
REVOKE ALL ON tb_sdnaddress FROM PUBLIC;
GRANT ALL ON tb_sdnaddress TO "Administrador";
GRANT ALL ON tb_sdnaddress TO GROUP "Usuarios";



/* Generador de Id para la tabla tb_colnovedades */;

create sequence tb_colnovedades_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_colnovedades_id FROM PUBLIC;
GRANT ALL ON tb_colnovedades_id TO "Administrador";
GRANT ALL ON tb_colnovedades_id TO GROUP "Usuarios";


/* Tabla de Novedades del Sistema Colsys */;

// Drop table tb_colnovedades cascade;
create table tb_colnovedades
( ca_idnovedad smallint DEFAULT nextval('tb_colnovedades_id') UNIQUE NOT NULL
, ca_fchpublicacion date NOT NULL
, ca_asunto varchar (50) NOT NULL
, ca_detalle text NOT NULL
, ca_fcharchivar date NOT NULL
, ca_extension varchar (4)
, ca_header_file varchar (255)
, ca_filesize varchar (8)
, ca_content bytea
, ca_fchpublicado timestamp NOT NULL
, ca_usupublicado varchar (20) NOT NULL
, constraint pk_tb_colnovedades PRIMARY KEY (ca_idnovedad)
);
REVOKE ALL ON tb_colnovedades FROM PUBLIC;
GRANT ALL ON tb_colnovedades TO "Administrador";
GRANT ALL ON tb_colnovedades TO GROUP "Usuarios";



-- Table: tb_dianmaestra
-- DROP TABLE tb_dianmaestra;
CREATE TABLE tb_dianmaestra
(
  ca_idinfodian integer NOT NULL DEFAULT nextval('tb_dianmaestra_id'::regclass),
  ca_referencia character varying(16) NOT NULL,
  ca_codconcepto character varying(1) NOT NULL,
  ca_fchtrans timestamp without time zone NOT NULL,
  ca_iddocactual character varying(20) NOT NULL,
  ca_iddocanterior character varying(20),
  ca_tipodocviaje character varying(2),
  ca_codadministracion character varying(2),
  ca_dispocarga character varying(2),
  ca_coddeposito character varying(4),
  ca_idtransportista numeric(9),
  ca_numenvio smallint,
  ca_fchenvio timestamp without time zone,
  ca_usuenvio character varying(20),
  ca_fchinicial date,
  ca_fchfinal date,
  ca_vlrtotal integer,
  ca_cantreg smallint,
  ca_iddoctrasbordo character varying(20),
  ca_idcondiciones smallint,
  ca_responsabilidad character varying(1),
  ca_tiponegociacion character varying(1),
  ca_tipocarga character varying(1),
  ca_precursores character varying(1),
  ca_fchcreado timestamp without time zone,
  ca_usucreado character varying(20),
  ca_fchactualizado timestamp without time zone,
  ca_usuactualizado character varying(20),
  CONSTRAINT pk_dianmaestra PRIMARY KEY (ca_idinfodian, ca_referencia),
  CONSTRAINT tb_dianmaestra_ca_idinfodian_key UNIQUE (ca_idinfodian)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_dianmaestra OWNER TO postgres;
GRANT ALL ON TABLE tb_dianmaestra TO postgres;
GRANT ALL ON TABLE tb_dianmaestra TO "Administrador";
GRANT ALL ON TABLE tb_dianmaestra TO "Usuarios";


-- Table: tb_dianclientes
-- DROP TABLE tb_dianclientes;
CREATE TABLE tb_dianclientes
(
  ca_idinfodian integer NOT NULL,
  ca_referencia character varying(16) NOT NULL,
  ca_idcliente numeric(11) NOT NULL,
  ca_house character varying(25) NOT NULL,
  ca_dispocarga character varying(2),
  ca_coddeposito character varying(4),
  ca_tipodocviaje character varying(2),
  ca_idcondiciones smallint,
  ca_responsabilidad character varying(1),
  ca_tiponegociacion character varying(1),
  ca_tipocarga character varying(1),
  ca_precursores character varying(1),
  ca_vlrfob integer,
  ca_vlrflete integer,
  ca_fchcreado timestamp without time zone,
  ca_usucreado character varying(20),
  ca_fchactualizado timestamp without time zone,
  ca_usuactualizado character varying(20),
  ca_iddocactual character varying(20),
  ca_iddocanterior character varying(20),
  CONSTRAINT pk_dianclientes PRIMARY KEY (ca_idinfodian, ca_referencia, ca_idcliente, ca_house)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_dianclientes OWNER TO postgres;
GRANT ALL ON TABLE tb_dianclientes TO postgres;
GRANT ALL ON TABLE tb_dianclientes TO "Administrador";
GRANT ALL ON TABLE tb_dianclientes TO "Usuarios";


-- Table: tb_diandepositos
-- DROP TABLE tb_diandepositos;
CREATE TABLE tb_diandepositos
(
  ca_codigo integer NOT NULL,
  ca_nombre character varying(250),
  ca_fchdesde date NOT NULL,
  ca_fchhasta date,
  ca_codadmin integer,
  ca_codtipo integer,
  CONSTRAINT pk_diandepositos PRIMARY KEY (ca_codigo, ca_fchdesde)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_diandepositos OWNER TO postgres;
GRANT ALL ON TABLE tb_diandepositos TO postgres;
GRANT ALL ON TABLE tb_diandepositos TO "Administrador";
GRANT ALL ON TABLE tb_diandepositos TO "Usuarios";


-- Table: tb_dianreservados
-- DROP TABLE tb_dianreservados;
CREATE TABLE tb_dianreservados
(
  ca_numero_resv character varying(20) NOT NULL,
  ca_anno smallint,
  ca_numenvio smallint,
  ca_fchreservado timestamp without time zone,
  ca_usureservado character varying(20),
  CONSTRAINT pk_dianreservados PRIMARY KEY (ca_numero_resv)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_dianreservados OWNER TO postgres;
GRANT ALL ON TABLE tb_dianreservados TO postgres;
GRANT ALL ON TABLE tb_dianreservados TO "Administrador";
GRANT ALL ON TABLE tb_dianreservados TO "Usuarios";



/* Generador de Id para la tabla tb_bavaria */;

drop sequence tb_bavaria_id;
create sequence tb_bavaria_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_bavaria_id FROM PUBLIC;
GRANT ALL ON tb_bavaria_id TO "Administrador";
GRANT ALL ON tb_bavaria_id TO GROUP "Usuarios";


-- Table: tb_bavaria
-- DROP TABLE tb_bavaria;
CREATE TABLE tb_bavaria
(
  ca_idbavaria smallint DEFAULT nextval('tb_bavaria_id') UNIQUE NOT NULL,
  ca_consecutivo varchar (10) NOT NULL,
  ca_orden_nro varchar (10) NOT NULL,
  ca_modalidad varchar (12) NOT NULL,
  ca_factura_nro varchar (15) NOT NULL,
  ca_factura_fch date,
  ca_zarpe_fch date,
  ca_doctransporte varchar (25),
  ca_doctransporte_fch date,
  ca_peso_bruto numeric(10,2),
  ca_peso_neto numeric(10,2),
  ca_tipo_embalaje varchar (2),
  ca_transportadora varchar (10),
  ca_bandera varchar (3),
  ca_reportado boolean,
  ca_fchreportado timestamp without time zone,
  ca_usureportado character varying(20),
  ca_fchanulado timestamp without time zone,
  ca_usuanulado character varying(20),
  ca_fchcreado timestamp without time zone,
  ca_usucreado character varying(20),
  ca_fchactualizado timestamp without time zone,
  ca_usuactualizado character varying(20),
  CONSTRAINT pk_bavaria PRIMARY KEY (ca_consecutivo, ca_orden_nro)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_bavaria OWNER TO postgres;
GRANT ALL ON TABLE tb_bavaria TO postgres;
GRANT ALL ON TABLE tb_bavaria TO "Administrador";
GRANT ALL ON TABLE tb_bavaria TO "Usuarios";



/* Vistas de la Base de Datos */

// Drop view vi_usuarios;
Create view vi_usuarios as
Select u.ca_login, u.ca_nombre, u.ca_cargo, u.ca_departamento, u.ca_sucursal, u.ca_email, u.ca_rutinas, u.ca_extension, s.ca_telefono, s.ca_fax, s.ca_direccion
       from control.tb_usuarios u, control.tb_sucursales s where u.ca_sucursal = s.ca_nombre
       order by u.ca_sucursal, u.ca_nombre;
REVOKE ALL ON vi_usuarios FROM PUBLIC;
GRANT ALL ON vi_usuarios TO "Administrador";
GRANT ALL ON vi_usuarios TO GROUP "Usuarios";


// Drop view vi_agentes;
Create view vi_agentes as
Select a.ca_idagente, a.ca_nombre, a.ca_direccion, a.ca_telefonos, a.ca_fax, a.ca_website, a.ca_email, a.ca_idciudad, c.ca_ciudad, a.ca_zipcode, a.ca_tipo, c.ca_idtrafico, a.ca_activo,
       t.ca_nombre as ca_nomtrafico from tb_agentes a, tb_ciudades c, tb_traficos t where a.ca_idciudad = c.ca_idciudad and c.ca_idtrafico = t.ca_idtrafico
       order by a.ca_nombre, ca_nomtrafico, ca_ciudad;
REVOKE ALL ON vi_agentes FROM PUBLIC;
GRANT ALL ON vi_agentes TO "Administrador";
GRANT ALL ON vi_agentes TO GROUP "Usuarios";


// Drop view vi_contactos;
Create view vi_contactos as
Select c.oid as ca_oid, a.ca_idagente, a.ca_nombre as ca_nomagente, c.ca_idcontacto, c.ca_nombre, c.ca_direccion, c.ca_telefonos, c.ca_fax, c.ca_email, c.ca_idciudad, c.ca_cargo, c.ca_detalle, d.ca_ciudad,
       d.ca_idtrafico as ca_idtrafico, t.ca_nombre as ca_nomtrafico, c.ca_impoexpo, c.ca_transporte, a.ca_activo, c.ca_activo as ca_activo_con from tb_contactos c, tb_agentes a, tb_ciudades d, tb_traficos t where c.ca_idagente = a.ca_idagente and c.ca_idciudad = d.ca_idciudad
       and d.ca_idtrafico = t.ca_idtrafico order by ca_nomagente, ca_nombre;
REVOKE ALL ON vi_contactos FROM PUBLIC;
GRANT ALL ON vi_contactos TO "Administrador";
GRANT ALL ON vi_contactos TO GROUP "Usuarios";


// Drop view vi_agentesxcont;
Create view vi_agentesxcont as
Select a.ca_idagente, a.ca_nombre as ca_nombre_ag, a.ca_direccion as ca_direccion_ag, a.ca_telefonos as ca_telefonos_ag, a.ca_fax as ca_fax_ag, a.ca_website, a.ca_email as ca_email_ag, a.ca_idciudad as ca_idciudad_ag, c1.ca_ciudad as ca_ciudad_ag, a.ca_zipcode, a.ca_tipo, c1.ca_idtrafico as ca_idtrafico_ag, t1.ca_nombre as ca_nomtrafico_ag,
       c.ca_idcontacto, c.ca_nombre as ca_nombre_co, c.ca_direccion as ca_direccion_co, c.ca_telefonos as ca_telefonos_co, c.ca_fax as ca_fax_co, c.ca_email as ca_email_co, c.ca_cargo, c.ca_detalle, c.ca_idciudad as ca_idciudad_co, c2.ca_ciudad as ca_ciudad_co, c2.ca_idtrafico as ca_idtrafico_co, t2.ca_nombre as ca_nomtrafico_co, c.ca_impoexpo, c.ca_transporte,
	   a.ca_activo, c.ca_activo as ca_activo_con 
       from tb_agentes a LEFT OUTER JOIN tb_contactos c ON (a.ca_idagente = c.ca_idagente)
       JOIN tb_ciudades c1 ON (a.ca_idciudad = c1.ca_idciudad)
       LEFT OUTER JOIN tb_ciudades c2 ON (c.ca_idciudad = c2.ca_idciudad)
       LEFT OUTER JOIN tb_traficos t1 ON (c1.ca_idtrafico = t1.ca_idtrafico)
       LEFT OUTER JOIN tb_traficos t2 ON (c2.ca_idtrafico = t2.ca_idtrafico)
       order by a.ca_nombre, ca_nomtrafico_co, ca_ciudad_co, c.ca_nombre;
REVOKE ALL ON vi_agentesxcont FROM PUBLIC;
GRANT ALL ON vi_agentesxcont TO "Administrador";
GRANT ALL ON vi_agentesxcont TO GROUP "Usuarios";


// Drop view vi_monedas;
Create view vi_monedas as
Select m.ca_idmoneda, m.ca_nombre, m.ca_referencia, r.ca_nombre as ca_nomreferencia
       from tb_monedas m , tb_monedas r where m.ca_referencia = r.ca_idmoneda order by m.ca_nombre;
REVOKE ALL ON vi_monedas FROM PUBLIC;
GRANT ALL ON vi_monedas TO "Administrador";
GRANT ALL ON vi_monedas TO GROUP "Usuarios";

// Drop view vi_traficos;
Create view vi_traficos as
Select t.ca_idtrafico, t.ca_nombre, t.ca_bandera, t.ca_idmoneda, t.ca_link, m.ca_nombre as ca_nommoneda, g.ca_descripcion
       from tb_traficos t, tb_monedas m, tb_grupos g where t.ca_idmoneda = m.ca_idmoneda and t.ca_idgrupo = g.ca_idgrupo and t.ca_idtrafico != '99-999' order by t.ca_nombre;
REVOKE ALL ON vi_traficos FROM PUBLIC;
GRANT ALL ON vi_traficos TO "Administrador";
GRANT ALL ON vi_traficos TO GROUP "Usuarios";


// Drop view vi_ciudades;
Create view  vi_ciudades as
Select c.ca_idciudad, c.ca_ciudad, c.ca_puerto, c.ca_idtrafico, t.ca_nombre, t.ca_bandera, g.ca_descripcion
       from tb_ciudades c, tb_traficos t, tb_grupos g where c.ca_idtrafico = t.ca_idtrafico and t.ca_idgrupo = g.ca_idgrupo and c.ca_idciudad != '999-9999' order by t.ca_nombre, c.ca_ciudad;
REVOKE ALL ON vi_ciudades FROM PUBLIC;
GRANT ALL ON vi_ciudades TO "Administrador";
GRANT ALL ON vi_ciudades TO GROUP "Usuarios";


// Drop view vi_transportistas;
Create view vi_transportistas as
Select tr.ca_idtransportista, tr.ca_digito, tr.ca_nombre as ca_nomtransportista, tr.ca_direccion, tr.ca_telefonos, tr.ca_fax, tr.ca_idciudad, c.ca_ciudad, t.ca_nombre as ca_trafico, tr.ca_website, tr.ca_email from tb_transportistas tr, tb_ciudades c, tb_traficos t
       where tr.ca_idciudad = c.ca_idciudad and c.ca_idtrafico = t.ca_idtrafico order by ca_nomtransportista;
REVOKE ALL ON vi_transportistas FROM PUBLIC;
GRANT ALL ON vi_transportistas TO "Administrador";
GRANT ALL ON vi_transportistas TO GROUP "Usuarios";


// Drop view vi_transporcontac;
Create view vi_transporcontac as
Select t.ca_idtransportista, t.ca_nombre as ca_nomtransportista, c.ca_idcontacto, c.ca_nombre, c.ca_telefonos, c.ca_fax, c.ca_email, ca_observaciones from tb_transporcontac c, tb_transportistas t where c.ca_idtransportista = t.ca_idtransportista
       order by ca_nomtransportista, ca_nombre;
REVOKE ALL ON vi_transporcontac FROM PUBLIC;
GRANT ALL ON vi_transporcontac TO "Administrador";
GRANT ALL ON vi_transporcontac TO GROUP "Usuarios";


// Drop view vi_transporlineas;
Create view vi_transporlineas as
Select t.ca_idtransportista, t.ca_nombre as ca_nomtransportista, c.ca_idlinea, c.ca_nombre, c.ca_sigla, c.ca_transporte from tb_transporlineas c, tb_transportistas t where c.ca_idtransportista = t.ca_idtransportista
       order by ca_nomtransportista, ca_nombre;
REVOKE ALL ON vi_transporlineas FROM PUBLIC;
GRANT ALL ON vi_transporlineas TO "Administrador";
GRANT ALL ON vi_transporlineas TO GROUP "Usuarios";


// Drop view vi_trayectos;
Create view vi_trayectos as
Select t.ca_idtrayecto, t.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_idtrafico as ca_idtraorigen, t1.ca_nombre as ca_traorigen, t1.ca_bandera as ca_banorigen, t1.ca_link as ca_linkorigen, t.ca_destino, c2.ca_ciudad as ca_ciudestino, t2.ca_idtrafico as ca_idtradestino, t2.ca_nombre as ca_tradestino, t2.ca_bandera as ca_bandestino, t2.ca_link as ca_linkdestino, t.ca_terminal, t.ca_idlinea, l.ca_nombre, l.ca_sigla, l.ca_idtransportista,
       r.ca_nombre as ca_nomtransportista, t.ca_transporte, t.ca_impoexpo, t.ca_frecuencia, t.ca_tiempotransito, t.ca_modalidad, t.ca_fchcreado, t.ca_idtarifas, s.ca_tarifas, t.ca_observaciones from tb_trayectos t, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas l, tb_transportistas r, vi_subtrayectos s where t.ca_origen = c1.ca_idciudad and t.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and
       c2.ca_idtrafico = t2.ca_idtrafico and t.ca_idlinea = l.ca_idlinea and l.ca_idtransportista = r.ca_idtransportista and t.ca_idtarifas = s.ca_idtrayecto order by ca_impoexpo, ca_transporte, ca_traorigen, ca_ciuorigen, ca_ciudestino;
REVOKE ALL ON vi_trayectos FROM PUBLIC;
GRANT ALL ON vi_trayectos TO "Administrador";
GRANT ALL ON vi_trayectos TO GROUP "Usuarios";


// Drop view vi_subtrayectos cascade;
Create view vi_subtrayectos as
Select t.ca_idtrayecto, c1.ca_ciudad||' / '||c2.ca_ciudad||' / '||l.ca_sigla as ca_tarifas from tb_trayectos t, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas l where t.ca_origen = c1.ca_idciudad and t.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and
       t.ca_idlinea = l.ca_idlinea and t.ca_idtrayecto = t.ca_idtrayecto order by ca_idtrayecto;
REVOKE ALL ON vi_subtrayectos FROM PUBLIC;
GRANT ALL ON vi_subtrayectos TO "Administrador";
GRANT ALL ON vi_subtrayectos TO GROUP "Usuarios";


// Drop view vi_conceptos;
Create view vi_conceptos as
select c.*, ((string_to_array(p.ca_valor,'|'))[1])::float as ca_volumen, ((string_to_array(p.ca_valor,'|'))[2])::float as ca_peso from tb_conceptos c LEFT OUTER JOIN tb_parametros p ON (p.ca_casouso = 'CU042' and c.ca_idconcepto = p.ca_identificacion) order by ca_transporte, ca_modalidad, ca_liminferior, ca_concepto desc;
REVOKE ALL ON vi_conceptos FROM PUBLIC;
GRANT ALL ON vi_conceptos TO "Administrador";
GRANT ALL ON vi_conceptos TO GROUP "Usuarios";


// Drop view vi_fletes;
Create view vi_fletes as
Select f.oid as ca_oid, f.ca_idtrayecto, f.ca_idconcepto, c.ca_concepto, c.ca_pregunta, c.ca_liminferior, f.ca_vlrneto, f.ca_vlrminimo, f.ca_vlrsenior, f.ca_vlrjunior, f.ca_fleteminimo, f.ca_idmoneda, m.ca_nombre, f.ca_observaciones, f.ca_sugerida, f.ca_mantenimiento, f.ca_fchinicio, f.ca_fchvencimiento, f.ca_fchcreado, f.ca_usucreado, f.ca_fchactualizado, f.ca_usuactualizado
       from tb_fletes f, tb_conceptos c, tb_monedas m where f.ca_idconcepto = c.ca_idconcepto and f.ca_idmoneda = m.ca_idmoneda order by f.ca_idtrayecto, ca_sugerida, ca_mantenimiento, c.ca_liminferior, ca_concepto desc;
REVOKE ALL ON vi_fletes FROM PUBLIC;
GRANT ALL ON vi_fletes TO "Administrador";
GRANT ALL ON vi_fletes TO GROUP "Usuarios";

// and f.ca_fchinicio = (select max(sub.ca_fchinicio) from tb_fletes sub where sub.ca_idtrayecto = f.ca_idtrayecto and sub.ca_idconcepto = f.ca_idconcepto group by sub.ca_idtrayecto, sub.ca_idconcepto, sub.ca_fchinicio);

// Consulta de Tarifas combinada con información del trayecto
// select * from vi_trayectos t, vi_fletes f where t.ca_idtrayecto = f.ca_idtrayecto and t.ca_transporte =  'Aéreo' and ca_impoexpo = 'Importación'


// Drop view vi_recargos;
Create view vi_recargos as
Select r.oid as ca_oid, r.ca_idtrayecto, r.ca_idconcepto, c.ca_concepto, r.ca_idrecargo, t.ca_recargo, t.ca_tipo, t.ca_transporte, t.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones,
       r.ca_aplicacion, r.ca_fchinicio, r.ca_fchvencimiento, r.ca_idmoneda, m.ca_nombre from tb_recargos r, tb_conceptos c, tb_tiporecargo t, tb_monedas m where r.ca_idconcepto = c.ca_idconcepto and r.ca_idrecargo = t.ca_idrecargo and r.ca_idmoneda = m.ca_idmoneda order by r.ca_idtrayecto, r.ca_idconcepto, r.ca_idrecargo;
REVOKE ALL ON vi_recargos FROM PUBLIC;
GRANT ALL ON vi_recargos TO "Administrador";
GRANT ALL ON vi_recargos TO GROUP "Usuarios";


// Drop view vi_tarifario;
Create view vi_tarifario as
select f.oid as ca_oid_f, f.ca_idtrayecto, f.ca_idconcepto, r.ca_idconcepto as ca_idaplicacion, c.ca_concepto, c.ca_modalidad, c.ca_pregunta, c.ca_liminferior, f.ca_vlrneto, f.ca_vlrminimo, f.ca_vlrsenior, f.ca_vlrjunior, f.ca_fleteminimo, f.ca_idmoneda as ca_idmoneda_f, f.ca_observaciones as ca_observaciones_f, f.ca_fchinicio as ca_fchinicio_f, f.ca_fchvencimiento as ca_fchvencimiento_f, f.ca_sugerida, f.ca_mantenimiento, f.ca_fchcreado as ca_fchcreado_f, f.ca_usucreado as ca_usucreado_f, f.ca_fchactualizado as ca_fchactualizado_f, f.ca_usuactualizado as ca_usuactualizado_f,
       r.ca_oid as ca_oid_r, r.ca_idrecargo, t.ca_recargo, t.ca_tipo, c.ca_transporte, t.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones as ca_observaciones_r, r.ca_aplicacion, r.ca_fchinicio as ca_fchinicio_r, r.ca_fchvencimiento as ca_fchvencimiento_r,
       r.ca_idmoneda as ca_idmoneda_r, ty.ca_frecuencia, ty.ca_tiempotransito, tl.ca_nombre
       from tb_fletes f 
	   LEFT OUTER JOIN tb_trayectos ty ON (f.ca_idtrayecto = ty.ca_idtrayecto)
	   LEFT OUTER JOIN tb_transporlineas tl ON  (f.ca_idlinea = tl.ca_idlinea)
	   LEFT OUTER JOIN (
			Select r.oid as ca_oid, t.ca_idtrayecto, r.ca_idconcepto, n.ca_concepto, r.ca_idrecargo, p.ca_recargo, p.ca_tipo, p.ca_transporte, p.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones, r.ca_aplicacion, r.ca_fchinicio, r.ca_fchvencimiento, r.ca_idmoneda, m.ca_nombre
				   from tb_trayectos t, tb_recargos r, tb_tiporecargo p, tb_conceptos n, tb_monedas m where t.ca_idtrayecto = r.ca_idtrayecto and r.ca_idrecargo = p.ca_idrecargo and r.ca_idconcepto = n.ca_idconcepto and r.ca_idmoneda = m.ca_idmoneda
			union all
			Select r.oid as ca_oid, t.ca_idtrayecto, '9999' as ca_idconcepto, n.ca_concepto, r.ca_idrecargo, p.ca_recargo, p.ca_tipo, p.ca_transporte, p.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones, r.ca_aplicacion, r.ca_fchinicio, r.ca_fchvencimiento, r.ca_idmoneda, m.ca_nombre
				   from tb_trayectos t, tb_ciudades c, tb_recargosxtraf r, tb_tiporecargo p, tb_conceptos n, tb_monedas m where t.ca_origen = c.ca_idciudad and t.ca_modalidad = r.ca_modalidad and t.ca_impoexpo = r.ca_impoexpo and r.ca_idrecargo = p.ca_idrecargo and n.ca_idconcepto = '9999' and t.ca_transporte = p.ca_transporte and (t.ca_origen = r.ca_idciudad or r.ca_idciudad = '999-9999') and c.ca_idtrafico = r.ca_idtrafico and r.ca_idmoneda = m.ca_idmoneda
			union all
			Select r.oid as ca_oid, t.ca_idtrayecto, '9999' as ca_idconcepto, n.ca_concepto, r.ca_idrecargo, p.ca_recargo, p.ca_tipo, p.ca_transporte, p.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones, r.ca_aplicacion, r.ca_fchinicio, r.ca_fchvencimiento, r.ca_idmoneda, m.ca_nombre
				   from tb_trayectos t, tb_ciudades c, tb_recargosxtraf r, tb_tiporecargo p, tb_conceptos n, tb_monedas m where t.ca_destino = c.ca_idciudad and t.ca_modalidad = r.ca_modalidad and t.ca_impoexpo = r.ca_impoexpo and r.ca_idrecargo = p.ca_idrecargo and n.ca_idconcepto = '9999' and t.ca_transporte = p.ca_transporte and (t.ca_destino = r.ca_idciudad or r.ca_idciudad = '999-9999') and c.ca_idtrafico = r.ca_idtrafico and r.ca_idmoneda = m.ca_idmoneda
	   ) r ON (f.ca_idtrayecto = r.ca_idtrayecto and (f.ca_idconcepto = r.ca_idconcepto or r.ca_idconcepto = '9999'))
	   LEFT OUTER JOIN tb_conceptos c ON (f.ca_idconcepto = c.ca_idconcepto)
       LEFT OUTER JOIN tb_tiporecargo t ON (r.ca_idrecargo = t.ca_idrecargo) order by f.ca_idtrayecto, c.ca_liminferior, ca_concepto, ca_recargo;
REVOKE ALL ON vi_tarifario FROM PUBLIC;
GRANT ALL ON vi_tarifario TO "Administrador";
GRANT ALL ON vi_tarifario TO GROUP "Usuarios";


// Drop view vi_recargosxtraf;
Create view vi_recargosxtraf as
Select r.oid as ca_oid, r.ca_idtrafico, f.ca_nombre as ca_trafico, f.ca_bandera, r.ca_idciudad, c.ca_ciudad, r.ca_modalidad, r.ca_impoexpo, r.ca_idrecargo, t.ca_recargo, t.ca_tipo, t.ca_transporte, t.ca_incoterms, r.ca_vlrfijo, r.ca_porcentaje, r.ca_baseporcentaje, r.ca_vlrunitario, r.ca_baseunitario, r.ca_recargominimo, r.ca_observaciones,
       r.ca_aplicacion, r.ca_fchinicio, r.ca_fchvencimiento, r.ca_idmoneda, m.ca_nombre from tb_recargosxtraf r, tb_traficos f, tb_ciudades c, tb_tiporecargo t, tb_monedas m where r.ca_idtrafico = f.ca_idtrafico and r.ca_idciudad = c.ca_idciudad and r.ca_idrecargo = t.ca_idrecargo and r.ca_idmoneda = m.ca_idmoneda
       order by ca_transporte, ca_trafico, ca_ciudad, ca_modalidad, ca_recargo;
REVOKE ALL ON vi_recargosxtraf FROM PUBLIC;
GRANT ALL ON vi_recargosxtraf TO "Administrador";
GRANT ALL ON vi_recargosxtraf TO GROUP "Usuarios";


// Drop view vi_tblgastos;
Create view vi_tblgastos as
Select g.ca_idtblgastos, g.ca_descripcion, g.ca_idtrafico, t.ca_nombre, g.ca_tipotarifa, g.ca_basetarifa, g.ca_incoterms, g.ca_condicion from tb_tblgastos g, tb_traficos t where g.ca_idtrafico = t.ca_idtrafico order by g.ca_descripcion;
REVOKE ALL ON vi_tblgastos FROM PUBLIC;
GRANT ALL ON vi_tblgastos TO "Administrador";
GRANT ALL ON vi_tblgastos TO GROUP "Usuarios";


// Drop view vi_columnas;
Create view vi_columnas as
Select c.ca_idtblgastos, g.ca_descripcion, c.ca_idcolumna, c.ca_columna, c.ca_mascara, c.ca_tipo, c.ca_longitud, c.ca_contenido from tb_tblgastos g, tb_columnas c where g.ca_idtblgastos = c.ca_idtblgastos order by c.ca_idtblgastos, c.ca_idcolumna;
REVOKE ALL ON vi_columnas FROM PUBLIC;
GRANT ALL ON vi_columnas TO "Administrador";
GRANT ALL ON vi_columnas TO GROUP "Usuarios";


// Drop view vi_planillas;
Create view vi_planillas as
Select p.ca_idtblgastos, g.ca_descripcion, g.ca_idtrafico, t.ca_nombre, g.ca_tipotarifa, g.ca_basetarifa, g.ca_condicion, p.ca_fchimportacion, p.ca_fchinicio, p.ca_fchvencimiento, p.ca_archivo, p.ca_usuario from tb_planillas p, tb_tblgastos g, tb_traficos t where p.ca_idtblgastos = g.ca_idtblgastos and g.ca_idtrafico = t.ca_idtrafico
       order by p.ca_idtblgastos asc, p.ca_fchimportacion desc;
REVOKE ALL ON vi_planillas FROM PUBLIC;
GRANT ALL ON vi_planillas TO "Administrador";
GRANT ALL ON vi_planillas TO GROUP "Usuarios";


// Drop view vi_liberaciones;
Create view vi_liberaciones as
Select l.ca_idliberacion, l.ca_idcliente, l.ca_cliente, l.ca_idciudad, c.ca_ciudad, l.ca_diascredito, l.ca_vendedor, l.ca_cupo, l.ca_fchcreado, l.ca_fchactualizado, l.ca_observaciones
       from tb_liberaciones l, tb_ciudades c where l.ca_idciudad = c.ca_idciudad order by c.ca_ciudad, l.ca_cliente;
REVOKE ALL ON vi_liberaciones FROM PUBLIC;
GRANT ALL ON vi_liberaciones TO "Administrador";
GRANT ALL ON vi_liberaciones TO GROUP "Usuarios";


// Drop view vi_clientes cascade;
Create view vi_clientes as
Select c.ca_idcliente, c.ca_digito, c.ca_compania, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_nombres ||' '|| c.ca_papellido ||' '|| c.ca_sapellido as ca_ncompleto, c.ca_saludo, c.ca_sexo, c.ca_cumpleanos, c.ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, c.ca_idciudad, cd.ca_ciudad, tr.ca_nombre as ca_pais, c.ca_website, c.ca_email, c.ca_actividad, c.ca_sectoreco, c.ca_vendedor, tu.ca_sucursal, c.ca_confirmar,
       c.ca_fchcircular, case when c.ca_tipo IS NOT NULL or length(c.ca_tipo) != 0 then 'Vigente'  else case when c.ca_fchcircular IS NULL then 'Sin'  else case when (c.ca_fchcircular+365<now()) then 'Vencido'  else 'Vigente' end end end as ca_stdcircular, c.ca_nvlriesgo, c.ca_fchcotratoag, case when c.ca_fchcotratoag IS NULL then 'Sin' else case when (c.ca_fchcotratoag+365<now()) then 'Vencido' else 'Vigente' end end as ca_stdcotratoag, c.ca_listaclinton, c.ca_leyinsolvencia, c.ca_comentario, c.ca_status, c.ca_tipo,
       c.ca_calificacion, c.ca_coordinador, u.ca_nombre as ca_nombre_coor, c.ca_preferencias, (select max(e.ca_fchvisita) from vi_enccliente e where c.ca_idcliente = e.ca_idcliente) as ca_fchvisita, c.ca_fchcreado, c.ca_usucreado, c.ca_fchactualizado, c.ca_usuactualizado, cl.ca_diascredito, cl.ca_cupo, cl.ca_observaciones, cm.ca_fchfirmado, cm.ca_fchvencimiento, case when cm.ca_fchfirmado IS NULL then 'Sin' else case when (cm.ca_fchvencimiento<now()) then 'Vencido' else 'Vigente' end end as ca_stdcarta_gtia,
       cl.ca_fchcreado as ca_fchcreado_lb, cl.ca_usucreado as ca_usucreado_lb, cl.ca_fchactualizado as ca_fchactualizado_lb, cl.ca_usuactualizado as ca_usuactualizado_lb,
       st1.ca_estado as ca_coltrans_std, st1.ca_fchestado as ca_coltrans_fch, st2.ca_estado as ca_colmas_std, st2.ca_fchestado as ca_colmas_fch
       from tb_clientes c
       LEFT OUTER JOIN (select * from tb_stdcliente where OID IN (select max(sc.OID) from tb_stdcliente sc where ca_empresa = 'Coltrans' group by ca_idcliente)) as st1 ON (c.ca_idcliente = st1.ca_idcliente)
       LEFT OUTER JOIN (select * from tb_stdcliente where OID IN (select max(sc.OID) from tb_stdcliente sc where ca_empresa = 'Colmas' group by ca_idcliente)) as st2 ON (c.ca_idcliente = st2.ca_idcliente)
       LEFT OUTER JOIN tb_libcliente cl ON (c.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_coordinador = u.ca_login)
       LEFT OUTER JOIN (select cf.ca_idcliente, cf.ca_fchfirmado, ca_fchvencimiento from (select ca_idcliente, max(ca_fchfirmado) as ca_fchfirmado from tb_comcliente group by ca_idcliente) as cf INNER JOIN (select ca_idcliente, ca_fchfirmado, ca_fchvencimiento from tb_comcliente) as cm ON (cf.ca_idcliente = cm.ca_idcliente and cf.ca_fchfirmado = cm.ca_fchfirmado)) as cm ON (c.ca_idcliente = cm.ca_idcliente)
       LEFT OUTER JOIN control.tb_usuarios tu ON (c.ca_vendedor = tu.ca_login)
       JOIN tb_ciudades cd ON (c.ca_idciudad = cd.ca_idciudad) JOIN tb_traficos tr ON (cd.ca_idtrafico = tr.ca_idtrafico) order by c.ca_compania, ca_ncompleto;
REVOKE ALL ON vi_clientes FROM PUBLIC;
GRANT ALL ON vi_clientes TO "Administrador";
GRANT ALL ON vi_clientes TO GROUP "Usuarios";


// Drop view vi_concliente cascade;
Create view vi_concliente as
Select cl.ca_idcliente, cl.ca_digito, cl.ca_compania, cl.ca_saludo as ca_saludo_cl, cl.ca_nombres ||' '|| cl.ca_papellido ||' '|| cl.ca_sapellido as ca_ncompleto_cl, cl.ca_direccion as ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_localidad, cl.ca_complemento, cl.ca_telefonos as ca_telefonos_cl, cl.ca_fax as ca_fax_cl, cl.ca_vendedor, cl.ca_idciudad, cd.ca_ciudad, cl.ca_preferencias, cl.ca_confirmar,
       cn.ca_idcontacto, cn.ca_papellido, cn.ca_sapellido, cn.ca_nombres, cn.ca_nombres ||' '|| cn.ca_papellido ||' '|| cn.ca_sapellido as ca_ncompleto_cn, cn.ca_saludo as ca_saludo_cn, cn.ca_cargo, cn.ca_departamento, cn.ca_telefonos, cn.ca_fax, cn.ca_cumpleanos, cn.ca_email, cn.ca_observaciones, cn.ca_fchcreado, cn.ca_usucreado, cn.ca_fchactualizado, cn.ca_usuactualizado, ca.ca_cupo, ca_diascredito
       from tb_clientes cl LEFT OUTER JOIN tb_concliente cn ON (cn.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN tb_libcliente ca ON (ca.ca_idcliente = cl.ca_idcliente) JOIN tb_ciudades cd ON (cl.ca_idciudad = cd.ca_idciudad)
       order by cl.ca_compania, ca_ncompleto_cn;
REVOKE ALL ON vi_concliente FROM PUBLIC;
GRANT ALL ON vi_concliente TO "Administrador";
GRANT ALL ON vi_concliente TO GROUP "Usuarios";


// Drop view vi_enccliente cascade;
Create view vi_enccliente as
Select cl.ca_idcliente, cl.ca_digito, cl.ca_compania, cl.ca_saludo as ca_saludo_cl, cl.ca_nombres ||' '|| cl.ca_papellido ||' '|| cl.ca_sapellido as ca_ncompleto_cl, cl.ca_direccion as ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_localidad, cl.ca_complemento, cl.ca_telefonos as ca_telefonos_cl, cl.ca_fax as ca_fax_cl, cl.ca_vendedor, u.ca_nombre as ca_vendedor_nom, cl.ca_idciudad, cd.ca_ciudad,
       en.ca_idencuesta, ca_fchvisita, en.ca_idcontacto, cn.ca_papellido, cn.ca_sapellido, cn.ca_nombres, cn.ca_nombres ||' '|| cn.ca_papellido ||' '|| cn.ca_sapellido as ca_ncompleto_cn, en.ca_instalaciones, en.ca_compartidas, en.ca_condiciones, en.ca_vivienda, en.ca_vigilancia, en.ca_alarma, en.ca_masseguridad, en.ca_detseguridad, en.ca_peracorde, en.ca_percarne, en.ca_perpresentado, en.ca_peruniformado,
       en.ca_mermovimiento, en.ca_merorganizado, en.ca_merexistencias, en.ca_mercontrol, en.ca_merinfraestructura, en.ca_mersupervision, en.ca_mercargue, en.ca_merseguridad, en.ca_recomendable, en.ca_legalidad, en.ca_peligro, en.ca_explicacion, en.ca_actividad, en.ca_estado, en.ca_traaereos, en.ca_tramaritimos, en.ca_fchcreado, en.ca_fchactualizado
       from tb_clientes cl 
	   LEFT OUTER JOIN tb_enccliente en ON (cl.ca_idcliente = en.ca_idcliente) 
	   LEFT OUTER JOIN tb_ciudades cd ON (cl.ca_idciudad = cd.ca_idciudad) 
	   LEFT OUTER JOIN tb_concliente cn ON (en.ca_idcontacto = cn.ca_idcontacto)
	   LEFT OUTER JOIN control.tb_usuarios u ON (cl.ca_vendedor = u.ca_login)
       order by cl.ca_compania, ca_idencuesta DESC;
REVOKE ALL ON vi_enccliente FROM PUBLIC;
GRANT ALL ON vi_enccliente TO "Administrador";
GRANT ALL ON vi_enccliente TO GROUP "Usuarios";


// Drop view vi_evecliente;
Create view vi_evecliente as
Select case when an.ca_idevento!=0 then an.ca_idevento else ev.ca_idevento end as ca_idevento_ant,
       case when an.ca_idevento!=0 then an.ca_asunto else ev.ca_asunto end as ca_asunto_ant,
       ev.ca_idevento, ev.ca_idcliente, ev.ca_fchevento, ev.ca_tipo, ev.ca_asunto, ev.ca_detalle, ev.ca_compromisos, ev.ca_fchcompromiso, ev.ca_idantecedente, ev.ca_usuario
       from tb_evecliente an RIGHT OUTER JOIN tb_evecliente ev ON (ev.ca_idantecedente = an.ca_idevento)
       order by ca_idevento_ant DESC, ca_idevento DESC;
REVOKE ALL ON vi_evecliente FROM PUBLIC;
GRANT ALL ON vi_evecliente TO "Administrador";
GRANT ALL ON vi_evecliente TO GROUP "Usuarios";


// Drop view vi_stdcliente;
Create view vi_stdcliente as
select c.ca_idcliente, case when ics_1.ca_cantidad_sea <> 0 then ics_1.ca_cantidad_sea else 0 end as ca_cantidad_sea, case when ics_2.ca_ultimos_sea <> 0 then ics_2.ca_ultimos_sea else 0 end as ca_ultimos_sea, case when ica_1.ca_cantidad_air <> 0 then ica_1.ca_cantidad_air else 0 end as ca_cantidad_air, case when ica_2.ca_ultimos_air <> 0 then ica_2.ca_ultimos_air else 0 end as ca_ultimos_air,
	case when ice_1.ca_cantidad_exp <> 0 then ice_1.ca_cantidad_exp else 0 end as ca_cantidad_exp, case when ice_2.ca_ultimos_exp <> 0 then ice_2.ca_ultimos_exp else 0 end as ca_ultimos_exp, case when icb_1.ca_cantidad_brk <> 0 then icb_1.ca_cantidad_brk else 0 end as ca_cantidad_brk, case when icb_2.ca_ultimos_brk <> 0 then icb_2.ca_ultimos_brk else 0 end as ca_ultimos_brk from tb_clientes c
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_cantidad_sea from tb_inoclientes_sea group by ca_idcliente) ics_1 ON (c.ca_idcliente = ics_1.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_ultimos_sea from tb_inoclientes_sea ic, tb_inomaestra_sea im where ic.ca_referencia = im.ca_referencia and im.ca_fchreferencia >= date(now()) group by ca_idcliente) ics_2 ON (c.ca_idcliente = ics_2.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_cantidad_air from tb_inoclientes_air group by ca_idcliente) ica_1 ON (c.ca_idcliente = ica_1.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_ultimos_air from tb_inoclientes_air ic, tb_inomaestra_air im where ic.ca_referencia = im.ca_referencia and im.ca_fchreferencia >= date(now()) group by ca_idcliente) ica_2 ON (c.ca_idcliente = ica_2.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_cantidad_exp from tb_expo_maestra group by ca_idcliente) ice_1 ON (c.ca_idcliente = ice_1.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_ultimos_exp from tb_expo_maestra where ca_fchreferencia >= (date(now())-365) group by ca_idcliente) ice_2 ON (c.ca_idcliente = ice_2.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_cantidad_brk from tb_brk_maestra group by ca_idcliente) icb_1 ON (c.ca_idcliente = icb_1.ca_idcliente)
	LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_ultimos_brk from tb_brk_maestra where ca_fchreferencia >= (date(now())-365) group by ca_idcliente) icb_2 ON (c.ca_idcliente = icb_2.ca_idcliente)
	order by ca_idcliente;
REVOKE ALL ON vi_stdcliente FROM PUBLIC;
GRANT ALL ON vi_stdcliente TO "Administrador";
GRANT ALL ON vi_stdcliente TO GROUP "Usuarios";


// Drop view vi_potenciales;
Create view vi_potenciales as
Select p.ca_idcliente, p.ca_compania, p.ca_ncompleto, p.ca_departamento, p.ca_ciudad, p.ca_direccion, p.ca_telefonos, p.ca_fax, p.ca_email from tb_potenciales p order by p.ca_compania;
REVOKE ALL ON vi_potenciales FROM PUBLIC;
GRANT ALL ON vi_potenciales TO "Administrador";
GRANT ALL ON vi_potenciales TO GROUP "Usuarios";


// Drop view vi_terceros cascade;
Create view vi_terceros as
Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_identificacion, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico
       from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto;
REVOKE ALL ON vi_terceros FROM PUBLIC;
GRANT ALL ON vi_terceros TO "Administrador";
GRANT ALL ON vi_terceros TO GROUP "Usuarios";


// DROP VIEW vi_reportes;

CREATE OR REPLACE VIEW vi_reportes AS
 SELECT r.ca_idreporte, r.ca_version, ( SELECT max(rr.ca_version) AS max
           FROM tb_reportes rr
          WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) AS ca_versiones, r.ca_fchreporte, r.ca_consecutivo, r.ca_idcotizacion, r.ca_origen, c1.ca_ciudad AS ca_ciuorigen, t1.ca_idtrafico AS ca_idtraorigen, t1.ca_nombre AS ca_traorigen, r.ca_destino, c2.ca_ciudad AS ca_ciudestino, t2.ca_idtrafico AS ca_idtradestino, t2.ca_nombre AS ca_tradestino, r.ca_impoexpo, r.ca_fchdespacho, r.ca_idagente, a.ca_nombre AS ca_agente, r.ca_incoterms, r.ca_mercancia_desc, r.ca_mcia_peligrosa, r.ca_idproveedor, r.ca_orden_prov, r.ca_idconcliente, r.ca_orden_clie, r.ca_confirmar_clie, r.ca_idconsignatario, r.ca_informar_cons, r.ca_idnotify, r.ca_informar_noti, r.ca_idmaster, r.ca_informar_mast, r.ca_notify, r.ca_idrepresentante, r.ca_informar_repr, r.ca_transporte, r.ca_modalidad, r.ca_colmas, r.ca_seguro, r.ca_liberacion, r.ca_tiempocredito, r.ca_preferencias_clie, r.ca_instrucciones, r.ca_idconsignar, b1.ca_nombre AS ca_consignar, r.ca_idbodega, b2.ca_nombre AS ca_bodega, b2.ca_tipo AS ca_tipobodega, r.ca_mastersame, r.ca_continuacion, r.ca_continuacion_dest, c3.ca_ciudad AS ca_final_dest, r.ca_continuacion_conf, r.ca_etapa_actual, r.ca_idlinea, r.ca_idetapa, r.ca_fchultstatus, r.ca_idtarea_rext, r.ca_idseguimiento, l.ca_nombre, r.ca_propiedades, r.ca_fchcreado, r.ca_usucreado, r.ca_fchactualizado, r.ca_usuactualizado, r.ca_fchanulado, r.ca_usuanulado, r.ca_detanulado, r.ca_fchcerrado, r.ca_usucerrado, tr1.ca_nombre AS ca_nombre_pro, tr1.ca_contacto AS ca_contacto_pro, tr1.ca_direccion AS ca_direccion_pro, tr1.ca_telefonos AS ca_telefonos_pro, tr1.ca_fax AS ca_fax_pro, tr1.ca_email AS ca_email_pro, tr2.ca_compania AS ca_nombre_cli, tr2.ca_idcliente, tr2.ca_digito, tr2.ca_ncompleto_cn AS ca_contacto_cli, tr2.ca_telefonos AS ca_telefonos_cli, tr2.ca_fax AS ca_fax_cli, tr2.ca_email AS ca_email_cli, ((((((replace(tr2.ca_direccion_cl::text, '|'::text, ' '::text) ||
        CASE
            WHEN tr2.ca_oficina::text <> ''::text THEN ' Of. '::text || tr2.ca_oficina::text
            ELSE ''::text
        END) ||
        CASE
            WHEN tr2.ca_torre::text <> ''::text THEN ' Torre '::text || tr2.ca_torre::text
            ELSE ''::text
        END) ||
        CASE
            WHEN tr2.ca_bloque::text <> ''::text THEN ' Bl. '::text || tr2.ca_bloque::text
            ELSE ''::text
        END) ||
        CASE
            WHEN tr2.ca_interior::text <> ''::text THEN ' Int. '::text || tr2.ca_interior::text
            ELSE ''::text
        END) ||
        CASE
            WHEN tr2.ca_complemento::text <> ''::text THEN ' '::text || tr2.ca_complemento::text
            ELSE ''::text
        END) || ' '::text) || tr2.ca_ciudad::text AS ca_direccion_cli, tr3.ca_nombre AS ca_nombre_rep, tr3.ca_contacto AS ca_contacto_rep, (tr3.ca_direccion::text || ' '::text) || tr3.ca_ciudad::text AS ca_direccion_rep, tr3.ca_telefonos AS ca_telefonos_rep, tr3.ca_fax AS ca_fax_rep, tr3.ca_email AS ca_email_rep, tr4.ca_nombre AS ca_nombre_con, tr4.ca_identificacion AS ca_identificacion_con, tr4.ca_contacto AS ca_contacto_con, (tr4.ca_direccion::text || ' '::text) || tr4.ca_ciudad::text AS ca_direccion_con, tr4.ca_telefonos AS ca_telefonos_con, tr4.ca_fax AS ca_fax_con, tr4.ca_email AS ca_email_con, tr5.ca_nombre AS ca_nombre_not, tr5.ca_contacto AS ca_contacto_not, (tr5.ca_direccion::text || ' '::text) || tr5.ca_ciudad::text AS ca_direccion_not, tr5.ca_telefonos AS ca_telefonos_not, tr5.ca_fax AS ca_fax_not, tr5.ca_email AS ca_email_not, tr6.ca_nombre AS ca_nombre_mas, tr6.ca_contacto AS ca_contacto_mas, (tr6.ca_direccion::text || ' '::text) || tr6.ca_ciudad::text AS ca_direccion_mas, tr6.ca_telefonos AS ca_telefonos_mas, tr6.ca_fax AS ca_fax_mas, tr6.ca_email AS ca_email_mas, s.ca_vlrasegurado, s.ca_idmoneda_vlr, s.ca_primaventa, s.ca_minimaventa, s.ca_idmoneda_vta, s.ca_obtencionpoliza, s.ca_idmoneda_pol, s.ca_seguro_conf, ra.ca_idrepaduana, ra.ca_coordinador, u2.ca_nombre AS ca_namecoordinador, u2.ca_email AS ca_aduana_conf, ra.ca_transnacarga, ra.ca_transnatipo, ra.ca_instrucciones AS ca_instrucciones_ad, r.ca_login, u.ca_nombre AS ca_vendedor, u.ca_sucursal
   FROM tb_reportes r
   LEFT JOIN vi_transporlineas l ON r.ca_idlinea = l.ca_idlinea
   LEFT JOIN tb_terceros tr1 ON tr1.ca_idtercero::text = array_to_string(string_to_array(r.ca_idproveedor::text, '|'::text), ','::text)
   LEFT JOIN (
	   SELECT cl.ca_compania, cl.ca_idcliente, cl.ca_digito, cn.ca_idcontacto, (((cn.ca_nombres::text || ' '::text) || cn.ca_papellido::text) || ' '::text) || cn.ca_sapellido::text AS ca_ncompleto_cn, cn.ca_telefonos, cn.ca_fax, cn.ca_email, cl.ca_direccion AS ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_complemento, cd.ca_ciudad
		   FROM tb_clientes cl
		   LEFT JOIN tb_concliente cn ON cn.ca_idcliente = cl.ca_idcliente
		   LEFT JOIN tb_libcliente ca ON ca.ca_idcliente = cl.ca_idcliente
		   JOIN tb_ciudades cd ON cl.ca_idciudad::text = cd.ca_idciudad::text
	   ) tr2 ON r.ca_idconcliente = tr2.ca_idcontacto
   LEFT JOIN (
	   SELECT t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre AS ca_nomtrafico
			FROM tb_terceros t, tb_ciudades cd, tb_traficos tr
			WHERE t.ca_idciudad::text = cd.ca_idciudad::text AND cd.ca_idtrafico::text = tr.ca_idtrafico::text
			ORDER BY t.ca_nombre, t.ca_contacto
		) tr3 ON r.ca_idrepresentante::smallint = tr3.ca_idtercero
   LEFT JOIN (
	   SELECT t.ca_idtercero, t.ca_nombre, t.ca_identificacion, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre AS ca_nomtrafico
			FROM tb_terceros t, tb_ciudades cd, tb_traficos tr
			WHERE t.ca_idciudad::text = cd.ca_idciudad::text AND cd.ca_idtrafico::text = tr.ca_idtrafico::text
			ORDER BY t.ca_nombre, t.ca_contacto
	  ) tr4 ON r.ca_idconsignatario::smallint = tr4.ca_idtercero
   LEFT JOIN (
		SELECT t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre AS ca_nomtrafico
			FROM tb_terceros t, tb_ciudades cd, tb_traficos tr
			WHERE t.ca_idciudad::text = cd.ca_idciudad::text AND cd.ca_idtrafico::text = tr.ca_idtrafico::text
			ORDER BY t.ca_nombre, t.ca_contacto
  ) tr5 ON r.ca_idnotify::smallint = tr5.ca_idtercero
   LEFT JOIN (
		SELECT t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre AS ca_nomtrafico
			FROM tb_terceros t, tb_ciudades cd, tb_traficos tr
			WHERE t.ca_idciudad::text = cd.ca_idciudad::text AND cd.ca_idtrafico::text = tr.ca_idtrafico::text
			ORDER BY t.ca_nombre, t.ca_contacto
  ) tr6 ON r.ca_idmaster::smallint = tr6.ca_idtercero
   LEFT JOIN tb_repseguro s ON r.ca_idreporte = s.ca_idreporte
   LEFT JOIN tb_repaduana ra ON r.ca_idreporte = ra.ca_idreporte
   LEFT JOIN control.tb_usuarios u2 ON ra.ca_coordinador::text = u2.ca_login::text

   INNER JOIN vi_agentes a ON r.ca_idagente = a.ca_idagente::numeric
   INNER JOIN tb_ciudades c1 ON r.ca_origen::text = c1.ca_idciudad::text
   INNER JOIN tb_ciudades c2 ON r.ca_destino::text = c2.ca_idciudad::text
   INNER JOIN tb_ciudades c3 ON r.ca_continuacion_dest::text = c3.ca_idciudad::text
   INNER JOIN tb_traficos t1 ON c1.ca_idtrafico::text = t1.ca_idtrafico::text
   INNER JOIN tb_traficos t2 ON c2.ca_idtrafico::text = t2.ca_idtrafico::text
   INNER JOIN tb_bodegas b1 ON r.ca_idconsignar = b1.ca_idbodega
   INNER JOIN tb_bodegas b2 ON r.ca_idbodega = b2.ca_idbodega
   INNER JOIN control.tb_usuarios u ON r.ca_login::text = u.ca_login::text

  WHERE  r.ca_usuanulado IS NULL

  ORDER BY date_part('year'::text, r.ca_fchreporte) DESC, to_number(substr(r.ca_consecutivo::text, 0, "position"(r.ca_consecutivo::text, '-'::text)), '99999999'::text) DESC, r.ca_version DESC;

ALTER TABLE vi_reportes OWNER TO postgres;
GRANT ALL ON TABLE vi_reportes TO postgres;
GRANT ALL ON TABLE vi_reportes TO "Administrador";
GRANT ALL ON TABLE vi_reportes TO "Usuarios";




// Drop view vi_repconsulta cascade;
CREATE OR REPLACE VIEW vi_repconsulta AS
 SELECT rp.ca_fchreporte, rp.ca_idreporte, rp.ca_consecutivo, cl.ca_compania AS ca_nombre_cli, tr.ca_nombre AS ca_nombre_pro, cd1.ca_ciudad AS ca_ciuorigen, cd2.ca_ciudad AS ca_ciudestino, rp.ca_transporte, rp.ca_mercancia_desc, rp.ca_modalidad, rp.ca_incoterms, rp.ca_login AS ca_vendedor, rp.ca_colmas, rp.ca_idetapa
   FROM tb_reportes rp
   LEFT JOIN tb_ciudades cd1 ON rp.ca_origen::text = cd1.ca_idciudad::text
   LEFT JOIN tb_ciudades cd2 ON rp.ca_destino::text = cd2.ca_idciudad::text
   LEFT JOIN tb_concliente cc ON rp.ca_idconcliente = cc.ca_idcontacto
   LEFT JOIN tb_clientes cl ON cc.ca_idcliente = cl.ca_idcliente
   LEFT JOIN tb_terceros tr ON rp.ca_idproveedor::integer = tr.ca_idtercero::integer
  WHERE rp.ca_modalidad::text = ''::text AND rp.ca_incoterms::text !~~ 'CIF%'::text AND rp.ca_incoterms::text !~~ 'CIP%'::text AND rp.ca_incoterms::text !~~ 'CPT%'::text AND rp.ca_incoterms::text !~~ 'CFR%'::text AND rp.ca_usuanulado IS NULL
  ORDER BY date_part('year'::text, rp.ca_fchreporte) DESC, to_number(substr(rp.ca_consecutivo::text, 0, "position"(rp.ca_consecutivo::text, '-'::text)), '99999999'::text) DESC, rp.ca_version DESC;

ALTER TABLE vi_repconsulta OWNER TO postgres;
GRANT ALL ON TABLE vi_repconsulta TO postgres;
GRANT ALL ON TABLE vi_repconsulta TO "Administrador";
GRANT ALL ON TABLE vi_repconsulta TO "Usuarios";



// Drop view vi_repultimo cascade;
Create view vi_repultimo as
select rpt.ca_consecutivo, rpt.ca_fchreporte, ruv.ca_version from tb_reportes rpt, 
	(select ca_consecutivo, min(ca_idreporte) as ca_idreporte from tb_reportes group by ca_consecutivo order by ca_idreporte) rpv,
	(select ca_consecutivo, max(ca_version) as ca_version from tb_reportes where ca_usuanulado is null group by ca_consecutivo) ruv
	where rpt.ca_idreporte = rpv.ca_idreporte and rpt.ca_consecutivo = ruv.ca_consecutivo
	order by rpt.ca_consecutivo;
REVOKE ALL ON vi_repultimo FROM PUBLIC;
GRANT ALL ON vi_repultimo TO "Administrador";
GRANT ALL ON vi_repultimo TO GROUP "Usuarios";


Drop view vi_reptarifas;
Create view vi_reptarifas as
select r.oid as ca_oid, r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_cantidad, r.ca_neta_tar, r.ca_neta_min, r.ca_neta_idm, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm, r.ca_observaciones
       from tb_reptarifas r
       LEFT OUTER JOIN tb_conceptos c ON (r.ca_idconcepto = c.ca_idconcepto)
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_reptarifas FROM PUBLIC;
GRANT ALL ON vi_reptarifas TO "Administrador";
GRANT ALL ON vi_reptarifas TO GROUP "Usuarios";


Drop view vi_repgastos;
Create view vi_repgastos as
select r.oid as ca_oid, r.ca_idreporte, r.ca_idrecargo, g.ca_recargo, g.ca_tipo as ca_tiporecargo, r.ca_aplicacion, r.ca_tipo, r.ca_neta_tar, r.ca_neta_min, r.ca_reportar_tar, r.ca_reportar_min, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_idmoneda, r.ca_detalles, r.ca_idconcepto, c.ca_concepto
       from tb_repgastos r LEFT OUTER JOIN tb_conceptos c ON (r.ca_idconcepto = c.ca_idconcepto), tb_tiporecargo g where r.ca_idrecargo = g.ca_idrecargo
       order by r.ca_idreporte, g.ca_recargo, c.ca_liminferior;
REVOKE ALL ON vi_repgastos FROM PUBLIC;
GRANT ALL ON vi_repgastos TO "Administrador";
GRANT ALL ON vi_repgastos TO GROUP "Usuarios";

-- c.ca_concepto, 

Drop view vi_repstatus;
Create view vi_repstatus as
select r.ca_idreporte, r.ca_idemail, r.ca_fchstatus, r.ca_status, r.ca_comentarios, r.ca_etapa, r.ca_fchrecibo, r.ca_fchenvio, r.ca_usuenvio, e.ca_tipo, e.ca_idcaso, e.ca_from, e.ca_fromname, e.ca_cc, e.ca_replyto, e.ca_address, e.ca_attachment, e.ca_subject, e.ca_body
       from tb_repstatus r, tb_emails e where r.ca_idemail = e.ca_idemail and e.ca_tipo = 'Envío de Status'
       order by r.ca_idreporte, r.ca_idemail DESC;
REVOKE ALL ON vi_repstatus FROM PUBLIC;
GRANT ALL ON vi_repstatus TO "Administrador";
GRANT ALL ON vi_repstatus TO GROUP "Usuarios";


Drop view vi_repavisos;
Create view vi_repavisos as
select r.ca_idreporte, r.ca_idemail, r.ca_introduccion, r.ca_fchsalida, r.ca_fchllegada, r.ca_fchcontinuacion, r.ca_piezas, r.ca_peso, r.ca_volumen, r.ca_doctransporte, r.ca_docmaster, r.ca_idnave, r.ca_notas, r.ca_equipos, r.ca_etapa, r.ca_fchenvio, r.ca_usuenvio, e.ca_tipo, e.ca_idcaso, e.ca_from, e.ca_fromname, e.ca_cc, e.ca_replyto, e.ca_address, e.ca_attachment, e.ca_subject, e.ca_body
       from tb_repavisos r, tb_emails e where r.ca_idemail = e.ca_idemail and e.ca_tipo in ('Envío de Avisos','Confirmación')
       order by r.ca_idreporte, r.ca_idemail DESC;
REVOKE ALL ON vi_repavisos FROM PUBLIC;
GRANT ALL ON vi_repavisos TO "Administrador";
GRANT ALL ON vi_repavisos TO GROUP "Usuarios";


Drop view vi_repreportes;
Create view vi_repreportes as
select rp.ca_idreporte, substr(rp.ca_fchreporte::text,1,4) as ca_ano, substr(rp.ca_fchreporte::text,6,2) as ca_mes, rp.ca_fchreporte, rp.ca_consecutivo, rp.ca_version, cl.ca_idcliente, cl.ca_compania as ca_nombre_cli, replace(rp.ca_orden_clie,'|',', ') as ca_orden_clie, t1.ca_nombre as ca_traorigen, c1.ca_ciudad as ca_ciuorigen, t2.ca_nombre as ca_tradestino, c2.ca_ciudad as ca_ciudestino,
    rp.ca_impoexpo, rp.ca_modalidad, rp.ca_transporte, rp.ca_login, us.ca_sucursal
    from tb_reportes rp
	INNER JOIN tb_concliente cc ON rp.ca_idconcliente = cc.ca_idcontacto
	INNER JOIN tb_clientes cl ON cc.ca_idcliente = cl.ca_idcliente
	INNER JOIN tb_ciudades c1 ON rp.ca_origen::text = c1.ca_idciudad::text
	INNER JOIN tb_ciudades c2 ON rp.ca_destino::text = c2.ca_idciudad::text
	INNER JOIN tb_traficos t1 ON c1.ca_idtrafico::text = t1.ca_idtrafico::text
	INNER JOIN tb_traficos t2 ON c2.ca_idtrafico::text = t2.ca_idtrafico::text
	INNER JOIN vi_usuarios us ON rp.ca_login = us.ca_login
	INNER JOIN (select ca_consecutivo as ca_consecutivo_f, max(ca_version) as ca_version from tb_reportes where ca_usuanulado IS NULL and substr(ca_fchreporte::text,6,2) like '02' and substr(ca_fchreporte::text,1,4) = '2010'  group by ca_consecutivo_f) rx ON rp.ca_consecutivo = rx.ca_consecutivo_f and rp.ca_version = rx.ca_version
where rp.ca_usuanulado IS NULL and rp.ca_fchanulado IS NULL
order by us.ca_sucursal, rp.ca_login, rp.ca_transporte;
REVOKE ALL ON vi_repreportes FROM PUBLIC;
GRANT ALL ON vi_repreportes TO "Administrador";
GRANT ALL ON vi_repreportes TO GROUP "Usuarios";



/* Versión Original de Query */
// Drop view vi_inomaestra_sea cascade;
Create view vi_inomaestra_sea as
Select (CASE WHEN (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND i.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(i.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(i.ca_referencia::text, '.'::text))[3] AS ca_mes, (string_to_array(i.ca_referencia::text, '.'::text))[2] as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_fchvaciado, i.ca_horavaciado, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_fchconfirmado, i.ca_usuconfirmado, i.ca_asunto_otm, i.ca_mensaje_otm, i.ca_fchllegada_otm, i.ca_ciudad_otm , i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado, i.ca_provisional,
       (select sum(ie.ca_peso) from vi_inoequipos_sea ie where i.ca_referencia = ie.ca_referencia) as ca_peso_cap,
       (select sum(ie.ca_volumen) from vi_inoequipos_sea ie where i.ca_referencia = ie.ca_referencia) as ca_volumen_cap,
       (select sum(ic.ca_numpiezas) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_numpiezas,
       (select sum(ic.ca_peso) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_peso,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen,
       (select sum(round((case when ic.ca_neto IS NOT NULL then ic.ca_neto else 0 end)::numeric*ic.ca_tcambio::numeric,0)) from tb_inocostos_sea ic where i.ca_referencia = ic.ca_referencia) as ca_costoneto,
       (select sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric-sum(round((case when ic.ca_neto IS NOT NULL then ic.ca_neto else 0 end)::numeric*ic.ca_tcambio::numeric,0)) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No') as ca_comisionable,
       (select sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric-sum(round((case when ic.ca_neto IS NOT NULL then ic.ca_neto else 0 end)::numeric*ic.ca_tcambio::numeric,0)) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable = 'No') as ca_nocomisionable,
       (case when EXISTS(select ca_referencia from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) then (select sum(case when ii.ca_valor IS NOT NULL then ii.ca_valor else 0 end)::numeric from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) else 0 end) as ca_facturacion,
       (case when EXISTS(select ca_referencia from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) then (select sum(case when d.ca_valor IS NOT NULL then d.ca_valor else 0 end)::numeric from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) else 0 end) as ca_deduccion,
       (case when EXISTS(select ca_referencia from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') then (select sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') else 0 end) as ca_utilidad,
       (case when i.ca_provisional then 'Provisional' else (case when i.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inomaestra_sea FROM PUBLIC;
GRANT ALL ON vi_inomaestra_sea TO "Administrador";
GRANT ALL ON vi_inomaestra_sea TO GROUP "Usuarios";



/* Nueva Vista pero tiene problemas de Rendimiento */
// Drop view vi_inomaestra_sea cascade;
Create view vi_inomaestra_sea as
Select (CASE WHEN (string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND bkm.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_fchvaciado, i.ca_horavaciado, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_fchconfirmado, i.ca_usuconfirmado, i.ca_asunto_otm, i.ca_mensaje_otm, i.ca_fchllegada_otm, i.ca_ciudad_otm , i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado, i.ca_provisional,
       ie.ca_peso_cap, ie.ca_volumen_cap, ic.ca_numpiezas, ic.ca_peso, ic.ca_volumen, ics.ca_costoneto, sicom.ca_comisionable, nocom.ca_nocomisionable, fc.ca_facturacion, dd.ca_deduccion, ut.ca_utilidad,
       (case when i.ca_provisional then 'Provisional' else (case when i.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea i
           LEFT JOIN (select ca_referencia, sum(ca_peso) as ca_peso_cap, sum(ca_volumen) as ca_volumen_cap from vi_inoequipos_sea ie group by ca_referencia) ie ON (ie.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ca_referencia, sum(ca_numpiezas) as ca_numpiezas, sum(ca_peso) as ca_peso, sum(ca_volumen) as ca_volumen from tb_inoclientes_sea group by ca_referencia) ic ON (ic.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ca_referencia, sum(round((case when ca_neto IS NOT NULL then ca_neto else 0 end)::numeric*ca_tcambio::numeric,0)) as ca_costoneto from tb_inocostos_sea group by ca_referencia) ics ON (ics.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ic.ca_referencia, sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric-sum(round((case when ic.ca_neto IS NOT NULL then ic.ca_neto else 0 end)::numeric*ic.ca_tcambio::numeric,0)) as ca_comisionable from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and c.ca_comisionable != 'No' group by ic.ca_referencia) sicom ON (sicom.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ic.ca_referencia, sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric-sum(round((case when ic.ca_neto IS NOT NULL then ic.ca_neto else 0 end)::numeric*ic.ca_tcambio::numeric,0)) as ca_nocomisionable from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and c.ca_comisionable = 'No' group by ic.ca_referencia) nocom ON (nocom.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ca_referencia, sum(case when ca_valor IS NOT NULL then ca_valor else 0 end)::numeric as ca_facturacion from tb_inoingresos_sea group by ca_referencia) fc ON (fc.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ca_referencia, sum(case when ca_valor IS NOT NULL then ca_valor else 0 end)::numeric as ca_deduccion from tb_inodeduccion_sea group by ca_referencia) dd ON (dd.ca_referencia = i.ca_referencia)
           LEFT JOIN (select ca_referencia, sum(case when ic.ca_venta IS NOT NULL then ic.ca_venta else 0 end)::numeric as ca_utilidad from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and c.ca_comisionable != 'No' and ic.ca_login = ''  group by ic.ca_referencia) ut ON (ut.ca_referencia = i.ca_referencia)
           INNER JOIN tb_ciudades c1 ON i.ca_origen = c1.ca_idciudad
           INNER JOIN tb_ciudades c2 ON i.ca_destino = c2.ca_idciudad
           INNER JOIN tb_traficos t1 ON c1.ca_idtrafico = t1.ca_idtrafico
           INNER JOIN tb_traficos t2 ON c2.ca_idtrafico = t2.ca_idtrafico
           INNER JOIN vi_transporlineas t ON i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inomaestra_sea FROM PUBLIC;
GRANT ALL ON vi_inomaestra_sea TO "Administrador";
GRANT ALL ON vi_inomaestra_sea TO GROUP "Usuarios";



// Drop view vi_inocontenedores_sea cascade;
Create view vi_inocontenedores_sea as
Select (CASE WHEN (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND i.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(i.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(i.ca_referencia::text, '.'::text))[3] AS ca_mes, (string_to_array(i.ca_referencia::text, '.'::text))[2] AS ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_fchconfirmado, i.ca_usuconfirmado, i.ca_asunto_otm, i.ca_mensaje_otm, i.ca_fchllegada_otm, i.ca_ciudad_otm, i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado, i.ca_provisional,
       (select sum(ic.ca_numpiezas) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_numpiezas,
       (select sum(ic.ca_peso) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_peso,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen,
       (select sum(ic.ca_neto::numeric*ic.ca_tcambio::numeric) from tb_inocostos_sea ic where i.ca_referencia = ic.ca_referencia) as ca_costoneto,
       (select sum(ic.ca_venta::float)-sum(ic.ca_neto::numeric*ic.ca_tcambio::numeric) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No') as ca_comisionable,
       (select sum(ic.ca_venta::float)-sum(ic.ca_neto::numeric*ic.ca_tcambio::numeric) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable = 'No') as ca_nocomisionable,
       (select sum(ii.ca_valor::float) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion,
       (select sum(d.ca_valor::float) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion,
       (select sum(ic.ca_venta::float) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad,
       (case when i.ca_provisional then 'Provisional' else (case when i.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inocontenedores_sea FROM PUBLIC;
GRANT ALL ON vi_inocontenedores_sea TO "Administrador";
GRANT ALL ON vi_inocontenedores_sea TO GROUP "Usuarios";



Drop view vi_inoequipos_sea cascade;
Create view vi_inoequipos_sea as
Select e.oid as ca_oid, e.ca_referencia, e.ca_idconcepto, c.ca_concepto, c.ca_liminferior, (c.ca_volumen * e.ca_cantidad) as ca_volumen, (c.ca_peso * e.ca_cantidad) as ca_peso, e.ca_cantidad, e.ca_idequipo, e.ca_observaciones, e.ca_fchcreado, e.ca_usucreado, e.ca_fchactualizado, e.ca_usuactualizado,
       t.ca_idcontrato, t.ca_fchcontrato, t.ca_inspeccion_nta, t.ca_inspeccion_fch, t.ca_observaciones as ca_observaciones_con, i.ca_sitiodevolucion
       from tb_inoequipos_sea e LEFT OUTER JOIN tb_inocontratos_sea t ON (e.ca_referencia = t.ca_referencia and e.ca_idequipo = t.ca_idequipo), tb_inomaestra_sea i, vi_conceptos c where e.ca_referencia = i.ca_referencia and e.ca_idconcepto = c.ca_idconcepto order by c.ca_concepto;
REVOKE ALL ON vi_inoequipos_sea FROM PUBLIC;
GRANT ALL ON vi_inoequipos_sea TO "Administrador";
GRANT ALL ON vi_inoequipos_sea TO GROUP "Usuarios";


Drop view vi_inoclientes_sea cascade;
Create view vi_inoclientes_sea as
Select i.oid as ca_oid, (CASE WHEN (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND im.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(i.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(i.ca_referencia::text, '.'::text))[3] AS ca_mes, i.ca_referencia, i.ca_idcliente, c.ca_compania, i.ca_idreporte, r.ca_consecutivo, i.ca_hbls, i.ca_idproveedor, i.ca_proveedor, i.ca_numpiezas, i.ca_peso, i.ca_volumen, i.ca_numorden, i.ca_confirmar, i.ca_mensaje, i.ca_login, i.ca_continuacion, i.ca_continuacion_dest, cu.ca_ciudad as ca_ciudad_dest, i.ca_idbodega, b.ca_nombre as ca_bodega, u.ca_sucursal, i.ca_observaciones, i.ca_contenedores, i.ca_fchliberacion, i.ca_notaliberacion,
       i.ca_fchcreado as ca_fchcreado_cl, i.ca_usucreado as ca_usucreado_cl, i.ca_fchactualizado as ca_fchactualizado_cl, i.ca_usuactualizado as ca_usuactualizado_cl, i.ca_usuliberado, i.ca_fchliberado, f.oid as ca_oid_fc, f.ca_factura, f.ca_fchfactura, f.ca_neto, f.ca_idmoneda, f.ca_valor, f.ca_reccaja, f.ca_fchpago, f.ca_tcambio, f.ca_observaciones as ca_observaciones_fact,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where f.ca_referencia = d.ca_referencia and f.ca_idcliente = d.ca_idcliente and f.ca_hbls = d.ca_hbls and f.ca_factura = d.ca_factura) as ca_deduccion,
       (select count(cl.ca_hbls) from tb_inoclientes_sea cl where cl.ca_referencia = i.ca_referencia) as ca_nrohbls,
       f.ca_fchcreado as ca_fchcreado_fc, f.ca_usucreado as ca_usucreado_fc, f.ca_fchactualizado as ca_fchactualizado_fc, f.ca_usuactualizado as ca_usuactualizado_fc,
       (select max(ca_fchvencimiento) as ca_fchvencimiento from tb_comcliente where i.ca_idcliente = ca_idcliente group by ca_idcliente) as ca_fchvencimiento
       from tb_inoclientes_sea i LEFT OUTER JOIN tb_inomaestra_sea im ON (i.ca_referencia = im.ca_referencia) LEFT OUTER JOIN tb_inoingresos_sea f ON (i.ca_referencia = f.ca_referencia and i.ca_idcliente = f.ca_idcliente and i.ca_hbls = f.ca_hbls) LEFT OUTER JOIN tb_clientes c ON (i.ca_idcliente = c.ca_idcliente) LEFT OUTER JOIN tb_ciudades cu ON (i.ca_continuacion_dest = cu.ca_idciudad) LEFT OUTER JOIN tb_bodegas b ON (i.ca_idbodega = b.ca_idbodega) LEFT OUTER JOIN tb_reportes r ON (i.ca_idreporte = r.ca_idreporte) LEFT OUTER JOIN control.tb_usuarios u ON (i.ca_login = u.ca_login)
       order by i.ca_referencia, c.ca_compania, i.ca_hbls, f.ca_factura;
REVOKE ALL ON vi_inoclientes_sea FROM PUBLIC;
GRANT ALL ON vi_inoclientes_sea TO "Administrador";
GRANT ALL ON vi_inoclientes_sea TO GROUP "Usuarios";


// Drop view vi_inoconsulta_sea;
Create view vi_inoconsulta_sea as
Select (CASE WHEN (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND im.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(im.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(im.ca_referencia::text, '.'::text))[3] AS ca_mes, (string_to_array(im.ca_referencia::text, '.'::text))[2] AS ca_trafico, substr(im.ca_referencia,1,3) as ca_modal, im.ca_referencia, im.ca_mbls, im.ca_motonave, im.ca_observaciones, t.ca_nombre, t.ca_sigla, ie.ca_idequipo, im.ca_origen, c1.ca_ciudad as ca_ciuorigen,
	   t1.ca_nombre as ca_traorigen, im.ca_destino, c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, im.ca_fchembarque, im.ca_fcharribo, ic.ca_hbls, ic.ca_idcliente, c.ca_compania, rp.ca_consecutivo, ii.ca_factura, it.ca_factura as ca_factura_prov, us.ca_sucursal, dm.ca_iddocactual, dm.ca_fchenvio, dm.ca_usuenvio,
	   (case when im.ca_provisional then 'Provisional' else (case when im.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea im
       LEFT JOIN tb_ciudades c1 ON (im.ca_origen = c1.ca_idciudad)
       LEFT JOIN tb_ciudades c2 ON (im.ca_destino = c2.ca_idciudad)
       LEFT JOIN tb_traficos t1 ON (c1.ca_idtrafico = t1.ca_idtrafico)
       LEFT JOIN tb_traficos t2 ON (c2.ca_idtrafico = t2.ca_idtrafico)
       LEFT JOIN vi_transporlineas t ON (im.ca_idlinea = t.ca_idlinea)
       LEFT JOIN tb_inoequipos_sea ie ON (im.ca_referencia = ie.ca_referencia)
       LEFT JOIN tb_inoclientes_sea ic ON (im.ca_referencia = ic.ca_referencia)
       LEFT JOIN tb_clientes c ON (ic.ca_idcliente = c.ca_idcliente)
       LEFT JOIN tb_reportes rp ON (ic.ca_idreporte = rp.ca_idreporte)
       LEFT JOIN tb_inoingresos_sea ii ON (im.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls)
       LEFT JOIN tb_inocostos_sea it ON (im.ca_referencia = it.ca_referencia)
       LEFT JOIN tb_dianmaestra dm ON im.ca_referencia::text = dm.ca_referencia::text
       LEFT OUTER JOIN control.tb_usuarios us ON (im.ca_usucreado = us.ca_login);
REVOKE ALL ON vi_inoconsulta_sea FROM PUBLIC;
GRANT ALL ON vi_inoconsulta_sea TO "Administrador";
GRANT ALL ON vi_inoconsulta_sea TO GROUP "Usuarios";


Drop view vi_inocostos_sea;
Create view vi_inocostos_sea as
Select i.oid as ca_oid, i.ca_referencia, i.ca_idcosto, c.ca_costo, i.ca_factura, i.ca_fchfactura, i.ca_proveedor, i.ca_idmoneda, m.ca_nombre as ca_moneda, i.ca_tcambio, i.ca_neto, i.ca_venta, i.ca_login, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado,
       (select sum(u.ca_valor) from tb_inoutilidad_sea u where i.ca_referencia = u.ca_referencia and i.ca_idcosto = u.ca_idcosto and i.ca_factura = u.ca_factura) as ca_utilidad
       from tb_inocostos_sea i, tb_costos c, tb_monedas m where i.ca_idcosto = c.ca_idcosto and i.ca_idmoneda = m.ca_idmoneda
       order by i.ca_referencia, i.ca_fchcreado;
REVOKE ALL ON vi_inocostos_sea FROM PUBLIC;
GRANT ALL ON vi_inocostos_sea TO "Administrador";
GRANT ALL ON vi_inocostos_sea TO GROUP "Usuarios";


-- Drop view vi_inocomisiones_sea;
Create view vi_inocomisiones_sea as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_modal, i.ca_traorigen, i.ca_ciuorigen, i.ca_ciudestino, i.ca_modalidad, i.ca_referencia, c.ca_login, l.ca_sucursal, c.ca_idcliente, cl.ca_compania, c.ca_hbls, c.ca_volumen, (case when i.ca_facturacion IS NOT NULL then i.ca_facturacion else 0 end)::numeric AS ca_facturacion_r, (case when i.ca_deduccion IS NOT NULL then i.ca_deduccion else 0 end)::numeric AS ca_deduccion_r, (case when i.ca_utilidad IS NOT NULL then i.ca_utilidad else 0 end)::numeric AS ca_utilidad_r, i.ca_volumen AS ca_volumen_r,
       u.ca_idcosto AS ca_idcosto_ded, s.ca_costo AS ca_costo_ded, u.ca_factura AS ca_factura_ded, u.ca_valor AS ca_valor_ded, i.ca_estado, (select fun_getcomision(c.ca_idcliente, i.ca_referencia, 'Coltrans')) as ca_porcentaje,
       (select sum(case when n.ca_valor IS NOT NULL then n.ca_valor else 0 end)::numeric from tb_inoingresos_sea n where c.ca_referencia = n.ca_referencia AND c.ca_idcliente = n.ca_idcliente AND c.ca_hbls = n.ca_hbls) as ca_valor,
       (select sum(case when s.ca_vlrcomision IS NOT NULL then s.ca_vlrcomision else 0 end)::numeric from tb_inocomisiones_sea s where s.ca_referencia = c.ca_referencia AND s.ca_idcliente = c.ca_idcliente AND s.ca_hbls = c.ca_hbls) as ca_vlrcomisiones,
       (select sum(case when s.ca_sbrcomision IS NOT NULL then s.ca_sbrcomision else 0 end)::numeric from tb_inocomisiones_sea s where s.ca_referencia = c.ca_referencia AND s.ca_idcliente = c.ca_idcliente AND s.ca_hbls = c.ca_hbls) as ca_sbrcomisiones
   FROM vi_inocontenedores_sea i
   LEFT JOIN tb_inoclientes_sea c ON (i.ca_referencia = c.ca_referencia)
   LEFT JOIN tb_inoutilidad_sea u ON (u.ca_referencia = c.ca_referencia AND u.ca_idcliente = c.ca_idcliente AND u.ca_hbls = c.ca_hbls)
   LEFT JOIN tb_costos s ON u.ca_idcosto = s.ca_idcosto
   LEFT JOIN tb_clientes cl ON cl.ca_idcliente = c.ca_idcliente
   LEFT JOIN control.tb_usuarios l ON c.ca_login = l.ca_login
   ORDER BY ca_mes, c.ca_login, i.ca_referencia, cl.ca_compania, c.ca_hbls;
REVOKE ALL ON public.vi_inocomisiones_sea FROM PUBLIC;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO postgres WITH GRANT OPTION;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO "Administrador";
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO GROUP "Usuarios";


Drop view vi_inoingresos_sea cascade;
Create view vi_inoingresos_sea as
Select DISTINCT i.oid as ca_oid, (CASE WHEN (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND m.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(i.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(i.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(i.ca_referencia::text, '.'::text))[3] AS ca_mes, i.ca_referencia, i.ca_idcliente, c.ca_compania, l.ca_hbls, l.ca_login, l.ca_volumen,
       i.ca_factura, i.ca_fchfactura, i.ca_reccaja, i.ca_fchpago, i.ca_idmoneda, i.ca_neto, i.ca_valor, i.ca_observaciones, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado,
       (select fun_getcomision(c.ca_idcliente, i.ca_referencia, 'Coltrans')) as ca_porcentaje,
       (select sum(cm.ca_vlrcomision) from tb_inocomisiones_sea cm where l.ca_referencia = cm.ca_referencia and l.ca_hbls = cm.ca_hbls) as ca_vlrcomisiones,
       (select sum(cm.ca_sbrcomision) from tb_inocomisiones_sea cm where l.ca_referencia = cm.ca_referencia and l.ca_hbls = cm.ca_hbls) as ca_sbrcomisiones,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen_r,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion_r,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion_r,
       (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad_r,
       (select sum(iu.ca_valor) from tb_inoutilidad_sea iu where l.ca_referencia = iu.ca_referencia and l.ca_idcliente = iu.ca_idcliente and l.ca_hbls = iu.ca_hbls) as ca_sbrcomision,
       cm.ca_comprobante, cm.ca_fchliquidacion, cm.ca_vlrcomision as ca_vlrcomision_cob, cm.ca_sbrcomision as ca_sbrcomision_cob,
       (case when m.ca_provisional then 'Provisional' else (case when m.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado,
       (case when c.ca_fchcircular is null then 'Sin'::text else case when (c.ca_fchcircular + 365) < now() then 'Vencido'::text else 'Vigente'::text end end) as ca_stdcircular
       FROM tb_inoingresos_sea i
       LEFT JOIN tb_inoclientes_sea l ON (i.ca_referencia = l.ca_referencia and i.ca_hbls = l.ca_hbls)
       LEFT JOIN tb_clientes c ON (l.ca_idcliente = c.ca_idcliente)
       LEFT JOIN tb_inomaestra_sea m ON (i.ca_referencia = m.ca_referencia )
       LEFT JOIN tb_inocomisiones_sea cm ON (i.ca_referencia = cm.ca_referencia and i.ca_idcliente = cm.ca_idcliente and i.ca_hbls = cm.ca_hbls)
       order by ca_login, ca_compania, ca_referencia, ca_hbls, ca_factura;
REVOKE ALL ON vi_inoingresos_sea FROM PUBLIC;
GRANT ALL ON vi_inoingresos_sea TO "Administrador";
GRANT ALL ON vi_inoingresos_sea TO GROUP "Usuarios";


// Drop view vi_inocarga_fcl;
Create view vi_inocarga_fcl as
Select im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_modalidad, im.ca_traorigen, im.ca_ciudestino, c.ca_liminferior as ca_capacidad, sum(round(c.ca_liminferior/20,0)*ic.ca_factor) as ca_teus, sum(ie.ca_cantidad*ic.ca_factor) as ca_cantidad, ca_sucursal from ( select inoc.ca_referencia, inoc.ca_idcliente, ca_login, sum(inoc.ca_volumen) / (case when max(inov.ca_granvol) <> 0 then max(inov.ca_granvol) else 1 end) as ca_factor from tb_inoclientes_sea inoc, (select ca_referencia, sum(ca_volumen) as ca_granvol from tb_inoclientes_sea group by ca_referencia) inov
       where inoc.ca_referencia = inov.ca_referencia group by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login order by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login ) ic
       LEFT OUTER JOIN vi_inocontenedores_sea im ON (ic.ca_referencia = im.ca_referencia)
       LEFT OUTER JOIN tb_inoequipos_sea ie ON (ic.ca_referencia = ie.ca_referencia)
       LEFT OUTER JOIN tb_conceptos c ON (ie.ca_idconcepto = c.ca_idconcepto), control.tb_usuarios u
       where im.ca_modalidad in ('FCL','PROYECTOS') and c.ca_unidad != 'Tonelada/Metro³' and ic.ca_login = u.ca_login
       group by ca_ano, ca_mes, im.ca_modalidad, ca_liminferior, ca_trafico, ca_traorigen, ca_ciudestino, u.ca_sucursal
       order by ca_ano, ca_mes, ca_sucursal, im.ca_modalidad, ca_traorigen, ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inocarga_fcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_fcl TO "Administrador";
GRANT ALL ON vi_inocarga_fcl TO GROUP "Usuarios";


// Drop view vi_inocarga_lcl;
Create view vi_inocarga_lcl as
Select i.ca_ano, i.ca_mes, u.ca_sucursal, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_volumen) as ca_volumen
       from vi_inocontenedores_sea i, tb_inoclientes_sea c, control.tb_usuarios u
       where i.ca_modalidad not in ('FCL','PROYECTOS') and i.ca_referencia = c.ca_referencia and c.ca_login = u.ca_login
       group by ca_ano, ca_mes, ca_sucursal, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, u.ca_sucursal, i.ca_traorigen, i.ca_ciudestino;
REVOKE ALL ON vi_inocarga_lcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_lcl TO "Administrador";
GRANT ALL ON vi_inocarga_lcl TO GROUP "Usuarios";


// Drop view vi_inonaviera_fcl;
Create view vi_inonaviera_fcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, substr(e.ca_concepto,1,2) as ca_capacidad, sum(e.ca_cantidad) as ca_cantidad
       from vi_inocontenedores_sea i, vi_inoequipos_sea e
       where i.ca_modalidad in ('FCL','PROYECTOS') and i.ca_referencia = e.ca_referencia
       group by ca_ano, ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, substr(ca_concepto,1,2), ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, ca_traorigen, ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inonaviera_fcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_fcl TO "Administrador";
GRANT ALL ON vi_inonaviera_fcl TO GROUP "Usuarios";


-- Drop view vi_inonaviera_lcl;
Create view vi_inonaviera_lcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_numpiezas) as ca_numpiezas, sum(c.ca_peso) as ca_peso, sum(c.ca_volumen) as ca_volumen
       from vi_inocontenedores_sea i, tb_inoclientes_sea c
       where i.ca_modalidad not in ('FCL','PROYECTOS') and i.ca_referencia = c.ca_referencia
       group by ca_ano, ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_nomtransportista, ca_nombre, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inonaviera_lcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_lcl TO "Administrador";
GRANT ALL ON vi_inonaviera_lcl TO GROUP "Usuarios";


-- Drop view vi_inotrafico_fcl;
Create view vi_inotrafico_fcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(e.ca_20pies) as ca_20pies, sum(q.ca_40pies) as ca_40pies, sum((case when e.ca_20pies <> 0 then e.ca_20pies else 0 end) + ((case when q.ca_40pies <> 0 then q.ca_40pies else 0 end)*2)) as ca_teus
       from vi_inocontenedores_sea i
       LEFT OUTER JOIN (select ie.ca_referencia, count(ie.ca_idequipo) as ca_20pies from vi_inoequipos_sea ie where ie.ca_liminferior = 20 group by ie.ca_referencia) e ON (i.ca_referencia = e.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, count(ie.ca_idequipo) as ca_40pies from vi_inoequipos_sea ie where ie.ca_liminferior in (40, 45) group by ie.ca_referencia) q ON (i.ca_referencia = q.ca_referencia)
       where i.ca_modalidad in ('FCL','PROYECTOS')
       group by ca_ano, ca_mes, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inotrafico_fcl FROM PUBLIC;
GRANT ALL ON vi_inotrafico_fcl TO "Administrador";
GRANT ALL ON vi_inotrafico_fcl TO GROUP "Usuarios";


-- Drop view vi_inotrafico_lcl;
Create view vi_inotrafico_lcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_volumen) as ca_volumen, sum(e.ca_20pies) as ca_20pies, sum(q.ca_40pies) as ca_40pies, sum((case when e.ca_20pies <> 0 then e.ca_20pies else 0 end) + ((case when q.ca_40pies <> 0 then q.ca_40pies else 0 end)*2)) as ca_teus
       from vi_inocontenedores_sea i
       INNER JOIN (select ic.ca_referencia, sum(ic.ca_volumen) as ca_volumen from tb_inoclientes_sea ic group by ic.ca_referencia) c ON (i.ca_referencia = c.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, sum(ie.ca_cantidad) as ca_20pies from vi_inoequipos_sea ie where ie.ca_liminferior = 20 group by ie.ca_referencia) e ON (i.ca_referencia = e.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, sum(ie.ca_cantidad) as ca_40pies from vi_inoequipos_sea ie where ie.ca_liminferior in (40, 45) group by ie.ca_referencia) q ON (i.ca_referencia = q.ca_referencia)
       where i.ca_modalidad not in ('FCL','PROYECTOS')
       group by ca_ano, ca_mes, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inotrafico_lcl FROM PUBLIC;
GRANT ALL ON vi_inotrafico_lcl TO "Administrador";
GRANT ALL ON vi_inotrafico_lcl TO GROUP "Usuarios";


Drop view vi_inoauditor_sea;
Create view vi_inoauditor_sea as
Select case when an.ca_idevento!=0 then an.ca_idevento else ev.ca_idevento end as ca_idevento_ant,
       case when an.ca_idevento!=0 then an.ca_asunto else ev.ca_asunto end as ca_asunto_ant,
       ev.oid as ca_oid, ev.ca_idevento, ev.ca_referencia, ev.ca_fchevento, ev.ca_tipo, ev.ca_asunto, ev.ca_detalle, ev.ca_compromisos, ev.ca_fchcompromiso, ev.ca_idantecedente, ev.ca_usuario, 
	   (case when im.ca_provisional then 'Provisional' else (case when im.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inoauditor_sea an RIGHT OUTER JOIN tb_inoauditor_sea ev ON (ev.ca_idantecedente = an.ca_idevento) LEFT OUTER JOIN tb_inomaestra_sea im ON (ev.ca_referencia = im.ca_referencia)
       order by ca_idevento_ant DESC, ca_idevento DESC;
REVOKE ALL ON vi_inoauditor_sea FROM PUBLIC;
GRANT ALL ON vi_inoauditor_sea TO "Administrador";
GRANT ALL ON vi_inoauditor_sea TO GROUP "Usuarios";


-- Drop view vi_inosufijos_sea;
Create view vi_inosufijos_sea as
select i.ca_ano, i.ca_mes, i.ca_idcliente, i.ca_compania, i.ca_trafico, i.ca_traorigen, count(DISTINCT i.ca_referencia||'|'||i.ca_idcliente||'|'||i.ca_hbls) as ca_hbls,
       sum((case when i.ca_valor <> 0 then i.ca_valor else 0 end)) as ca_facturacion,
       sum(round((((case when i.ca_facturacion_r <> 0 then i.ca_facturacion_r else 0 end)-
       (case when i.ca_deduccion_r <> 0 then i.ca_deduccion_r else 0 end)-
       (case when i.ca_utilidad_r <> 0 then i.ca_utilidad_r else 0 end))/
       (case when i.ca_volumen_r <> 0 then i.ca_volumen_r else 1 end))*
       (case when i.ca_volumen <> 0 then i.ca_volumen else 0 end),0)) as ca_utilidad,
       ( select sum(iu.ca_valor) from tb_inoutilidad_sea iu
         LEFT OUTER JOIN tb_inomaestra_sea im ON (iu.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_inoclientes_sea ic ON (iu.ca_referencia = ic.ca_referencia and iu.ca_idcliente = ic.ca_idcliente and iu.ca_hbls = ic.ca_hbls)
         LEFT OUTER JOIN tb_ciudades c ON (im.ca_origen = c.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (c.ca_idtrafico = t.ca_idtrafico)
         where substr(ic.ca_referencia,15,1) = i.ca_ano and substr(ic.ca_referencia,8,2)||'-'||substr(ic.ca_referencia,15,1) = i.ca_mes and iu.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_sobreventa,
       ( select sum(round(c.ca_liminferior/20,0)*ic.ca_factor) from ( select inoc.ca_referencia, inoc.ca_idcliente, ca_login, sum(inoc.ca_volumen) / (case when max(inov.ca_granvol) <> 0 then max(inov.ca_granvol) else 1 end) as ca_factor from tb_inoclientes_sea inoc, (select ca_referencia, sum(ca_volumen) as ca_granvol from tb_inoclientes_sea group by ca_referencia) inov
         where inoc.ca_referencia = inov.ca_referencia group by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login order by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login ) ic
         LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_inoequipos_sea ie ON (ic.ca_referencia = ie.ca_referencia)
         LEFT OUTER JOIN tb_conceptos c ON (ie.ca_idconcepto = c.ca_idconcepto)
         LEFT OUTER JOIN tb_ciudades d ON (im.ca_origen = d.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (d.ca_idtrafico = t.ca_idtrafico)
         where im.ca_modalidad in ('FCL','PROYECTOS') and substr(im.ca_referencia,15,1) = i.ca_ano and substr(im.ca_referencia,8,2)||'-'||substr(im.ca_referencia,15,1) = i.ca_mes and ic.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_teus,
       ( select sum(ic.ca_volumen) from tb_inoclientes_sea ic
         LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_ciudades c ON (im.ca_origen = c.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (c.ca_idtrafico = t.ca_idtrafico)
         where im.ca_modalidad not in ('FCL','PROYECTOS') and substr(im.ca_referencia,15,1) = i.ca_ano and substr(im.ca_referencia,8,2)||'-'||substr(im.ca_referencia,15,1) = i.ca_mes and ic.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_cbms
       from ( select im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_traorigen, ic.ca_referencia, ic.ca_idcliente, c.ca_compania, ic.ca_hbls, ic.ca_volumen, sum(ii.ca_valor) as ca_valor, im.ca_facturacion::numeric as ca_facturacion_r, im.ca_deduccion::numeric as ca_deduccion_r, im.ca_utilidad::numeric as ca_utilidad_r, im.ca_volumen as ca_volumen_r, u.ca_login, u.ca_sucursal
              from tb_inoclientes_sea ic LEFT OUTER JOIN tb_inoingresos_sea ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls) LEFT OUTER JOIN control.tb_usuarios u ON (ic.ca_login = u.ca_login), vi_inocontenedores_sea im, tb_clientes c
              where ic.ca_referencia = im.ca_referencia and ic.ca_idcliente = c.ca_idcliente
              group by im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_traorigen, ic.ca_referencia, ic.ca_idcliente, c.ca_compania, ic.ca_hbls, ic.ca_volumen, im.ca_facturacion, im.ca_deduccion, im.ca_utilidad, im.ca_volumen, u.ca_sucursal, u.ca_login ) as i
       group by i.ca_ano, i.ca_mes, i.ca_idcliente, i.ca_compania, i.ca_trafico, i.ca_traorigen
       order by ca_facturacion DESC;
REVOKE ALL ON vi_inosufijos_sea FROM PUBLIC;
GRANT ALL ON vi_inosufijos_sea TO "Administrador";
GRANT ALL ON vi_inosufijos_sea TO GROUP "Usuarios";


-- Drop view vi_inotraficos_sea;
Create view vi_inotraficos_sea as
Select (CASE WHEN (string_to_array(m.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND m.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(m.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(m.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
       (string_to_array(m.ca_referencia::text, '.'::text))[3] AS ca_mes, t.ca_nombre as ca_traorigen, substr(m.ca_referencia,5,2) as ca_sufijo,
       count(DISTINCT m.ca_referencia) as ca_referencias,
       count(DISTINCT c.ca_referencia||'|'||c.ca_idcliente||'|'||c.ca_hbls) as ca_hbls,
       count(DISTINCT c.ca_idcliente) as ca_clientes,
       sum(i.ca_valor) as ca_facturacion
       from tb_inomaestra_sea m LEFT OUTER JOIN tb_inoclientes_sea c ON (c.ca_referencia = m.ca_referencia)
       LEFT OUTER JOIN (select ca_referencia, ca_idcliente, ca_hbls, sum(ca_valor) as ca_valor from tb_inoingresos_sea group by ca_referencia, ca_idcliente, ca_hbls) i ON (c.ca_referencia = i.ca_referencia and c.ca_idcliente = i.ca_idcliente and c.ca_hbls = i.ca_hbls), tb_ciudades p, tb_traficos t
       where m.ca_origen = p.ca_idciudad and p.ca_idtrafico = t.ca_idtrafico
       group by ca_ano, ca_mes, ca_sufijo, ca_traorigen
       order by ca_ano, ca_mes, ca_traorigen;
REVOKE ALL ON vi_inotraficos_sea FROM PUBLIC;
GRANT ALL ON vi_inotraficos_sea TO "Administrador";
GRANT ALL ON vi_inotraficos_sea TO GROUP "Usuarios";

-- Drop view vi_inoutilidades_sea;
Create view vi_inoutilidades_sea as
select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_modal, i.ca_traorigen, i.ca_ciuorigen, i.ca_ciudestino, i.ca_modalidad, i.ca_referencia, i.ca_estado,
       (case when i.ca_facturacion <> 0 then i.ca_facturacion else 0 end) - (case when i.ca_deduccion <> 0 then i.ca_deduccion else 0 end) - (case when i.ca_utilidad <> 0 then i.ca_utilidad else 0 end) as ca_utilcons,
       (((case when i.ca_facturacion <> 0 then i.ca_facturacion else 0 end) - (case when i.ca_deduccion <> 0 then i.ca_deduccion else 0 end) - (case when i.ca_utilidad <> 0 then i.ca_utilidad else 0 end)) / case when i.ca_volumen <> 0 then i.ca_volumen else 1 end) as ca_utilxcbm
       from vi_inocontenedores_sea i order by ca_ano, ca_mes, ca_traorigen, ca_modalidad, ca_utilxcbm;
REVOKE ALL ON vi_inoutilidades_sea FROM PUBLIC;
GRANT ALL ON vi_inoutilidades_sea TO "Administrador";
GRANT ALL ON vi_inoutilidades_sea TO GROUP "Usuarios";


// Drop view vi_inoctrlcontenedores_sea cascade;
Create view vi_inoctrlcontenedores_sea as
Select i.oid as ca_oid, substr(i.ca_referencia,15,1) as ca_ano, substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_referencia, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, case when i.ca_mnllegada IS NULL then i.ca_motonave else i.ca_mnllegada end, i.ca_ciclo, i.ca_mbls, case when i.ca_fchconfirmacion IS NULL then i.ca_fcharribo else i.ca_fchconfirmacion end,
	   i.ca_horaconfirmacion, (case when i.ca_fchconfirmacion IS NULL then i.ca_fcharribo else i.ca_fchconfirmacion end + int2(case when p.ca_valor IS NULL then '10' else p.ca_valor end)) as ca_fchdevolucion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, c.ca_idcliente, cl.ca_compania, c.ca_hbls, m.ca_fchvencimiento
       from tb_inomaestra_sea i LEFT OUTER JOIN tb_inoclientes_sea c ON (i.ca_referencia = c.ca_referencia) LEFT OUTER JOIN tb_clientes cl ON (c.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN tb_parametros p ON (p.ca_casouso = 'CU040' and i.ca_idlinea = p.ca_identificacion) LEFT OUTER JOIN tb_comcliente m ON (c.ca_idcliente = m.ca_idcliente and date('now') >= m.ca_fchfirmado and date('now') <= m.ca_fchvencimiento),
	   tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inoctrlcontenedores_sea FROM PUBLIC;
GRANT ALL ON vi_inoctrlcontenedores_sea TO "Administrador";
GRANT ALL ON vi_inoctrlcontenedores_sea TO GROUP "Usuarios";


// Drop view vi_repgerencia_sea cascade;
Create view vi_repgerencia_sea as
select (CASE WHEN (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND im.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(im.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
	(string_to_array(im.ca_referencia::text, '.'::text))[3] AS ca_mes, substr(ic.ca_referencia,5,2) as ca_sufijo,
	ic.ca_referencia, im.ca_modalidad, tr.ca_nombre as ca_traorigen, co.ca_ciudad as ca_ciuorigen, cd.ca_ciudad as ca_ciudestino, us.ca_sucursal, ic.ca_idcliente, cl.ca_compania, ic.ca_hbls,
	ii.ca_facturacion, (round(iu.ca_utilidad_r / (case when iu.ca_volumen_r = 0 then 1 else iu.ca_volumen_r end) * ic.ca_volumen,0)) as ca_utilidad, iv.ca_sobreventa,
	(case when im.ca_modalidad not in ('FCL','PROYECTOS') then ic.ca_volumen else 0 end) as ca_cbm,
	(case when im.ca_modalidad in ('FCL','PROYECTOS') then (round(ie.ca_teus / (case when iu.ca_volumen_r = 0 then 1 else iu.ca_volumen_r end) * ic.ca_volumen,2)) else 0 end) as ca_teus,
	(case when im.ca_provisional then 'Provisional' else (case when im.ca_usucerrado IS NOT NULL then 'Cerrado' else 'Abierto' end) end) as ca_estado,
	nv.ca_nombre as ca_nomlinea, ic.ca_login, us.ca_nombre as ca_vendedor
	
	from tb_inoclientes_sea ic
		LEFT OUTER JOIN (select ca_referencia, ca_hbls, ca_idcliente, sum(to_number(ca_valor::text,'9999999999.99')) as ca_facturacion from tb_inoingresos_sea group by ca_referencia, ca_hbls, ca_idcliente) ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls)
		LEFT OUTER JOIN (
			select im.ca_referencia, iv.ca_volumen_r, (case when not ii.ca_facturacion_r IS NULL then ii.ca_facturacion_r else 0 end)-(case when not id.ca_deduccion_r IS NULL then id.ca_deduccion_r else 0 end)-(case when not ic.ca_costosplus_r IS NULL then ic.ca_costosplus_r else 0 end) as ca_utilidad_r from tb_inomaestra_sea im
			LEFT OUTER JOIN (select ca_referencia, sum(ca_volumen) as ca_volumen_r from tb_inoclientes_sea group by ca_referencia) iv on (im.ca_referencia = iv.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_valor) as ca_facturacion_r from tb_inoingresos_sea group by ca_referencia) ii on (im.ca_referencia = ii.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_valor) as ca_deduccion_r from tb_inodeduccion_sea group by ca_referencia) id on (im.ca_referencia = id.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_venta) as ca_costosplus_r from tb_inocostos_sea group by ca_referencia) ic on (im.ca_referencia = ic.ca_referencia)
		) iu ON (ic.ca_referencia = iu.ca_referencia)
		LEFT OUTER JOIN (
			select im.ca_referencia, sum(round(cp.ca_liminferior/20,0)) as ca_teus from tb_inomaestra_sea im, tb_inoequipos_sea ie, tb_conceptos cp
			where im.ca_referencia = ie.ca_referencia and ie.ca_idconcepto = cp.ca_idconcepto and im.ca_modalidad = cp.ca_modalidad and im.ca_modalidad in ('FCL','PROYECTOS')
			group by im.ca_referencia
		) ie ON (ic.ca_referencia = ie.ca_referencia)
		LEFT OUTER JOIN (
			select iu.ca_referencia, iu.ca_idcliente, iu.ca_hbls, sum(ic.ca_venta-(ic.ca_tcambio*ic.ca_neto)) as ca_sobreventa from tb_inoutilidad_sea iu
			LEFT OUTER JOIN tb_inocostos_sea ic ON (iu.ca_referencia = ic.ca_referencia and iu.ca_idcosto = ic.ca_idcosto and iu.ca_factura = ic.ca_factura)
			group by iu.ca_referencia, iu.ca_idcliente, iu.ca_hbls
		) iv ON (ic.ca_referencia = iv.ca_referencia and ic.ca_idcliente = iv.ca_idcliente and ic.ca_hbls = iv.ca_hbls)
		LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
		LEFT OUTER JOIN tb_clientes cl ON (ic.ca_idcliente = cl.ca_idcliente)
		LEFT OUTER JOIN tb_ciudades co ON (im.ca_origen = co.ca_idciudad)
		LEFT OUTER JOIN tb_ciudades cd ON (im.ca_destino = cd.ca_idciudad)
		LEFT OUTER JOIN tb_traficos tr ON (co.ca_idtrafico = tr.ca_idtrafico)
		LEFT OUTER JOIN vi_transporlineas nv ON (im.ca_idlinea = nv.ca_idlinea)
		LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_login = us.ca_login)
		order by ca_referencia;
REVOKE ALL ON vi_repgerencia_sea FROM PUBLIC;
GRANT ALL ON vi_repgerencia_sea TO "Administrador";
GRANT ALL ON vi_repgerencia_sea TO GROUP "Usuarios";

		order by ca_ano, ca_mes, ca_sufijo, ca_traorigen, ca_ciuorigen, ca_ciudestino;

//     Instrucción para crear un campo con el resultado de un select
//     (select '|' || e.ca_referencia || ',' || e.ca_concepto || ',' || sum(e.ca_cantidad) || '|' as ca_cantidad from vi_inoequipos_sea e where e.ca_referencia = i.ca_referencia group by ca_referencia, ca_concepto)::text as ca_equipos


Select substr(i.ca_referencia,15,1) as ca_ano, substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_modalidad,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion,
       (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad
       ((select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) - (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) - (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '')) as ca_utilidad
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2
       where ca_referencia = '500.10.01.006.5' and i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico
       order by ca_ano, ca_mes, ca_traorigen, ca_modalidad, ca_utilidad


// Drop view vi_repindicadores cascade;
Create view vi_repindicadores as
select rp.ca_idreporte, rp.ca_consecutivo, rx.ca_fchcreado, rx.ca_version, substr(rx.ca_fchreporte::text,1,4) as ca_ano, substr(rx.ca_fchreporte::text,6,2) as ca_mes,
       sc.ca_nombre as ca_sucursal, tro.ca_nombre as ca_traorigen, cid.ca_ciudad as ca_ciudestino, rp.ca_transporte, rp.ca_modalidad, rp.ca_impoexpo, rp.ca_continuacion, ccl.ca_compania
--      , rs.ca_idemail, rs.ca_piezas, rs.ca_peso, rs.ca_volumen, rs.ca_doctransporte
from tb_reportes rp
-- La última versión del reporte
	LEFT OUTER JOIN (select ca_consecutivo as ca_consecutivo_f, ca_fchreporte, max(ca_version) as ca_version, min(ca_fchcreado) as ca_fchcreado from tb_reportes where ca_usuanulado IS NULL group by ca_consecutivo, ca_fchreporte order by ca_consecutivo_f) rx ON (rp.ca_consecutivo = rx.ca_consecutivo_f and rp.ca_version = rx.ca_version)

	INNER JOIN control.tb_usuarios us ON (rp.ca_login = us.ca_login)
	INNER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal)
	INNER JOIN tb_ciudades cio ON (rp.ca_origen = cio.ca_idciudad)
	INNER JOIN tb_traficos tro ON (cio.ca_idtrafico = tro.ca_idtrafico)
	INNER JOIN tb_ciudades cid ON (rp.ca_destino = cid.ca_idciudad)
	INNER JOIN tb_concliente ccn ON (rp.ca_idconcliente = ccn.ca_idcontacto)
	INNER JOIN tb_clientes ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)

-- El último status
--	LEFT OUTER JOIN (select rpt.ca_consecutivo as ca_consecutivo_f, max(rps.ca_idemail) as ca_idemail from tb_repstatus rps, tb_reportes rpt where rpt.ca_idreporte = rps.ca_idreporte group by ca_consecutivo) rf ON (rp.ca_consecutivo = rf.ca_consecutivo_f)
--	LEFT OUTER JOIN tb_repstatus rs ON (rs.ca_idemail = rf.ca_idemail)

order by ca_ano, ca_mes, ca_sucursal, to_number(substr(rp.ca_consecutivo,0,position('-' in rp.ca_consecutivo)),'99999999');
REVOKE ALL ON vi_repindicadores FROM PUBLIC;
GRANT ALL ON vi_repindicadores TO "Administrador";
GRANT ALL ON vi_repindicadores TO GROUP "Usuarios";


// Drop view vi_repindicador_sea cascade;
Create view vi_repindicador_sea as
select im.ca_referencia, ic.ca_idcliente, ic.ca_hbls, rp.ca_idreporte, rp.ca_consecutivo, rp.ca_version, (CASE WHEN (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND im.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(im.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano, ((string_to_array(im.ca_referencia,'.'))[3])::text as ca_mes,
    sc.ca_nombre as ca_sucursal, tro.ca_nombre as ca_traorigen, cid.ca_ciudad as ca_ciudestino, rp.ca_transporte, im.ca_modalidad, im.ca_impoexpo, ic.ca_continuacion, ccl.ca_compania, to_timestamp(im.ca_fchconfirmacion||' '||im.ca_horaconfirmacion, 'yyyy-mm-dd hh24:mi:ss')::timestamp as ca_fchconfirmacion

from tb_inomaestra_sea im
	LEFT OUTER JOIN tb_inoclientes_sea ic ON (ic.ca_referencia = im.ca_referencia)
	LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = ic.ca_idreporte)
	LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_login = us.ca_login)
	LEFT OUTER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal)
	LEFT OUTER JOIN tb_ciudades cio ON (im.ca_origen = cio.ca_idciudad)
	LEFT OUTER JOIN tb_traficos tro ON (cio.ca_idtrafico = tro.ca_idtrafico)
	LEFT OUTER JOIN tb_ciudades cid ON (im.ca_destino = cid.ca_idciudad)
	LEFT OUTER JOIN tb_concliente ccn ON (rp.ca_idconcliente = ccn.ca_idcontacto)
	LEFT OUTER JOIN tb_clientes ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)

-- La última versión del reporte
	INNER JOIN (select ca_consecutivo as ca_consecutivo_f, ca_fchreporte, max(ca_version) as ca_version from tb_reportes where ca_usuanulado IS NULL group by ca_consecutivo, ca_fchreporte order by ca_consecutivo_f) rx ON (rp.ca_consecutivo = rx.ca_consecutivo_f)

order by ca_ano, ca_mes, ca_sucursal, to_number(substr(rp.ca_consecutivo,0,position('-' in rp.ca_consecutivo)),'99999999');
REVOKE ALL ON vi_repindicador_sea FROM PUBLIC;
GRANT ALL ON vi_repindicador_sea TO "Administrador";
GRANT ALL ON vi_repindicador_sea TO GROUP "Usuarios";


// Drop view vi_repindicador_air cascade;
Create view vi_repindicador_air as
select im.ca_referencia, ic.ca_idcliente, ic.ca_hawb, rx.ca_idreporte, ic.ca_idreporte as ca_consecutivo, rx.ca_version, (CASE WHEN (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND im.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(im.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(im.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano, ((string_to_array(im.ca_referencia,'.'))[3])::text as ca_mes,
    sc.ca_nombre as ca_sucursal, tro.ca_nombre as ca_traorigen, cid.ca_ciudad as ca_ciudestino, rx.ca_transporte, im.ca_modalidad, rx.ca_impoexpo, rx.ca_continuacion, ccl.ca_compania

from tb_inomaestra_air im
	LEFT OUTER JOIN tb_inoclientes_air ic ON (ic.ca_referencia = im.ca_referencia)
	LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_loginvendedor = us.ca_login)
	LEFT OUTER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal)
	LEFT OUTER JOIN tb_ciudades cio ON (im.ca_origen = cio.ca_idciudad)
	LEFT OUTER JOIN tb_traficos tro ON (cio.ca_idtrafico = tro.ca_idtrafico)
	LEFT OUTER JOIN tb_ciudades cid ON (im.ca_destino = cid.ca_idciudad)

-- La última versión del reporte
	INNER JOIN (select rp.ca_idreporte, rp.ca_transporte, rp.ca_impoexpo, rp.ca_idconcliente, rp.ca_consecutivo, rp.ca_fchreporte, rp.ca_version, rp.ca_continuacion from tb_reportes rp INNER JOIN (select ca_consecutivo, max(ca_version) as ca_version from tb_reportes where ca_transporte = 'Aéreo' and ca_usuanulado IS NULL group by ca_consecutivo) rv ON (rp.ca_consecutivo = rv.ca_consecutivo and rp.ca_version = rv.ca_version) order by ca_consecutivo) rx ON (ic.ca_idreporte = rx.ca_consecutivo)

	LEFT OUTER JOIN tb_concliente ccn ON (rx.ca_idconcliente = ccn.ca_idcontacto)
	LEFT OUTER JOIN tb_clientes ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)

order by ca_ano, ca_mes, ca_sucursal, to_number(substr(rx.ca_consecutivo,0,position('-' in rx.ca_consecutivo)),'99999999');
REVOKE ALL ON vi_repindicador_air FROM PUBLIC;
GRANT ALL ON vi_repindicador_air TO "Administrador";
GRANT ALL ON vi_repindicador_air TO GROUP "Usuarios";


// Drop view vi_cotindicadores cascade;
Create view vi_cotindicadores as
select ct.ca_idcotizacion, ct.ca_consecutivo, substr(ct.ca_fchcreado::text,1,4) as ca_ano, substr(ct.ca_fchcreado::text,6,2) as ca_mes,
	tr.ca_fchcreado as ca_fchsolicitud, tr.ca_fchterminada as ca_fchpresentacion, tr.ca_observaciones, sc.ca_nombre as ca_sucursal, tro.ca_nombre as ca_traorigen, cid.ca_ciudad as ca_ciudestino, cp.ca_impoexpo, cp.ca_transporte, cp.ca_modalidad, ccl.ca_compania
from tb_cotproductos cp
	LEFT OUTER JOIN tb_cotizaciones ct ON (cp.ca_idcotizacion = ct.ca_idcotizacion)
	LEFT OUTER JOIN notificaciones.tb_tareas tr ON (tr.ca_idtarea = ct.ca_idg_envio_oportuno)
	LEFT OUTER JOIN control.tb_usuarios us ON (ct.ca_usuario = us.ca_login)
	LEFT OUTER JOIN control.tb_sucursales sc ON (us.ca_idsucursal::text = sc.ca_idsucursal::text)
	LEFT OUTER JOIN tb_ciudades cio ON (cp.ca_origen::text = cio.ca_idciudad::text)
	LEFT OUTER JOIN tb_traficos tro ON (cio.ca_idtrafico::text = tro.ca_idtrafico::text)
	LEFT OUTER JOIN tb_ciudades cid ON (cp.ca_destino::text = cid.ca_idciudad::text)
	LEFT OUTER JOIN tb_concliente ccn ON (ct.ca_idcontacto = ccn.ca_idcontacto)
	LEFT OUTER JOIN tb_clientes ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)
where ct.ca_usuanulado IS NULL
order by ca_ano, ca_mes, ca_sucursal, to_number(substr(ct.ca_consecutivo,0,position('-' in ct.ca_consecutivo)),'99999999');

REVOKE ALL ON vi_cotindicadores FROM PUBLIC;
GRANT ALL ON vi_cotindicadores TO "Administrador";
GRANT ALL ON vi_cotindicadores TO GROUP "Usuarios";


// DROP VIEW vi_repindicador_brk;
CREATE OR REPLACE VIEW vi_repindicador_brk AS
 SELECT bkm.ca_referencia, bkm.ca_fchreferencia, bkm.ca_fcharribo, bkm.ca_idcliente, bkm.ca_coordinador, (CASE WHEN (string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND bkm.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(bkm.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano
, (string_to_array(bkm.ca_referencia::text, '.'::text))[3] AS ca_mes, sc.ca_nombre AS ca_sucursal, tro.ca_nombre AS ca_traorigen, cid.ca_ciudad AS ca_ciudestino, 'Aduana'::text AS ca_transporte, 'Aduana'::text AS ca_modalidad, 'Importación'::text AS ca_impoexpo, ccl.ca_compania, bkm.ca_aplicaidg
   FROM tb_brk_maestra bkm
   LEFT JOIN control.tb_usuarios us ON bkm.ca_vendedor::text = us.ca_login::text
   LEFT JOIN control.tb_sucursales sc ON us.ca_idsucursal = sc.ca_idsucursal
   LEFT JOIN tb_ciudades cio ON bkm.ca_origen::text = cio.ca_idciudad::text
   LEFT JOIN tb_traficos tro ON cio.ca_idtrafico::text = tro.ca_idtrafico::text
   LEFT JOIN tb_ciudades cid ON bkm.ca_destino::text = cid.ca_idciudad::text
   LEFT JOIN tb_clientes ccl ON bkm.ca_idcliente = ccl.ca_idcliente
  ORDER BY ca_ano, ca_mes, sc.ca_nombre, bkm.ca_referencia;

ALTER TABLE vi_repindicador_brk OWNER TO postgres;
GRANT ALL ON TABLE vi_repindicador_brk TO postgres;
GRANT ALL ON TABLE vi_repindicador_brk TO "Administrador";
GRANT ALL ON TABLE vi_repindicador_brk TO "Usuarios";

-- View: vi_repindicador_exp

-- DROP VIEW vi_repindicador_exp;

CREATE OR REPLACE VIEW vi_repindicador_exp AS
 SELECT DISTINCT exm.ca_referencia, exm.ca_fchreferencia, exm.ca_fchcreado, exm.ca_idcliente, (CASE WHEN (string_to_array(exm.ca_referencia::text, '.'::text))[5]::integer BETWEEN 0 AND 4 AND exm.ca_fchreferencia > '2009-01-01' THEN ((string_to_array(exm.ca_referencia::text, '.'::text))[5]::integer) + 2010 ELSE (string_to_array(exm.ca_referencia::text, '.'::text))[5]::integer + 2000 END) as ca_ano,
 (string_to_array(exm.ca_referencia::text, '.'::text))[3] AS ca_mes, exm.ca_aplicaidg, sia.ca_nombre AS ca_nomsia, rpt.ca_sucursal, tro.ca_nombre AS ca_traorigen, cid.ca_ciudad AS ca_ciudestino,
        CASE
            WHEN exm.ca_via::text = 'Aereo'::text THEN 'Aéreo'::character varying
            ELSE
            CASE
                WHEN exm.ca_via::text = 'Maritimo'::text THEN 'Marítimo'::character varying
                ELSE exm.ca_via
            END
        END AS ca_transporte, exm.ca_modalidad, 'Exportación'::text AS ca_impoexpo, exm.ca_consecutivo, rpt.ca_version, ccl.ca_compania
   FROM tb_expo_maestra exm
   LEFT JOIN ( SELECT rp.ca_consecutivo, rp.ca_version, sc.ca_nombre AS ca_sucursal
           FROM tb_reportes rp
      JOIN ( SELECT tb_reportes.ca_consecutivo, max(tb_reportes.ca_version) AS ca_version
                   FROM tb_reportes
                  WHERE tb_reportes.ca_impoexpo = 'Exportación'::text AND tb_reportes.ca_usuanulado IS NULL
                  GROUP BY tb_reportes.ca_consecutivo
                  ORDER BY tb_reportes.ca_consecutivo) rm ON rp.ca_consecutivo::text = rm.ca_consecutivo::text AND rp.ca_version = rm.ca_version
   JOIN control.tb_usuarios us ON rp.ca_login::text = us.ca_login::text
   JOIN control.tb_sucursales sc ON us.ca_idsucursal = sc.ca_idsucursal) rpt ON exm.ca_consecutivo::text = rpt.ca_consecutivo::text
   LEFT JOIN tb_sia sia ON exm.ca_idsia::text = sia.ca_idsia::text
   LEFT JOIN tb_ciudades cio ON exm.ca_origen::text = cio.ca_idciudad::text
   LEFT JOIN tb_traficos tro ON cio.ca_idtrafico::text = tro.ca_idtrafico::text
   LEFT JOIN tb_ciudades cid ON exm.ca_destino::text = cid.ca_idciudad::text
   LEFT JOIN tb_clientes ccl ON exm.ca_idcliente = ccl.ca_idcliente
ORDER BY ca_ano, ca_mes, rpt.ca_sucursal, exm.ca_referencia, exm.ca_fchreferencia, exm.ca_fchcreado, exm.ca_idcliente, tro.ca_nombre, cid.ca_ciudad,
CASE
    WHEN exm.ca_via::text = 'Aereo'::text THEN 'Aéreo'::character varying
    ELSE
    CASE
        WHEN exm.ca_via::text = 'Maritimo'::text THEN 'Marítimo'::character varying
        ELSE exm.ca_via
    END
END, exm.ca_modalidad, exm.ca_consecutivo, ccl.ca_compania, exm.ca_aplicaidg, sia.ca_nombre, 14, rpt.ca_version;
ALTER TABLE vi_repindicador_exp OWNER TO postgres;
GRANT ALL ON TABLE vi_repindicador_exp TO postgres;
GRANT ALL ON TABLE vi_repindicador_exp TO "Administrador";
GRANT ALL ON TABLE vi_repindicador_exp TO "Usuarios";


// Drop view vi_cotizaciones;
Create view vi_cotizaciones as
Select z.ca_idcotizacion, cl.ca_idcliente, cl.ca_digito, cl.ca_compania, cl.ca_saludo as ca_saludo_cl, cl.ca_nombres ||' '|| cl.ca_papellido ||' '|| cl.ca_sapellido as ca_ncompleto_cl, cl.ca_direccion as ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_localidad, cl.ca_complemento,
       cl.ca_telefonos as ca_telefonos_cl, cl.ca_fax as ca_fax_cl, cl.ca_vendedor, cl.ca_idciudad, cd.ca_ciudad, cl.ca_preferencias, cl.ca_confirmar, lc.ca_cupo, lc.ca_diascredito, z.ca_idcontacto, cn.ca_papellido, cn.ca_sapellido, cn.ca_nombres, cn.ca_nombres ||' '|| cn.ca_papellido ||' '|| cn.ca_sapellido as ca_ncompleto_cn, cn.ca_saludo as ca_saludo_cn,
       cn.ca_cargo, cn.ca_departamento, cn.ca_telefonos, cn.ca_fax, cn.ca_email, z.ca_fchcotizacion, z.ca_fchpresentacion, z.ca_fchsolicitud, z.ca_horasolicitud, z.ca_asunto, z.ca_saludo, z.ca_entrada, z.ca_despedida, z.ca_anexos, z.ca_usuario, z.ca_fchcreado, z.ca_usucreado, z.ca_fchactualizado, z.ca_usuactualizado
       from tb_cotizaciones z
       INNER JOIN tb_concliente cn ON (cn.ca_idcontacto = z.ca_idcontacto)
       INNER JOIN tb_clientes cl ON (cl.ca_idcliente = cn.ca_idcliente)
       LEFT OUTER JOIN tb_libcliente lc ON (lc.ca_idcliente = cl.ca_idcliente)
       INNER JOIN tb_ciudades cd ON (cd.ca_idciudad = cl.ca_idciudad)
       order by z.ca_idcotizacion DESC;
REVOKE ALL ON vi_cotizaciones FROM PUBLIC;
GRANT ALL ON vi_cotizaciones TO "Administrador";
GRANT ALL ON vi_cotizaciones TO GROUP "Usuarios";


// Drop view vi_cotproductos;
Create view vi_cotproductos as
Select p.ca_idcotizacion, p.ca_idproducto, p.ca_producto, p.ca_impoexpo, p.ca_transporte, p.ca_modalidad, p.ca_incoterms, p.ca_origen as ca_idorigen, c1.ca_ciudad as ca_ciuorigen, c1.ca_idtrafico as ca_idtraorigen, t1.ca_nombre as ca_traorigen, p.ca_destino as ca_iddestino, c2.ca_ciudad as ca_ciudestino, c2.ca_idtrafico as ca_idtradestino,
       t2.ca_nombre as ca_tradestino, p.ca_frecuencia, p.ca_tiempotransito, p.ca_locrecargos, p.ca_observaciones, p.ca_imprimir, p.ca_fchcreado, p.ca_usucreado, p.ca_fchactualizado, p.ca_usuactualizado, p.ca_datosag, (select * from fun_contactos(p.ca_datosag)) as ca_nombresag
       from tb_cotproductos p, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2 where p.ca_origen = c1.ca_idciudad and p.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico
	   and c2.ca_idtrafico = t2.ca_idtrafico order by ca_idcotizacion, p.ca_transporte, p.ca_modalidad, t1.ca_nombre, c1.ca_ciudad, c2.ca_ciudad;
REVOKE ALL ON vi_cotproductos FROM PUBLIC;
GRANT ALL ON vi_cotproductos TO "Administrador";
GRANT ALL ON vi_cotproductos TO GROUP "Usuarios";


// Drop view vi_cotopciones;
Create view vi_cotopciones as
Select o.ca_idcotizacion, o.ca_idproducto, o.ca_idopcion, o.ca_idconcepto, c.ca_concepto, o.ca_idmoneda, o.ca_tarifa, o.ca_oferta, o.ca_recargos, o.ca_observaciones, o.ca_fchcreado, o.ca_usucreado, o.ca_fchactualizado, o.ca_usuactualizado
       from tb_cotopciones o, tb_conceptos c where o.ca_idconcepto = c.ca_idconcepto order by ca_idcotizacion, ca_idproducto, ca_liminferior, ca_concepto;
REVOKE ALL ON vi_cotopciones FROM PUBLIC;
GRANT ALL ON vi_cotopciones TO "Administrador";
GRANT ALL ON vi_cotopciones TO GROUP "Usuarios";


// Drop view vi_cotrecargos;
Create view vi_cotrecargos as
Select cr.oid as ca_oid, cr.ca_idcotizacion, cr.ca_idproducto, cr.ca_idopcion, cr.ca_idconcepto, cr.ca_idrecargo, tr.ca_recargo, tr.ca_tipo as ca_generado, cr.ca_tipo, cr.ca_valor_tar, cr.ca_aplica_tar, cr.ca_valor_min, cr.ca_aplica_min,
       cr.ca_idmoneda, cr.ca_modalidad, cr.ca_observaciones, tr.ca_transporte, cr.ca_fchcreado, cr.ca_usucreado, cr.ca_fchactualizado, cr.ca_usuactualizado
	   from tb_cotrecargos cr, tb_tiporecargo tr where cr.ca_idrecargo = tr.ca_idrecargo order by tr.ca_transporte, cr.ca_modalidad, tr.ca_recargo;
REVOKE ALL ON vi_cotrecargos FROM PUBLIC;
GRANT ALL ON vi_cotrecargos TO "Administrador";
GRANT ALL ON vi_cotrecargos TO GROUP "Usuarios";



// Drop view vi_cotcontinuacion;
Create view vi_cotcontinuacion as
Select c.oid as ca_oid, c.ca_idcotizacion, c.ca_tipo, c.ca_modalidad, c.ca_origen as ca_idorigen, c1.ca_ciudad as ca_ciuorigen, c.ca_destino as ca_iddestino, c2.ca_ciudad as ca_ciudestino, c.ca_idconcepto, cn1.ca_concepto, c.ca_idequipo, cn2.ca_concepto as ca_equipo, c.ca_idmoneda, c.ca_tarifa, c.ca_frecuencia, c.ca_tiempotransito, c.ca_observaciones, c.ca_fchcreado, c.ca_usucreado, c.ca_fchactualizado, c.ca_usuactualizado
       from tb_cotcontinuacion c LEFT OUTER JOIN tb_conceptos cn2 ON (c.ca_idequipo = cn2.ca_idconcepto), tb_ciudades c1, tb_ciudades c2, tb_conceptos cn1 where c.ca_origen = c1.ca_idciudad and c.ca_destino = c2.ca_idciudad and c.ca_idconcepto = cn1.ca_idconcepto order by ca_idcotizacion, ca_origen, ca_destino, ca_idequipo, ca_idconcepto;
REVOKE ALL ON vi_cotcontinuacion FROM PUBLIC;
GRANT ALL ON vi_cotcontinuacion TO "Administrador";
GRANT ALL ON vi_cotcontinuacion TO GROUP "Usuarios";


// Drop view vi_bodegas;
Create view vi_bodegas as
Select b.ca_idbodega, b.ca_nombre, b.ca_tipo, b.ca_transporte
       from tb_bodegas b order by ca_transporte, ca_tipo, ca_nombre;
REVOKE ALL ON vi_bodegas FROM PUBLIC;
GRANT ALL ON vi_bodegas TO "Administrador";
GRANT ALL ON vi_bodegas TO GROUP "Usuarios";


// Drop view vi_emails;
Create view vi_emails as
Select e.ca_idemail, e.ca_fchenvio, e.ca_usuenvio, u.ca_nombre, u.ca_email, e.ca_tipo, e.ca_idcaso, e.ca_from, e.ca_fromname, e.ca_cc, e.ca_replyto, e.ca_address, e.ca_attachment, e.ca_subject, e.ca_body
       from tb_emails e, control.tb_usuarios u where e.ca_usuenvio = u.ca_login order by e.ca_fchenvio desc;
REVOKE ALL ON vi_emails FROM PUBLIC;
GRANT ALL ON vi_emails TO "Administrador";
GRANT ALL ON vi_emails TO GROUP "Usuarios";


// Drop function fn_idagente(varchar,varchar);
Create function fn_idagente(varchar,varchar) RETURNS integer AS '
select cast(400||substr(t.ca_idtrafico,4,3)||substr(1000+nextval(quote_ident($1)),2,3) as integer) from tb_ciudades c, tb_traficos t where c.ca_idtrafico = t.ca_idtrafico and c.ca_idciudad = $2;
' LANGUAGE SQL;

// Consulta para exportar tarifas
select * from vi_fletes, vi_trayectos where vi_fletes.ca_idtrayecto = vi_trayectos.ca_idtrayecto and ca_transporte = 'Marítimo' and ca_impoexpo = 'Importación'



CREATE OR REPLACE FUNCTION fun_subqueries(TEXT,TEXT,TEXT) RETURNS TEXT AS '
DECLARE
    v_table ALIAS FOR $1;
    v_fields ALIAS FOR $2;
    v_conditions ALIAS FOR $3;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_fields text[];
    a_field text;
    a_output text;

BEGIN
    a_fields = string_to_array(v_fields,\',\');
    a_output := \'\';
    FOR referrer_keys IN EXECUTE  ''select '' || v_fields || '' from '' || v_table
    LOOP
        FOR i IN array_lower(a_fields, 1)..array_upper(a_fields, 1)
        LOOP
            a_field := a_fields[i]::TEXT;
            a_output:= a_output || EXECUTE quote_ident(referrer_keys.a_field) || \',\';
        END LOOP;
    END LOOP;
    return a_output;
END;
' LANGUAGE 'plpgsql';

select fun_subqueries('tb_monedas','ca_idmoneda, ca_nombre','');


CREATE OR REPLACE FUNCTION fun_subqueries(TEXT,TEXT,TEXT) RETURNS TEXT AS '
DECLARE
    v_table ALIAS FOR $1;
    v_fields ALIAS FOR $2;
    v_where ALIAS FOR $3;
    cursor_ refcursor;
	v_conditions text = \'\';
	v_aux text;
	a_salida text[];
	i integer = 0;
	
BEGIN
	IF length(v_where) > 0  THEN
		v_conditions:= '' where '' || v_where;
	END IF;
	OPEN cursor_ FOR EXECUTE  ''select DISTINCT '' || v_fields || '' from '' || v_table || v_conditions;
	LOOP
		FETCH cursor_ INTO v_aux;
		EXIT WHEN NOT FOUND;
        a_salida[i]:= v_aux;
		i:= i + 1;
	END LOOP;
	return array_to_string(a_salida,\'|\');
END;
' LANGUAGE 'plpgsql';

select fun_subqueries('tb_inoclientes_sea ic, vi_inomaestra_sea im','ca_traorigen','im.ca_ano = 7 and ic.ca_referencia = im.ca_referencia and ic.ca_idcliente = 800024075');


CREATE OR REPLACE FUNCTION fun_concatenate(TEXT,TEXT,TEXT) RETURNS TEXT AS '
DECLARE
    v_table ALIAS FOR $1;
    v_fields ALIAS FOR $2;
    v_where ALIAS FOR $3;
    cursor_ refcursor;
	v_conditions text = \'\';
	v_aux text;
	a_salida text[];
	i integer = 0;
	
BEGIN 
	IF length(v_where) > 0  THEN
		v_conditions:= '' where '' || v_where;
	END IF;
	OPEN cursor_ FOR EXECUTE  ''select '' || v_fields || '' from '' || v_table || v_conditions;
	LOOP
		FETCH cursor_ INTO v_aux;
		EXIT WHEN NOT FOUND;
        a_salida[i]:= v_aux;
		i:= i + 1;
	END LOOP;
	return array_to_string(a_salida,\'|\');
END;
' LANGUAGE 'plpgsql';

select fun_concatenate('tb_monedas','ca_idmoneda','');
select fun_concatenate('tb_monedas','ca_idmoneda','ca_idmoneda = \'COP\'');


            a_value := EVALUATE ''referrer_keys.var_resultado'' || a_field;


CREATE OR REPLACE FUNCTION fun_contactos(TEXT) RETURNS TEXT AS '
DECLARE
    v_string ALIAS FOR $1;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_output text;

BEGIN
    a_output := \'\';
    FOR referrer_keys IN select ca_nombre from vi_contactos where ca_idcontacto = ANY (string_to_array($1,\'|\')) LOOP
        a_output := a_output || referrer_keys.ca_nombre || \'|\';
    END LOOP;
    RETURN a_output;

END;
' LANGUAGE 'plpgsql';


CREATE OR REPLACE  FUNCTION fun_conceptos(TEXT) RETURNS TEXT AS '
DECLARE
    v_string ALIAS FOR $1;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_output varchar(4000);

BEGIN
    a_output := \'\';
    FOR referrer_keys IN select ca_concepto from vi_conceptos where ca_idconcepto = ANY (string_to_array($1,\'|\')) LOOP
        a_output := a_output || referrer_keys.ca_concepto || \'|\';
    END LOOP;
    RETURN a_output;

END;
' LANGUAGE 'plpgsql';



 ------>>>>> RUTINAS DE MANTENIMIENTO <<<<<--------------

-- Script para crear formato en la importación de tarifas LO --
insert into tb_tblgastos values (9999,'Tarifas Lejano Oriente','99-999','-','-','-');

insert into tb_columnas values (9999,9987,'ORIGIN','','Caracter',50,'Información');
insert into tb_columnas values (9999,9988,'PLACE OF DELIVERY','','Caracter',50,'Información');
insert into tb_columnas values (9999,9989,'CARRIER','','Caracter',20,'Información');
insert into tb_columnas values (9999,9990,'FILING','','Caracter',50,'Información');
insert into tb_columnas values (9999,9991,'ST20','','Caracter',6,'Valor');
insert into tb_columnas values (9999,9992,'ST40','','Caracter',6,'Valor');
insert into tb_columnas values (9999,9993,'HQ','','Caracter',6,'Valor');
insert into tb_columnas values (9999,9994,'NOR','','Caracter',6,'Valor');
insert into tb_columnas values (9999,9995,'CSF','','Caracter',6,'Valor');
insert into tb_columnas values (9999,9996,'SURCHARGES','','Caracter',50,'Información');
insert into tb_columnas values (9999,9997,'REMARKS','','Caracter',50,'Información');
insert into tb_columnas values (9999,9998,'EFFECTIVE','dd-mm-yyyy','Fecha',10,'Información');
insert into tb_columnas values (9999,9999,'EXPIRY','dd-mm-yyyy','Fecha',10,'Información');


// ================== Tabla de Parámetros Generales del Sistema  ================== //

CREATE TABLE tb_parametros
(
  ca_casouso varchar(20) NOT NULL,
  ca_identificacion int2 NOT NULL,
  ca_valor varchar(255),
  CONSTRAINT "tb_parametros_PK" PRIMARY KEY (ca_casouso, ca_identificacion, ca_valor)
)
WITH OIDS;
REVOKE ALL ON tb_parametros FROM PUBLIC;
GRANT ALL ON TABLE tb_parametros TO "Administrador";
GRANT ALL ON TABLE tb_parametros TO GROUP "Usuarios";


insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',05,'DE-049');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'AR-054');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',45,'BE-032');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',35,'BR-055');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',10,'CA-001');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',55,'CL-056');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',50,'CN-086');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',50,'KR-082');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'CR-506');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'EC-593');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',15,'ES-034');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',10,'US-001');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',30,'FR-033');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',60,'NL-031');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',50,'HK-852');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'IN-091');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'ID-062');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'GB-044');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'IE-353');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'IL-972');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',25,'IT-039');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'JP-081');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'MY-060');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',40,'MX-052');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'PK-092');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'PA-507');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'PE-051');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'SG-065');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',50,'TW-088');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'TH-066');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'TR-090');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'UY-598');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'VE-058');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'VN-084');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',00,'CTG-0005');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',10,'BAQ-0005');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',20,'BUN-0002');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU010',30,'STA-0005');


insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',1,'Solicitud de Clasificación Arancelaria');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',2,'Clasificación Recibida');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',3,'Solicitud de Anticipo');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',4,'Recibo de Anticipo');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',5,'Solicitud de Preinspección');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',6,'Recibo de Preinspección');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',7,'Apertura de Digitación');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',8,'Cierre de Digitación');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',9,'Apertura de Revisión');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',10,'Cierre de Revisión');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',11,'Pago en Bancos');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',12,'Levante de Mercancia');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',13,'Entrega de Mercancia');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',14,'Despacho de Mercancia');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',15,'Entrega a Facturación');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',16,'Elaboración de Factura');
insert into tb_parametros (ca_casouso, ca_identificacion, ca_valor) values ('CU037',17,'Recibo de Factura');


insert into tb_festivos values('2006-01-01');
insert into tb_festivos values('2006-01-09');
insert into tb_festivos values('2006-03-20');
insert into tb_festivos values('2006-04-13');
insert into tb_festivos values('2006-04-14');
insert into tb_festivos values('2006-05-01');
insert into tb_festivos values('2006-05-29');
insert into tb_festivos values('2006-06-19');
insert into tb_festivos values('2006-06-26');
insert into tb_festivos values('2006-07-03');
insert into tb_festivos values('2006-07-20');
insert into tb_festivos values('2006-08-07');
insert into tb_festivos values('2006-08-21');
insert into tb_festivos values('2006-10-16');
insert into tb_festivos values('2006-11-06');
insert into tb_festivos values('2006-11-13');
insert into tb_festivos values('2006-12-08');
insert into tb_festivos values('2006-12-25');

insert into tb_festivos values('2007-01-01');
insert into tb_festivos values('2007-01-08');
insert into tb_festivos values('2007-03-19');
insert into tb_festivos values('2007-04-05');
insert into tb_festivos values('2007-04-06');
insert into tb_festivos values('2007-05-01');
insert into tb_festivos values('2007-05-21');
insert into tb_festivos values('2007-06-11');
insert into tb_festivos values('2007-06-18');
insert into tb_festivos values('2007-07-02');
insert into tb_festivos values('2007-07-20');
insert into tb_festivos values('2007-08-07');
insert into tb_festivos values('2007-08-20');
insert into tb_festivos values('2007-10-15');
insert into tb_festivos values('2007-11-05');
insert into tb_festivos values('2007-11-12');
insert into tb_festivos values('2007-12-08');
insert into tb_festivos values('2007-12-25');


CREATE OR REPLACE FUNCTION fun_referencia(TEXT,TEXT,TEXT,TEXT,TEXT) RETURNS TEXT AS
$BODY$
DECLARE
    v_departamento ALIAS FOR $1;
    v_modalidad ALIAS FOR $2;
    v_origen ALIAS FOR $3;
    v_destino ALIAS FOR $4;
    v_mes ALIAS FOR $5;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_referencia text[];
    a_output text;
    a_mes text[];
DECLARE
    registro RECORD;

BEGIN
    a_mes:= string_to_array(v_mes,'-');
    IF v_departamento = 'Marítimo' THEN
	    select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_destino;
        IF v_modalidad = 'FCL' THEN
            IF NOT FOUND THEN
                a_output:= '430.';
            ELSE
                a_output = text(400+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'LCL' OR v_modalidad = 'COLOADING' THEN
            IF NOT FOUND THEN
                a_output:= '530.';
            ELSE
                a_output:= text(500+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'PROYECTOS' THEN
            IF NOT FOUND THEN
                a_output:= '630.';
            ELSE
                a_output:= text(600+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'PARTICULARES' THEN
            IF NOT FOUND THEN
                a_output:= '830.';
            ELSE
                a_output:= text(800+registro.ca_identificacion) || '.';
            END IF;
        END IF;

        select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_origen;
        IF NOT FOUND THEN
            a_output:= a_output || '20.';
        ELSE
            a_output:= a_output || substr(text(100+registro.ca_identificacion),2,2) || '.';
        END IF;
	ELSIF v_departamento = 'Terrestre' THEN
	    select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_origen;
		IF NOT FOUND THEN
			a_output:= '700.';
		ELSE
			a_output = text(700+registro.ca_identificacion) || '.';
		END IF;

        IF v_modalidad = 'FCL' THEN
            a_output:= a_output || '40.';
        ELSIF v_modalidad = 'LCL' THEN
            a_output:= a_output || '50.';
        ELSE
            a_output:= a_output || '00.';
        END IF;

    END IF;
    a_output:= a_output || a_mes[1] || '.%.' || a_mes[2];

	select into registro max(ca_referencia) as ca_referencia from tb_inomaestra_sea where ca_referencia like a_output;
	IF registro.ca_referencia IS NULL THEN
		a_referencia:= string_to_array(a_output,'.');
		a_referencia[4]:= '001';
	ELSE
		a_referencia:= string_to_array(registro.ca_referencia,'.');
		a_referencia[4]:= substr(text(1001 +int2(a_referencia[4])),2,3);
	END IF;
	a_output:= array_to_string(a_referencia,'.');

    RETURN a_output;
END;
$BODY$
LANGUAGE 'plpgsql';

select fun_referencia('Marítimo','FCL','DE-049','BUN-0002','01-6');


-- Function: fun_reportecon(text)
-- DROP FUNCTION fun_reportecon(text);
CREATE OR REPLACE FUNCTION fun_reportecon(text) RETURNS text AS
$BODY$
DECLARE
  v_string ALIAS FOR $1;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_output text;
    a_actual text[];

BEGIN
  a_output:= '1-' || $1;

    FOR referrer_keys IN select ca_consecutivo from tb_reportes where ca_consecutivo like '%-'||v_string and EXTRACT ('year' from ca_fchreporte) = EXTRACT ('year' from to_timestamp(v_string,'YYYY')) order by to_number(ca_consecutivo,'99999"-"9999')  DESC limit 1 LOOP
    IF NOT nullvalue(referrer_keys.ca_consecutivo) THEN
        a_actual:= string_to_array(referrer_keys.ca_consecutivo,'-');
        a_actual[1] := to_char(to_number(a_actual[1],'FM999999MI') + 1,'FM999999MI');
        a_output:= array_to_string(a_actual,'-');
    END IF;
    END LOOP;   
  RETURN a_output;
END; 
$BODY$
LANGUAGE 'plpgsql' VOLATILE;
ALTER FUNCTION fun_reportecon(text) OWNER TO postgres;

select fun_reportecon(2006);


-- Function: fun_cotizacioncon(text)
-- DROP FUNCTION fun_cotizacioncon(text);
CREATE OR REPLACE FUNCTION fun_cotizacioncon(text) RETURNS text AS
$BODY$
DECLARE
  v_string ALIAS FOR $1;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_output text;
    a_actual text[];

BEGIN
  a_output:= '1-' || $1;
    FOR referrer_keys IN select ca_consecutivo from tb_cotizaciones where EXTRACT ('year' from ca_fchcotizacion) = EXTRACT ('year' from to_timestamp($1,'YYYY')) order by to_number(ca_consecutivo,'99999"-"9999')  DESC limit 1 LOOP
    IF NOT nullvalue(referrer_keys.ca_consecutivo) THEN
        a_actual:= string_to_array(referrer_keys.ca_consecutivo,'-');
        a_actual[1] := to_char(to_number(a_actual[1],'FM999999MI') + 1,'FM999999MI');
        a_output:= array_to_string(a_actual,'-');
    END IF;
    END LOOP;   
  RETURN a_output;
END; 
$BODY$
LANGUAGE 'plpgsql' VOLATILE;
ALTER FUNCTION fun_cotizacioncon(text) OWNER TO postgres;

select fun_cotizacioncon(2008);
alter table tb_cotizaciones add column ca_consecutivo character varying(10) NOT NULL default ''
update tb_cotizaciones set ca_consecutivo = ca_idcotizacion||'-'||EXTRACT ('year' from ca_fchcotizacion)


CREATE OR REPLACE FUNCTION fun_reportever(TEXT) RETURNS INT AS
$BODY$
DECLARE
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_output int;

BEGIN
  a_output:= 1;
    FOR referrer_keys IN select ca_version from tb_reportes where ca_consecutivo = $1 LOOP
    IF NOT nullvalue(referrer_keys.ca_version) THEN
        a_output:= referrer_keys.ca_version::int + 1;
    END IF;
    END LOOP;
  RETURN a_output;
END;
$BODY$
LANGUAGE 'plpgsql';

select fun_reportever('4570-2008');


CREATE OR REPLACE FUNCTION fun_texttokencompare(TEXT,TEXT,TEXT) RETURNS BOOLEAN AS
$BODY$
DECLARE
    v_cadena_1 ALIAS FOR $1;
    v_cadena_2 ALIAS FOR $2;
    v_token ALIAS FOR $3;
    a_cadena_1 text[];
    a_cadena_2 text[];

BEGIN
    a_cadena_1 = string_to_array(v_cadena_1, v_token);
    a_cadena_2 = string_to_array(v_cadena_2, v_token);
	FOR i IN array_lower(a_cadena_2, 1)..array_upper(a_cadena_2, 1)
	LOOP
		FOR j IN array_lower(a_cadena_1, 1)..array_upper(a_cadena_1, 1)
		LOOP
			IF texteq(a_cadena_1[j], a_cadena_2[i]) THEN
				return true;
			END IF;
		END LOOP;
	END LOOP;

    return false;
END;
$BODY$
LANGUAGE 'plpgsql';


select fun_texttokencompare('FOB|CIF|FCA','EXW|FCA','|');

select fun_texttokencompare('EXW|FCA','FOB|CIF|FCA','|');


CREATE OR REPLACE FUNCTION fun_similarpercent(TEXT,TEXT) RETURNS INTEGER AS
$BODY$
DECLARE
	p_cadena_1 ALIAS FOR $1;
	p_cadena_2 ALIAS FOR $2;
	v_cadena_1 text;
	v_cadena_2 text;
	a_cadena_1 text[];
	v_count int;
	v_posini int;
	v_posfin int;
BEGIN
	v_count = 0;
	v_cadena_1 = lower(replace(p_cadena_1,' ','')); -- cadena larga sin espacios
	v_cadena_2 = lower(p_cadena_2); -- cadena corta
	IF char_length(p_cadena_1) < char_length(p_cadena_2) THEN
		v_cadena_1 = lower(replace(p_cadena_2,' ',''));
		v_cadena_2 = lower(p_cadena_1);
	END IF;

	v_cadena_1 = trim(translate(v_cadena_1,'áéíóúñ-./','aeioun'));
	v_cadena_2 = trim(translate(v_cadena_2,'áéíóúñ-./','aeioun'));

	IF nullvalue(v_cadena_1) or char_length(trim(v_cadena_1))=0 or nullvalue(v_cadena_2) or char_length(trim(v_cadena_2))=0 THEN
		return null;
	END IF;

	a_cadena_1 = string_to_array(v_cadena_2, ' ');
	v_posini = 1;
	FOR i IN array_lower(a_cadena_1, 1)..array_upper(a_cadena_1, 1)
	LOOP
		IF (v_cadena_1 ~ '^([0-9])*$') and (a_cadena_1[i] ~ '^([0-9])*$') THEN
			v_posfin = char_length(a_cadena_1[i]);
			FOR x IN 1..v_posfin
			LOOP
				FOR y IN v_posini..char_length(v_cadena_1)
				LOOP
					IF texteq(substr(a_cadena_1[i], x , 1), substr(v_cadena_1, y , 1)) THEN
						v_posini = y + 1;
						v_count = v_count + 1;
						EXIT;
					END IF;
				END LOOP;
			END LOOP;
			-- RAISE NOTICE 'Por Numeros %', v_count;
		ELSIF strpos(v_cadena_1,a_cadena_1[i]) = 0 THEN
			v_posfin = char_length(a_cadena_1[i]);
			FOR x IN v_posfin..1
			LOOP
				FOR y IN v_posini..char_length(v_cadena_1)
				LOOP
					IF strpos(v_cadena_1, substr(a_cadena_1[i], 1, x)) != 0 THEN
						v_posini= strpos(v_cadena_1, substr(a_cadena_1[i], 1, x)) + x;
						v_count = v_count + x;
						EXIT;
					END IF;
				END LOOP;
			END LOOP;
			-- RAISE NOTICE 'Por Subpalabras %', v_count;
		ELSE
			v_posini= strpos(v_cadena_1,a_cadena_1[i]) + char_length(a_cadena_1[i]);
			v_count = v_count + char_length(a_cadena_1[i]);
			-- RAISE NOTICE 'Palabra Completa %', v_count;
		END IF;
	END LOOP;

	-- RAISE NOTICE 'Valores % %', v_count, char_length(replace(v_cadena_2,' ',''));
	return 100*v_count/char_length(replace(v_cadena_2,' ',''));
END;
$BODY$
LANGUAGE 'plpgsql';



CREATE OR REPLACE FUNCTION fun_updatecomm(INTEGER) RETURNS INTEGER AS
$BODY$
DECLARE
	v_string ALIAS FOR $1;
	referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
	a_output integer;

BEGIN
	a_output:= 0;
	FOR referrer_keys IN select r.ca_idreporte from tb_repavisos a, tb_reportes p LEFT OUTER JOIN (select max(ca_idreporte) as ca_idreporte, ca_consecutivo from tb_reportes group by ca_consecutivo) r ON (p.ca_consecutivo = r.ca_consecutivo)
		where a.ca_idreporte = p.ca_idreporte and a.ca_idreporte = $1 LOOP
		IF NOT nullvalue(referrer_keys.ca_idreporte) THEN
			a_output = referrer_keys.ca_idreporte;
		END IF;
	END LOOP;
	RETURN a_output;
END;
$BODY$
LANGUAGE 'plpgsql';

select fun_updatecomm(9072);


CREATE OR REPLACE FUNCTION fun_confirmarcli(INTEGER, TEXT, TEXT) RETURNS BOOLEAN AS $$
DECLARE
	var_idcontacto ALIAS FOR $1;
	var_confirmar ALIAS FOR $2;
	var_usuario ALIAS FOR $3;
	var_result BOOLEAN = FALSE;

	referrer_keys RECORD;  -- Declare a generic record to be used in a FOR

BEGIN
	FOR referrer_keys IN select ca_idcliente, ca_confirmar from tb_clientes 
		where ca_idcliente = (select ca_idcliente from tb_concliente where ca_idcontacto = var_idcontacto) LOOP
		IF nullvalue(referrer_keys.ca_confirmar) OR referrer_keys.ca_confirmar != var_confirmar THEN
			update tb_clientes set ca_confirmar = var_confirmar, ca_usuactualizado = var_usuario, ca_fchactualizado = to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss')
				where ca_idcliente = referrer_keys.ca_idcliente;
			var_result = TRUE;
		END IF;
	END LOOP;
	return var_result;
END;
$$ LANGUAGE 'plpgsql';



DROP TRIGGER actualiza_clientes ON tb_clientes CASCADE;
DROP TRIGGER adicion_inomaestra_sea ON tb_inoclientes_sea CASCADE;
DROP TRIGGER adicion_inomaestra_air ON tb_inoclientes_air CASCADE;
DROP TRIGGER adicion_inomaestra_exp ON tb_expo_maestra CASCADE;
DROP TRIGGER adicion_inomaestra_brk ON tb_brk_ingresos CASCADE;

-- Function: fun_stdcliente_tri()

-- DROP FUNCTION fun_stdcliente_tri();

CREATE OR REPLACE FUNCTION fun_stdcliente_tri()
  RETURNS trigger AS
$BODY$
DECLARE
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    referrer_refs RECORD;  -- Declare a generic record to be used in a FOR
    v_estado1 text:= '';
    v_estado2 text:= '';
    v_idcliente integer;

BEGIN
    IF (NOT nullvalue(TG_ARGV[0])) THEN
        NEW.ca_idcliente = TG_ARGV[0];
    END IF;

    IF (TG_RELNAME = 'tb_brk_ingresos') THEN
        FOR referrer_refs IN select ima.ca_idcliente from tb_brk_maestra ima where ima.ca_referencia = NEW.ca_referencia LOOP
            IF NOT nullvalue(referrer_refs.ca_idcliente) THEN
                v_idcliente = referrer_refs.ca_idcliente;
            END IF;
        END LOOP;
    ELSE
        v_idcliente = NEW.ca_idcliente;
    END IF;


    IF (TG_RELNAME = 'tb_clientes') THEN
        IF (TG_OP = 'INSERT') THEN
            INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Potencial', 'Coltrans');
            INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Potencial', 'Colmas');
        ELSIF (TG_OP = 'UPDATE' AND NEW.ca_status != OLD.ca_status AND NEW.ca_status != '') THEN
            INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), NEW.ca_status, 'Coltrans');
            INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), NEW.ca_status, 'Colmas');
        END IF;
    ELSE
        FOR referrer_keys IN select vc.ca_idcliente, vc.ca_coltrans_std, vc.ca_colmas_std from vi_clientes vc where vc.ca_idcliente = v_idcliente LOOP
            IF NOT nullvalue(referrer_keys.ca_coltrans_std) AND NOT nullvalue(referrer_keys.ca_colmas_std) THEN
                v_estado1 = referrer_keys.ca_coltrans_std;
                v_estado2 = referrer_keys.ca_colmas_std;
            END IF;
        END LOOP;

        FOR referrer_keys IN select * from vi_stdcliente where ca_idcliente = v_idcliente LOOP
            IF (TG_RELNAME = 'tb_inoclientes_sea' OR TG_RELNAME = 'tb_inoclientes_air') THEN
                IF (referrer_keys.ca_cantidad_sea + referrer_keys.ca_cantidad_air) = 0 THEN
                    IF v_estado1 != 'Potencial' THEN
                        INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Potencial', 'Coltrans');
                    END IF;
                ELSIF (referrer_keys.ca_ultimos_sea + referrer_keys.ca_ultimos_air) > 0 THEN
                    IF v_estado1 = 'Potencial' THEN
                        INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Activo', 'Coltrans');
                    END IF;
                END IF;
            ELSIF (TG_RELNAME = 'tb_expo_ingresos' OR TG_RELNAME = 'tb_brk_ingresos') THEN
                IF (referrer_keys.ca_cantidad_exp + referrer_keys.ca_cantidad_brk) = 0 THEN
                    IF v_estado2 != 'Potencial' THEN
                        INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Potencial', 'Colmas');
                    END IF;
                ELSIF (referrer_keys.ca_ultimos_exp + referrer_keys.ca_ultimos_brk) > 0 THEN
                    IF v_estado2 = 'Potencial' THEN
                        INSERT INTO tb_stdcliente VALUES (v_idcliente, to_timestamp(to_char(current_timestamp,'YYYY-MM-DD hh:mi:ss'),'YYYY-MM-DD hh:mi:ss'), 'Activo', 'Colmas');
                    END IF;
                END IF;
            END IF;
            UPDATE tb_clientes SET ca_status = '' WHERE ca_idcliente = v_idcliente;
        END LOOP;
    END IF;
    RETURN NULL;
END;
$BODY$
  LANGUAGE 'plpgsql' VOLATILE
  COST 100;
ALTER FUNCTION fun_stdcliente_tri() OWNER TO postgres;
GRANT EXECUTE ON FUNCTION fun_stdcliente_tri() TO postgres;
GRANT EXECUTE ON FUNCTION fun_stdcliente_tri() TO public;
GRANT EXECUTE ON FUNCTION fun_stdcliente_tri() TO "Usuarios";


CREATE TRIGGER actualiza_clientes
	AFTER INSERT OR UPDATE ON tb_clientes
	FOR EACH ROW
EXECUTE PROCEDURE fun_stdcliente_tri();

CREATE TRIGGER adicion_inomaestra_sea
	AFTER INSERT ON tb_inoclientes_sea
	FOR EACH ROW
EXECUTE PROCEDURE fun_stdcliente_tri();

CREATE TRIGGER adicion_inomaestra_air
	AFTER INSERT ON tb_inoclientes_air
	FOR EACH ROW
EXECUTE PROCEDURE fun_stdcliente_tri();

CREATE TRIGGER adicion_inomaestra_exp
	AFTER INSERT ON tb_expo_ingresos
	FOR EACH ROW
EXECUTE PROCEDURE fun_stdcliente_tri();

CREATE TRIGGER adicion_inomaestra_brk
	AFTER INSERT ON tb_brk_ingresos
	FOR EACH ROW
EXECUTE PROCEDURE fun_stdcliente_tri();


select ca_idcliente, max(ca_fchestado) from tb_stdcliente 
	where ca_estado = 'Perdido'
	group by ca_idcliente

================================ CONTROL DE AUDITORÍA ================================
insert into tb_parametros values ('CU044',1,'ca_idtrayecto, ca_idconcepto, ca_vlrneto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda, ca_fchinicio, ca_fchvencimiento, ca_sugerida, ca_mantenimiento');
insert into tb_parametros values ('CU044',2,'ca_idtrayecto, ca_idconcepto, ca_idrecargo, ca_aplicacion, ca_fchinicio, ca_fchvencimiento, ca_vlrfijo, ca_porcentaje, ca_baseporcentaje, ca_vlrunitario, ca_baseunitario, ca_recargominimo, ca_idmoneda');
insert into tb_parametros values ('CU044',3,'ca_idtrafico, ca_idciudad, ca_idrecargo, ca_modalidad, ca_impoexpo, ca_aplicacion, ca_fchinicio, ca_fchvencimiento, ca_vlrfijo, ca_porcentaje, ca_baseporcentaje, ca_vlrunitario, ca_baseunitario, ca_recargominimo, ca_idmoneda');

/* Generador de Id para la tabla tb_emails */;

create sequence tb_bitacora_id
minvalue          1
maxvalue 2147483647
increment         1
start             1;
REVOKE ALL ON tb_bitacora_id FROM PUBLIC;
GRANT ALL ON tb_bitacora_id TO "Administrador";
GRANT ALL ON tb_bitacora_id TO GROUP "Usuarios";


DROP TABLE tb_bitacora_audit;
CREATE TABLE tb_bitacora_audit( 
    ca_idoperation integer DEFAULT nextval('tb_bitacora_id') UNIQUE NOT NULL,
    ca_operation         char(1)   NOT NULL,
    ca_stamp             timestamp NOT NULL,
    ca_userid            text      NOT NULL,
	ca_table             varchar(50) NOT NULL,
	ca_record            smallint  NOT NULL,
    ca_content           text[]    NOT NULL,
    constraint pk_tb_bitacora_audit PRIMARY KEY (ca_table, ca_idoperation)
);
REVOKE ALL ON tb_bitacora_audit FROM PUBLIC;
GRANT ALL ON tb_bitacora_audit TO "Administrador";
GRANT ALL ON tb_bitacora_audit TO GROUP "Usuarios";


CREATE OR REPLACE FUNCTION bitacora_audit() RETURNS TRIGGER AS
$BODY$
DECLARE
	a_content text[];
	v_record integer;
	RCD RECORD;

    BEGIN
        IF (TG_OP = \'INSERT\') THEN
            RCD:= NEW;
        ELSE
            RCD:= OLD;
        END IF;
	
        IF (TG_TABLE_NAME = \'tb_fletes\') THEN
			v_record = 1;
            a_content = ARRAY[RCD.ca_idtrayecto::text, RCD.ca_idconcepto::text, RCD.ca_vlrneto::text, RCD.ca_vlrminimo::text, RCD.ca_fleteminimo::text, RCD.ca_idmoneda, RCD.ca_fchinicio::text, RCD.ca_fchvencimiento::text, RCD.ca_sugerida, RCD.ca_mantenimiento];
        ELSIF (TG_TABLE_NAME = \'tb_recargos\') THEN
			v_record = 2;
            a_content = ARRAY[RCD.ca_idtrayecto::text, RCD.ca_idconcepto::text, RCD.ca_idrecargo::text, RCD.ca_aplicacion, RCD.ca_fchinicio::text, RCD.ca_fchvencimiento::text, RCD.ca_vlrfijo::text, RCD.ca_porcentaje::text, RCD.ca_baseporcentaje, RCD.ca_vlrunitario::text, RCD.ca_baseunitario, RCD.ca_recargominimo::text, RCD.ca_idmoneda];
        ELSIF (TG_TABLE_NAME = \'tb_recargosxtraf\') THEN
			v_record = 3;
            a_content = ARRAY[RCD.ca_idtrafico, RCD.ca_idciudad, RCD.ca_idrecargo::text, RCD.ca_modalidad, RCD.ca_impoexpo, RCD.ca_aplicacion, RCD.ca_fchinicio::text, RCD.ca_fchvencimiento::text, RCD.ca_vlrfijo::text, RCD.ca_porcentaje::text, RCD.ca_baseporcentaje, RCD.ca_vlrunitario::text, RCD.ca_baseunitario, RCD.ca_recargominimo::text, RCD.ca_idmoneda];
        END IF;

        IF (TG_OP = \'DELETE\') THEN
            INSERT INTO tb_bitacora_audit (ca_operation, ca_stamp, ca_userid, ca_table, ca_record, ca_content) SELECT \'D\', now(), user, TG_TABLE_NAME, v_record, a_content;
            RETURN OLD;
        ELSIF (TG_OP = \'UPDATE\') THEN
            INSERT INTO tb_bitacora_audit (ca_operation, ca_stamp, ca_userid, ca_table, ca_record, ca_content) SELECT \'U\', now(), user, TG_TABLE_NAME, v_record, a_content;
            RETURN NEW;
        ELSIF (TG_OP = \'INSERT\') THEN
            INSERT INTO tb_bitacora_audit (ca_operation, ca_stamp, ca_userid, ca_table, ca_record, ca_content) SELECT \'I\', now(), user, TG_TABLE_NAME, v_record, a_content;
            RETURN NEW;
        END IF;
        RETURN NULL; -- result is ignored since this is an AFTER trigger
    END;
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER tgr_tb_fletes
AFTER INSERT OR UPDATE OR DELETE ON tb_fletes
    FOR EACH ROW EXECUTE PROCEDURE bitacora_audit();

CREATE TRIGGER tgr_tb_recargos
AFTER INSERT OR UPDATE OR DELETE ON tb_recargos
    FOR EACH ROW EXECUTE PROCEDURE bitacora_audit();

CREATE TRIGGER tgr_tb_recargosxtraf
AFTER INSERT OR UPDATE OR DELETE ON tb_recargosxtraf
    FOR EACH ROW EXECUTE PROCEDURE bitacora_audit();


======================================= * * * * * * * * * * ================================

create table tb_inomaestralog_sea
( ca_referencia varchar (16) NOT NULL
, ca_fchcerrado timestamp
, ca_usucerrado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk__inomaestralog_sea PRIMARY KEY (ca_referencia, ca_fchactualizado)
);
REVOKE ALL ON tb_inomaestralog_sea FROM PUBLIC;
GRANT ALL ON tb_inomaestralog_sea TO "Administrador";
GRANT ALL ON tb_inomaestralog_sea TO GROUP "Usuarios";



CREATE OR REPLACE RULE rl_inomaestra_sea AS
    ON UPDATE TO tb_inomaestra_sea WHERE trim(old.ca_usucerrado::text) != trim(new.ca_usucerrado::text)
    DO INSERT INTO tb_inomaestralog_sea (ca_referencia, ca_fchcerrado, ca_usucerrado, ca_fchactualizado, ca_usuactualizado) values (new.ca_referencia, old.ca_fchcerrado, old.ca_usucerrado, to_char(current_timestamp,'YYYY-mm-dd hh24:mi:ss')::timestamp, new.ca_usuoperacion);



CREATE OR REPLACE FUNCTION fun_last_version(TEXT) RETURNS INTEGER AS
$BODY$
DECLARE
	v_consecutivo ALIAS FOR $1;
        referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
	a_output integer;

BEGIN
	FOR referrer_keys IN select ca_version from tb_reportes where ca_consecutivo = v_consecutivo order by ca_version DESC limit 1 LOOP
            IF referrer_keys.ca_version IS NOT NULL THEN
                a_output = referrer_keys.ca_version;
            END IF;
	END LOOP;
	RETURN a_output;
END;
$BODY$
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION fun_incoterms_clie(NUMERIC, DATE, DATE) RETURNS TEXT AS
$BODY$
DECLARE
	v_idcliente ALIAS FOR $1;
        v_fch_ini ALIAS FOR $2;
        v_fch_fin ALIAS FOR $3;
	referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
	a_terminos text[];
        a_reporte_term text[];
	a_output text:= '';

BEGIN
	FOR referrer_keys IN
            select DISTINCT cc.ca_idcliente, rps.ca_incoterms from tb_reportes rps
                INNER JOIN tb_concliente cc ON (rps.ca_idconcliente = cc.ca_idcontacto)
            where rps.ca_version = fun_last_version(ca_consecutivo) and rps.ca_incoterms != '' and cc.ca_idcliente = v_idcliente and rps.ca_incoterms IS NOT NULL and rps.ca_fchreporte between v_fch_ini and v_fch_fin LOOP
		IF referrer_keys.ca_idcliente IS NOT NULL THEN
		    a_reporte_term = string_to_array(referrer_keys.ca_incoterms,'|');
                    FOR i IN array_lower(a_reporte_term, 1)..array_upper(a_reporte_term, 1)
                    LOOP
                        IF NOT arraycontains(a_terminos, a_reporte_term[i])  THEN
                            a_terminos = array_cat(a_terminos, array(a_reporte_term[i]));
                        END IF;
                    END LOOP;
		END IF;
	END LOOP;
	RETURN a_output;
END;
$BODY$
LANGUAGE 'plpgsql';

