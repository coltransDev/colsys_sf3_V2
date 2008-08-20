
-----------------------------------------------------------------------------
-- tb_clientes
-----------------------------------------------------------------------------

DROP TABLE "tb_clientes" CASCADE;

DROP SEQUENCE "tb_clientes_seq";

CREATE SEQUENCE "tb_clientes_seq";


CREATE TABLE "tb_clientes"
(
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_digito" INTEGER,
	"ca_compania" VARCHAR,
	"ca_papellido" VARCHAR,
	"ca_sapellido" VARCHAR,
	"ca_nombres" VARCHAR,
	"ca_saludo" VARCHAR,
	"ca_sexo" VARCHAR,
	"ca_cumpleanos" VARCHAR,
	"ca_oficina" VARCHAR,
	"ca_vendedor" VARCHAR,
	"ca_email" VARCHAR,
	"ca_coordinador" VARCHAR,
	"ca_direccion" VARCHAR,
	"ca_localidad" VARCHAR,
	"ca_complemento" VARCHAR,
	"ca_telefonos" VARCHAR,
	"ca_fax" VARCHAR,
	"ca_preferencias" VARCHAR,
	"ca_confirmar" VARCHAR,
	"ca_idciudad" VARCHAR,
	PRIMARY KEY ("ca_idcliente")
);

COMMENT ON TABLE "tb_clientes" IS '';


SET search_path TO public;
ALTER TABLE "tb_clientes" ADD CONSTRAINT "tb_clientes_FK_1" FOREIGN KEY ("ca_idciudad") REFERENCES "tb_ciudades" ("ca_idciudad");

-----------------------------------------------------------------------------
-- tb_terceros
-----------------------------------------------------------------------------

DROP TABLE "tb_terceros" CASCADE;

DROP SEQUENCE "tb_terceros_seq";

CREATE SEQUENCE "tb_terceros_seq";


CREATE TABLE "tb_terceros"
(
	"ca_idtercero" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_contacto" VARCHAR,
	"ca_direccion" VARCHAR,
	"ca_telefonos" VARCHAR,
	"ca_fax" VARCHAR,
	"ca_idciudad" VARCHAR,
	"ca_email" VARCHAR,
	"ca_vendedor" VARCHAR,
	"ca_tipo" VARCHAR,
	"ca_identificacion" VARCHAR,
	PRIMARY KEY ("ca_idtercero")
);

COMMENT ON TABLE "tb_terceros" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_agentes
-----------------------------------------------------------------------------

DROP TABLE "tb_agentes" CASCADE;

DROP SEQUENCE "tb_agentes_seq";

CREATE SEQUENCE "tb_agentes_seq";


CREATE TABLE "tb_agentes"
(
	"ca_idagente" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_direccion" VARCHAR,
	"ca_telefonos" VARCHAR,
	"ca_fax" VARCHAR,
	"ca_idciudad" VARCHAR,
	"ca_zipcode" VARCHAR,
	"ca_website" VARCHAR,
	"ca_email" VARCHAR,
	"ca_divulgacion" VARCHAR,
	PRIMARY KEY ("ca_idagente")
);

COMMENT ON TABLE "tb_agentes" IS '';


SET search_path TO public;
ALTER TABLE "tb_agentes" ADD CONSTRAINT "tb_agentes_FK_1" FOREIGN KEY ("ca_idciudad") REFERENCES "tb_ciudades" ("ca_idciudad");

-----------------------------------------------------------------------------
-- tb_contactos
-----------------------------------------------------------------------------

DROP TABLE "tb_contactos" CASCADE;


CREATE TABLE "tb_contactos"
(
	"ca_idcontacto" VARCHAR  NOT NULL,
	"ca_idagente" INTEGER,
	"ca_nombre" VARCHAR,
	"ca_direccion" VARCHAR,
	"ca_telefonos" VARCHAR,
	"ca_fax" VARCHAR,
	"ca_idciudad" VARCHAR,
	"ca_email" VARCHAR,
	"ca_impoexpo" VARCHAR,
	"ca_transporte" VARCHAR,
	"ca_cargo" VARCHAR,
	"ca_detalle" VARCHAR,
	PRIMARY KEY ("ca_idcontacto")
);

