
-----------------------------------------------------------------------------
-- control.tb_usuarios
-----------------------------------------------------------------------------

DROP TABLE "control.tb_usuarios" CASCADE;

DROP SEQUENCE "control.tb_usuarios_seq";

CREATE SEQUENCE "control.tb_usuarios_seq";


CREATE TABLE "control.tb_usuarios"
(
	"ca_login" VARCHAR  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_cargo" VARCHAR(10),
	"ca_departamento" VARCHAR,
	"ca_sucursal" VARCHAR,
	"ca_email" VARCHAR,
	"ca_rutinas" VARCHAR,
	"ca_extension" VARCHAR,
	PRIMARY KEY ("ca_login")
);

COMMENT ON TABLE "control.tb_usuarios" IS '';


SET search_path TO public;
ALTER TABLE "control.tb_usuarios" ADD CONSTRAINT "control.tb_usuarios_FK_1" FOREIGN KEY ("ca_sucursal") REFERENCES "control.tb_sucursales" ("ca_nombre");

-----------------------------------------------------------------------------
-- control.tb_niveles
-----------------------------------------------------------------------------

DROP TABLE "control.tb_niveles" CASCADE;


CREATE TABLE "control.tb_niveles"
(
	"ca_login" VARCHAR  NOT NULL,
	"ca_basededatos" VARCHAR  NOT NULL,
	"ca_nivel" VARCHAR,
	PRIMARY KEY ("ca_login","ca_basededatos")
);

COMMENT ON TABLE "control.tb_niveles" IS '';


SET search_path TO public;
ALTER TABLE "control.tb_niveles" ADD CONSTRAINT "control.tb_niveles_FK_1" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");

-----------------------------------------------------------------------------
-- control.tb_sucursales
-----------------------------------------------------------------------------

DROP TABLE "control.tb_sucursales" CASCADE;


CREATE TABLE "control.tb_sucursales"
(
	"ca_nombre" VARCHAR(50)  NOT NULL,
	"ca_telefono" VARCHAR(50),
	"ca_fax" VARCHAR(100),
	"ca_direccion" VARCHAR(100),
	PRIMARY KEY ("ca_nombre")
);

COMMENT ON TABLE "control.tb_sucursales" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- control.tb_log
-----------------------------------------------------------------------------

DROP TABLE "control.tb_log" CASCADE;


CREATE TABLE "control.tb_log"
(
	"ca_idlog" INTEGER  NOT NULL,
	"ca_login" VARCHAR(50),
	"ca_event" VARCHAR,
	"ca_module" VARCHAR(100),
	"ca_action" VARCHAR(100),
	PRIMARY KEY ("ca_idlog")
);

COMMENT ON TABLE "control.tb_log" IS '';


SET search_path TO public;