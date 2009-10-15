
-----------------------------------------------------------------------------
-- tb_trayectos
-----------------------------------------------------------------------------

DROP TABLE "tb_trayectos" CASCADE;


CREATE TABLE "tb_trayectos"
(
	"oid" INTEGER  NOT NULL,
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_origen" VARCHAR(8)  NOT NULL,
	"ca_destino" VARCHAR(8)  NOT NULL,
	"ca_idlinea" INTEGER  NOT NULL,
	"ca_transporte" VARCHAR  NOT NULL,
	"ca_terminal" VARCHAR,
	"ca_impoexpo" VARCHAR,
	"ca_frecuencia" VARCHAR,
	"ca_tiempotransito" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_idtarifas" INTEGER,
	"ca_observaciones" VARCHAR,
	"ca_idagente" INTEGER,
	"ca_activo" BOOLEAN,
	PRIMARY KEY ("ca_idtrayecto")
);

COMMENT ON TABLE "tb_trayectos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricfletes
-----------------------------------------------------------------------------

DROP TABLE "tb_pricfletes" CASCADE;


CREATE TABLE "tb_pricfletes"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_vlrneto" NUMERIC,
	"ca_vlrsugerido" NUMERIC,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_idmoneda" VARCHAR(3),
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_estado" INTEGER,
	"ca_aplicacion" VARCHAR,
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idtrayecto","ca_idconcepto")
);

COMMENT ON TABLE "tb_pricfletes" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- bs_pricfletes
-----------------------------------------------------------------------------

DROP TABLE "bs_pricfletes" CASCADE;


CREATE TABLE "bs_pricfletes"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_vlrneto" NUMERIC,
	"ca_vlrsugerido" NUMERIC,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_idmoneda" VARCHAR(3),
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_estado" INTEGER,
	"ca_aplicacion" VARCHAR,
	"ca_consecutivo" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_consecutivo")
);

COMMENT ON TABLE "bs_pricfletes" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricrecargosxconcepto
-----------------------------------------------------------------------------

DROP TABLE "tb_pricrecargosxconcepto" CASCADE;


CREATE TABLE "tb_pricrecargosxconcepto"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_vlrrecargo" NUMERIC  NOT NULL,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idtrayecto","ca_idconcepto","ca_idrecargo")
);

COMMENT ON TABLE "tb_pricrecargosxconcepto" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- bs_pricrecargosxconcepto
-----------------------------------------------------------------------------

DROP TABLE "bs_pricrecargosxconcepto" CASCADE;


CREATE TABLE "bs_pricrecargosxconcepto"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_vlrrecargo" NUMERIC  NOT NULL,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_consecutivo" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_consecutivo")
);

COMMENT ON TABLE "bs_pricrecargosxconcepto" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricarchivos
-----------------------------------------------------------------------------

DROP TABLE "tb_pricarchivos" CASCADE;

DROP SEQUENCE "tb_pricarchivos_id";

CREATE SEQUENCE "tb_pricarchivos_id";


CREATE TABLE "tb_pricarchivos"
(
	"ca_idarchivo" VARCHAR  NOT NULL,
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_nombre" VARCHAR  NOT NULL,
	"ca_descripcion" VARCHAR  NOT NULL,
	"ca_tamano" NUMERIC,
	"ca_tipo" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_datos" BYTEA,
	"ca_impoexpo" VARCHAR,
	"ca_transporte" VARCHAR,
	"ca_modalidad" VARCHAR,
	PRIMARY KEY ("ca_idarchivo")
);

COMMENT ON TABLE "tb_pricarchivos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricrecargosxciudad
-----------------------------------------------------------------------------

DROP TABLE "tb_pricrecargosxciudad" CASCADE;


CREATE TABLE "tb_pricrecargosxciudad"
(
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_idciudad" VARCHAR  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR  NOT NULL,
	"ca_vlrrecargo" NUMERIC,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idtrafico","ca_idciudad","ca_idrecargo","ca_modalidad","ca_impoexpo")
);

COMMENT ON TABLE "tb_pricrecargosxciudad" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- bs_pricrecargosxciudad
-----------------------------------------------------------------------------

DROP TABLE "bs_pricrecargosxciudad" CASCADE;


CREATE TABLE "bs_pricrecargosxciudad"
(
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_idciudad" VARCHAR  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR  NOT NULL,
	"ca_vlrrecargo" NUMERIC,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_consecutivo" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_consecutivo")
);