COMMENT ON TABLE "tb_contactos" IS '';


SET search_path TO public;
ALTER TABLE "tb_contactos" ADD CONSTRAINT "tb_contactos_FK_1" FOREIGN KEY ("ca_idagente") REFERENCES "tb_agentes" ("ca_idagente");

ALTER TABLE "tb_contactos" ADD CONSTRAINT "tb_contactos_FK_2" FOREIGN KEY ("ca_idciudad") REFERENCES "tb_ciudades" ("ca_idciudad");

-----------------------------------------------------------------------------
-- tb_ciudades
-----------------------------------------------------------------------------

DROP TABLE "tb_ciudades" CASCADE;


CREATE TABLE "tb_ciudades"
(
	"ca_idciudad" VARCHAR  NOT NULL,
	"ca_ciudad" VARCHAR,
	"ca_idtrafico" VARCHAR,
	"ca_puerto" VARCHAR,
	PRIMARY KEY ("ca_idciudad")
);

COMMENT ON TABLE "tb_ciudades" IS '';


SET search_path TO public;
ALTER TABLE "tb_ciudades" ADD CONSTRAINT "tb_ciudades_FK_1" FOREIGN KEY ("ca_idtrafico") REFERENCES "tb_traficos" ("ca_idtrafico");

-----------------------------------------------------------------------------
-- tb_traficos
-----------------------------------------------------------------------------

DROP TABLE "tb_traficos" CASCADE;

DROP SEQUENCE "tb_traficos_seq";

CREATE SEQUENCE "tb_traficos_seq";


CREATE TABLE "tb_traficos"
(
	"ca_idtrafico" VARCHAR(6)  NOT NULL,
	"ca_nombre" VARCHAR(40),
	"ca_bandera" VARCHAR(30),
	"ca_idmoneda" VARCHAR(3),
	"ca_idgrupo" INTEGER,
	"ca_link" VARCHAR(256),
	PRIMARY KEY ("ca_idtrafico")
);

COMMENT ON TABLE "tb_traficos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_conceptos
-----------------------------------------------------------------------------

DROP TABLE "tb_conceptos" CASCADE;

DROP SEQUENCE "tb_conceptos_seq";

CREATE SEQUENCE "tb_conceptos_seq";


CREATE TABLE "tb_conceptos"
(
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_concepto" VARCHAR  NOT NULL,
	"ca_unidad" VARCHAR  NOT NULL,
	"ca_transporte" VARCHAR  NOT NULL,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_pregunta" VARCHAR  NOT NULL,
	"ca_liminferior" INTEGER,
	PRIMARY KEY ("ca_idconcepto")
);

COMMENT ON TABLE "tb_conceptos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_tiporecargo
-----------------------------------------------------------------------------

DROP TABLE "tb_tiporecargo" CASCADE;


CREATE TABLE "tb_tiporecargo"
(
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_recargo" VARCHAR  NOT NULL,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_transporte" VARCHAR  NOT NULL,
	"ca_incoterms" VARCHAR,
	"ca_reporte" VARCHAR,
	"ca_impoexpo" VARCHAR,
	PRIMARY KEY ("ca_idrecargo")
);

COMMENT ON TABLE "tb_tiporecargo" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_costos
-----------------------------------------------------------------------------

DROP TABLE "tb_costos" CASCADE;


CREATE TABLE "tb_costos"
(
	"ca_idcosto" INTEGER  NOT NULL,
	"ca_costo" VARCHAR  NOT NULL,
	"ca_transporte" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR  NOT NULL,
	"ca_modalidad" VARCHAR,
	"ca_comisionable" VARCHAR,
	PRIMARY KEY ("ca_idcosto")
);

