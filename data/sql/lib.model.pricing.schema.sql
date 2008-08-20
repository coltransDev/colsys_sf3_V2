
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
	PRIMARY KEY ("ca_idtrayecto")
);

COMMENT ON TABLE "tb_trayectos" IS '';


SET search_path TO public;
ALTER TABLE "tb_trayectos" ADD CONSTRAINT "tb_trayectos_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_trayectos" ADD CONSTRAINT "tb_trayectos_FK_2" FOREIGN KEY ("ca_idagente") REFERENCES "tb_agentes" ("ca_idagente");

-----------------------------------------------------------------------------
-- tb_pricfletes
-----------------------------------------------------------------------------

DROP TABLE "tb_pricfletes" CASCADE;


CREATE TABLE "tb_pricfletes"
(
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_vlrneto" NUMERIC  NOT NULL,
	"ca_vlrminimo" NUMERIC,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	"ca_idmoneda" VARCHAR(3),
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	PRIMARY KEY ("ca_idtrayecto","ca_idconcepto")
);

COMMENT ON TABLE "tb_pricfletes" IS '';


SET search_path TO public;
ALTER TABLE "tb_pricfletes" ADD CONSTRAINT "tb_pricfletes_FK_1" FOREIGN KEY ("ca_idtrayecto") REFERENCES "tb_trayectos" ("ca_idtrayecto");

ALTER TABLE "tb_pricfletes" ADD CONSTRAINT "tb_pricfletes_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");
