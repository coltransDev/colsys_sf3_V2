
-----------------------------------------------------------------------------
-- tb_fletes
-----------------------------------------------------------------------------

DROP TABLE "tb_fletes" CASCADE;


CREATE TABLE "tb_fletes"
(
	"oid" INTEGER  NOT NULL,
	"ca_idtrayecto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_vlrneto" NUMERIC  NOT NULL,
	"ca_vlrminimo" NUMERIC,
	"ca_vlrsenior" NUMERIC,
	"ca_vlrjunior" NUMERIC,
	"ca_fleteminimo" NUMERIC,
	"ca_idmoneda" VARCHAR(3),
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_fchinicio" DATE,
	"ca_fchvencimiento" DATE,
	PRIMARY KEY ("oid")
);

COMMENT ON TABLE "tb_fletes" IS '';


SET search_path TO public;