COMMENT ON TABLE "tb_costos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_sia
-----------------------------------------------------------------------------

DROP TABLE "tb_sia" CASCADE;

DROP SEQUENCE "tb_sia_seq";

CREATE SEQUENCE "tb_sia_seq";


CREATE TABLE "tb_sia"
(
	"ca_idsia" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_tel" VARCHAR,
	"ca_contacto" VARCHAR,
	PRIMARY KEY ("ca_idsia")
);

COMMENT ON TABLE "tb_sia" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_parametros
-----------------------------------------------------------------------------

DROP TABLE "tb_parametros" CASCADE;

DROP SEQUENCE "tb_parametros_seq";

CREATE SEQUENCE "tb_parametros_seq";


CREATE TABLE "tb_parametros"
(
	"ca_casouso" VARCHAR  NOT NULL,
	"ca_identificacion" INTEGER  NOT NULL,
	"ca_valor" VARCHAR  NOT NULL,
	"ca_valor2" VARCHAR,
	PRIMARY KEY ("ca_casouso","ca_identificacion","ca_valor")
);

COMMENT ON TABLE "tb_parametros" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_transporlineas
-----------------------------------------------------------------------------

DROP TABLE "tb_transporlineas" CASCADE;

DROP SEQUENCE "tb_transporlineas_seq";

CREATE SEQUENCE "tb_transporlineas_seq";


CREATE TABLE "tb_transporlineas"
(
	"ca_idlinea" INTEGER  NOT NULL,
	"ca_idtransportista" NUMERIC,
	"ca_nombre" VARCHAR,
	"ca_sigla" VARCHAR,
	"ca_transporte" VARCHAR,
	PRIMARY KEY ("ca_idlinea")
);

COMMENT ON TABLE "tb_transporlineas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_monedas
-----------------------------------------------------------------------------

DROP TABLE "tb_monedas" CASCADE;


CREATE TABLE "tb_monedas"
(
	"ca_idmoneda" VARCHAR(3)  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_referencia" VARCHAR(3),
	PRIMARY KEY ("ca_idmoneda")
);

COMMENT ON TABLE "tb_monedas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_concliente
-----------------------------------------------------------------------------

DROP TABLE "tb_concliente" CASCADE;


CREATE TABLE "tb_concliente"
(
	"ca_idcontacto" INTEGER  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_papellido" VARCHAR  NOT NULL,
	"ca_sapellido" VARCHAR,
	"ca_nombres" VARCHAR,
	"ca_saludo" VARCHAR,
	"ca_cargo" VARCHAR,
	"ca_departamento" VARCHAR,
	"ca_telefonos" VARCHAR,
	"ca_fax" VARCHAR,
	"ca_email" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_fchactualizado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_usuactualizado" VARCHAR,
	"ca_cumpleanos" VARCHAR,
	PRIMARY KEY ("ca_idcontacto")
);

COMMENT ON TABLE "tb_concliente" IS '';


SET search_path TO public;
ALTER TABLE "tb_concliente" ADD CONSTRAINT "tb_concliente_FK_1" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");

-----------------------------------------------------------------------------
-- tb_emails
-----------------------------------------------------------------------------

DROP TABLE "tb_emails" CASCADE;

DROP SEQUENCE "tb_emails_seq";

CREATE SEQUENCE "tb_emails_seq";


CREATE TABLE "tb_emails"
(
	"ca_idemail" INTEGER  NOT NULL,
	"ca_fchenvio" TIMESTAMP  NOT NULL,
	"ca_usuenvio" VARCHAR  NOT NULL,
	"ca_tipo" VARCHAR,
	"ca_idcaso" VARCHAR,
	"ca_from" VARCHAR,
	"ca_fromname" VARCHAR,
	"ca_cc" VARCHAR,
	"ca_replyto" VARCHAR,
	"ca_address" VARCHAR,
	"ca_attachment" VARCHAR,
	"ca_subject" VARCHAR,
	"ca_body" VARCHAR,
	"ca_readreceipt" BOOLEAN,
	PRIMARY KEY ("ca_idemail")
);