COMMENT ON TABLE "bs_pricrecargosxciudad" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricrecargosxlinea
-----------------------------------------------------------------------------

DROP TABLE "tb_pricrecargosxlinea" CASCADE;


CREATE TABLE "tb_pricrecargosxlinea"
(
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_idlinea" VARCHAR  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR  NOT NULL,
	"ca_vlrrecargo" NUMERIC,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idtrafico","ca_idlinea","ca_idrecargo","ca_modalidad","ca_impoexpo")
);

COMMENT ON TABLE "tb_pricrecargosxlinea" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- bs_pricrecargosxlinea
-----------------------------------------------------------------------------

DROP TABLE "bs_pricrecargosxlinea" CASCADE;


CREATE TABLE "bs_pricrecargosxlinea"
(
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_idlinea" VARCHAR  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR  NOT NULL,
	"ca_vlrrecargo" NUMERIC,
	"ca_aplicacion" VARCHAR,
	"ca_vlrminimo" NUMERIC,
	"ca_aplicacion_min" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_idmoneda" VARCHAR(3),
	"ca_consecutivo" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_consecutivo")
);

COMMENT ON TABLE "bs_pricrecargosxlinea" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricnotificaciones
-----------------------------------------------------------------------------

DROP TABLE "tb_pricnotificaciones" CASCADE;

DROP SEQUENCE "tb_pricnotificaciones_id";

CREATE SEQUENCE "tb_pricnotificaciones_id";


CREATE TABLE "tb_pricnotificaciones"
(
	"ca_idnotificacion" INTEGER  NOT NULL,
	"ca_titulo" VARCHAR  NOT NULL,
	"ca_mensaje" VARCHAR  NOT NULL,
	"ca_caducidad" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR(15),
	PRIMARY KEY ("ca_idnotificacion")
);

COMMENT ON TABLE "tb_pricnotificaciones" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_pricseguros
-----------------------------------------------------------------------------

DROP TABLE "tb_pricseguros" CASCADE;


CREATE TABLE "tb_pricseguros"
(
	"ca_idgrupo" INTEGER  NOT NULL,
	"ca_transporte" VARCHAR  NOT NULL,
	"ca_vlrprima" NUMERIC,
	"ca_vlrminima" NUMERIC,
	"ca_vlrobtencionpoliza" NUMERIC,
	"ca_idmoneda" VARCHAR(3),
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	PRIMARY KEY ("ca_idgrupo","ca_transporte")
);

COMMENT ON TABLE "tb_pricseguros" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_fletes
-----------------------------------------------------------------------------

DROP TABLE "tb_fletes" CASCADE;


CREATE TABLE "tb_fletes"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_vlrneto" NUMERIC  NOT NULL,
	"ca_vlrminimo" NUMERIC,
	"ca_fleteminimo" NUMERIC,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_idmoneda" VARCHAR(3),
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_sugerida" VARCHAR,
	"ca_mantenimiento" VARCHAR,
	PRIMARY KEY ("ca_idtrayecto","ca_idconcepto")
);

COMMENT ON TABLE "tb_fletes" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_recargos
-----------------------------------------------------------------------------

DROP TABLE "tb_recargos" CASCADE;


CREATE TABLE "tb_recargos"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_aplicacion" VARCHAR,
	"ca_vlrfijo" NUMERIC,
	"ca_porcentaje" NUMERIC,
	"ca_baseporcentaje" VARCHAR,
	"ca_vlrunitario" NUMERIC,
	"ca_baseunitario" VARCHAR,
	"ca_recargominimo" NUMERIC,
	"ca_idmoneda" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idtrayecto","ca_idconcepto","ca_idrecargo")
);

COMMENT ON TABLE "tb_recargos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_recargosxtraf
-----------------------------------------------------------------------------

DROP TABLE "tb_recargosxtraf" CASCADE;


CREATE TABLE "tb_recargosxtraf"
(
	"ca_idtrafico" VARCHAR  NOT NULL,
	"ca_idciudad" VARCHAR  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_aplicacion" VARCHAR,
	"ca_vlrfijo" NUMERIC,
	"ca_porcentaje" NUMERIC,
	"ca_baseporcentaje" VARCHAR,
	"ca_vlrunitario" NUMERIC,
	"ca_baseunitario" VARCHAR,
	"ca_recargominimo" NUMERIC,
	"ca_idmoneda" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR,
	PRIMARY KEY ("ca_idtrafico","ca_idciudad","ca_idrecargo","ca_modalidad")
);

