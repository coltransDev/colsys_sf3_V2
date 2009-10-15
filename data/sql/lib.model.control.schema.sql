
-----------------------------------------------------------------------------
-- control.tb_usuarios
-----------------------------------------------------------------------------

DROP TABLE "control.tb_usuarios" CASCADE;


CREATE TABLE "control.tb_usuarios"
(
	"ca_login" serial  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_cargo" VARCHAR(10),
	"ca_departamento" VARCHAR,
	"ca_idsucursal" VARCHAR,
	"ca_email" VARCHAR,
	"ca_rutinas" VARCHAR,
	"ca_extension" VARCHAR,
	PRIMARY KEY ("ca_login")
);

COMMENT ON TABLE "control.tb_usuarios" IS '';


SET search_path TO public;
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
-----------------------------------------------------------------------------
-- control.tb_sucursales
-----------------------------------------------------------------------------

DROP TABLE "control.tb_sucursales" CASCADE;


CREATE TABLE "control.tb_sucursales"
(
	"ca_idsucursal" VARCHAR(3),
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
	"ca_event" VARCHAR(255),
	"ca_module" VARCHAR(100),
	"ca_action" VARCHAR(100),
	PRIMARY KEY ("ca_idlog")
);

COMMENT ON TABLE "control.tb_log" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- control.tb_accesos_grp
-----------------------------------------------------------------------------

DROP TABLE "control.tb_accesos_grp" CASCADE;


CREATE TABLE "control.tb_accesos_grp"
(
	"ca_rutina" VARCHAR(255)  NOT NULL,
	"ca_grupo" VARCHAR(255)  NOT NULL,
	"ca_acceso" INTEGER,
	PRIMARY KEY ("ca_rutina","ca_grupo")
);

COMMENT ON TABLE "control.tb_accesos_grp" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- control.tb_accesos_user
-----------------------------------------------------------------------------

DROP TABLE "control.tb_accesos_user" CASCADE;


CREATE TABLE "control.tb_accesos_user"
(
	"ca_rutina" VARCHAR(255)  NOT NULL,
	"ca_login" VARCHAR(255)  NOT NULL,
	"ca_acceso" INTEGER,
	PRIMARY KEY ("ca_rutina","ca_login")
);

COMMENT ON TABLE "control.tb_accesos_user" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- control.tb_rutinas
-----------------------------------------------------------------------------

DROP TABLE "control.tb_rutinas" CASCADE;


CREATE TABLE "control.tb_rutinas"
(
	"ca_rutina" VARCHAR(255)  NOT NULL,
	"ca_opcion" VARCHAR(255),
	"ca_descripcion" VARCHAR(255),
	"ca_programa" VARCHAR(255),
	"ca_grupo" VARCHAR(255),
	PRIMARY KEY ("ca_rutina")
);

COMMENT ON TABLE "control.tb_rutinas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- control.tb_departamentos
-----------------------------------------------------------------------------

DROP TABLE "control.tb_departamentos" CASCADE;

DROP SEQUENCE "control.tb_departamentos_id";

CREATE SEQUENCE "control.tb_departamentos_id";


CREATE TABLE "control.tb_departamentos"
(
	"ca_iddepartamento" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR,
	"ca_inhelpdesk" BOOLEAN,
	PRIMARY KEY ("ca_iddepartamento")
);

COMMENT ON TABLE "control.tb_departamentos" IS '';


SET search_path TO public;
ALTER TABLE "control.tb_usuarios" ADD CONSTRAINT "control.tb_usuarios_FK_1" FOREIGN KEY ("ca_idsucursal") REFERENCES "control.tb_sucursales" ("ca_idsucursal");

ALTER TABLE "control.tb_niveles" ADD CONSTRAINT "control.tb_niveles_FK_1" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");

ALTER TABLE "control.tb_accesos_user" ADD CONSTRAINT "control.tb_accesos_user_FK_1" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");