COMMENT ON TABLE "tb_emails" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_attachments
-----------------------------------------------------------------------------

DROP TABLE "tb_attachments" CASCADE;

DROP SEQUENCE "tb_attachments_seq";

CREATE SEQUENCE "tb_attachments_seq";


CREATE TABLE "tb_attachments"
(
	"ca_idattachment" INTEGER  NOT NULL,
	"ca_idemail" INTEGER  NOT NULL,
	"ca_extension" VARCHAR  NOT NULL,
	"ca_header_file" VARCHAR,
	"ca_filesize" VARCHAR,
	"ca_content" BYTEA,
	PRIMARY KEY ("ca_idattachment")
);

COMMENT ON TABLE "tb_attachments" IS '';


SET search_path TO public;
ALTER TABLE "tb_attachments" ADD CONSTRAINT "tb_attachments_FK_1" FOREIGN KEY ("ca_idemail") REFERENCES "tb_emails" ("ca_idemail");

-----------------------------------------------------------------------------
-- tb_tasaalaico
-----------------------------------------------------------------------------

DROP TABLE "tb_tasaalaico" CASCADE;


CREATE TABLE "tb_tasaalaico"
(
	"ca_fechainicial" DATE  NOT NULL,
	"ca_fechafinal" DATE  NOT NULL,
	"ca_valortasa" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_fechainicial")
);

COMMENT ON TABLE "tb_tasaalaico" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_trms
-----------------------------------------------------------------------------

DROP TABLE "tb_trms" CASCADE;


CREATE TABLE "tb_trms"
(
	"ca_fecha" DATE  NOT NULL,
	"ca_euro" NUMERIC,
	"ca_pesos" NUMERIC  NOT NULL,
	"ca_libra" NUMERIC,
	"ca_fsuizo" NUMERIC,
	"ca_marco" NUMERIC,
	"ca_yen" NUMERIC,
	"ca_rupee" NUMERIC,
	"ca_ausdolar" NUMERIC,
	"ca_candolar" NUMERIC,
	"ca_cornoruega" NUMERIC,
	"ca_singdolar" NUMERIC,
	"ca_rand" NUMERIC,
	PRIMARY KEY ("ca_fecha")
);

COMMENT ON TABLE "tb_trms" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_bodegas
-----------------------------------------------------------------------------

DROP TABLE "tb_bodegas" CASCADE;

DROP SEQUENCE "tb_bodegas_seq";

CREATE SEQUENCE "tb_bodegas_seq";


CREATE TABLE "tb_bodegas"
(
	"ca_idbodega" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_tipo" VARCHAR,
	"ca_transporte" VARCHAR,
	PRIMARY KEY ("ca_idbodega")
);

COMMENT ON TABLE "tb_bodegas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_tracking_users
-----------------------------------------------------------------------------

DROP TABLE "tb_tracking_users" CASCADE;

DROP SEQUENCE "tb_tracking_users_seq";

CREATE SEQUENCE "tb_tracking_users_seq";


CREATE TABLE "tb_tracking_users"
(
	"ca_id" INTEGER  NOT NULL,
	"ca_email" VARCHAR,
	"ca_blocked" BOOLEAN,
	"ca_activation_code" VARCHAR,
	"ca_passwd" VARCHAR,
	"ca_password_expiry" DATE,
	"ca_activated" BOOLEAN,
	"ca_idcontacto" INTEGER,
	PRIMARY KEY ("ca_id")
);

COMMENT ON TABLE "tb_tracking_users" IS '';


SET search_path TO public;
ALTER TABLE "tb_tracking_users" ADD CONSTRAINT "tb_tracking_users_FK_1" FOREIGN KEY ("ca_idcontacto") REFERENCES "tb_concliente" ("ca_idcontacto");