COMMENT ON TABLE "tb_recargosxtraf" IS '';


SET search_path TO public;
ALTER TABLE "tb_trayectos" ADD CONSTRAINT "tb_trayectos_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_trayectos" ADD CONSTRAINT "tb_trayectos_FK_2" FOREIGN KEY ("ca_idagente") REFERENCES "tb_agentes" ("ca_idagente");

ALTER TABLE "tb_pricfletes" ADD CONSTRAINT "tb_pricfletes_FK_1" FOREIGN KEY ("ca_idtrayecto") REFERENCES "tb_trayectos" ("ca_idtrayecto");

ALTER TABLE "tb_pricfletes" ADD CONSTRAINT "tb_pricfletes_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "bs_pricfletes" ADD CONSTRAINT "bs_pricfletes_FK_1" FOREIGN KEY ("ca_idtrayecto") REFERENCES "tb_trayectos" ("ca_idtrayecto");

ALTER TABLE "bs_pricfletes" ADD CONSTRAINT "bs_pricfletes_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_pricrecargosxconcepto" ADD CONSTRAINT "tb_pricrecargosxconcepto_FK_1" FOREIGN KEY ("ca_idtrayecto","ca_idconcepto") REFERENCES "tb_pricfletes" ("ca_idtrayecto","ca_idconcepto");

ALTER TABLE "tb_pricrecargosxconcepto" ADD CONSTRAINT "tb_pricrecargosxconcepto_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "bs_pricrecargosxconcepto" ADD CONSTRAINT "bs_pricrecargosxconcepto_FK_1" FOREIGN KEY ("ca_idtrayecto","ca_idconcepto") REFERENCES "tb_pricfletes" ("ca_idtrayecto","ca_idconcepto");

ALTER TABLE "bs_pricrecargosxconcepto" ADD CONSTRAINT "bs_pricrecargosxconcepto_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_pricarchivos" ADD CONSTRAINT "tb_pricarchivos_FK_1" FOREIGN KEY ("ca_idtrafico") REFERENCES "tb_traficos" ("ca_idtrafico");

ALTER TABLE "tb_pricrecargosxciudad" ADD CONSTRAINT "tb_pricrecargosxciudad_FK_1" FOREIGN KEY ("ca_idciudad") REFERENCES "tb_ciudades" ("ca_idciudad");

ALTER TABLE "tb_pricrecargosxciudad" ADD CONSTRAINT "tb_pricrecargosxciudad_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "bs_pricrecargosxciudad" ADD CONSTRAINT "bs_pricrecargosxciudad_FK_1" FOREIGN KEY ("ca_idciudad") REFERENCES "tb_ciudades" ("ca_idciudad");

ALTER TABLE "bs_pricrecargosxciudad" ADD CONSTRAINT "bs_pricrecargosxciudad_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_pricrecargosxlinea" ADD CONSTRAINT "tb_pricrecargosxlinea_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_pricrecargosxlinea" ADD CONSTRAINT "tb_pricrecargosxlinea_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "bs_pricrecargosxlinea" ADD CONSTRAINT "bs_pricrecargosxlinea_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "bs_pricrecargosxlinea" ADD CONSTRAINT "bs_pricrecargosxlinea_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_pricseguros" ADD CONSTRAINT "tb_pricseguros_FK_1" FOREIGN KEY ("ca_idgrupo") REFERENCES "tb_grupos" ("ca_idgrupo");

ALTER TABLE "tb_fletes" ADD CONSTRAINT "tb_fletes_FK_1" FOREIGN KEY ("ca_idtrayecto") REFERENCES "tb_trayectos" ("ca_idtrayecto");

ALTER TABLE "tb_fletes" ADD CONSTRAINT "tb_fletes_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_recargos" ADD CONSTRAINT "tb_recargos_FK_1" FOREIGN KEY ("ca_idtrayecto","ca_idconcepto") REFERENCES "tb_fletes" ("ca_idtrayecto","ca_idconcepto");

ALTER TABLE "tb_recargos" ADD CONSTRAINT "tb_recargos_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_recargosxtraf" ADD CONSTRAINT "tb_recargosxtraf_FK_1" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");
