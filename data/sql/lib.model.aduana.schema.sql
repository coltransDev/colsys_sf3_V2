
-----------------------------------------------------------------------------
-- tb_brk_maestra
-----------------------------------------------------------------------------

DROP TABLE "tb_brk_maestra" CASCADE;


CREATE TABLE "tb_brk_maestra"
(
	"ca_fchreferencia" DATE  NOT NULL,
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_idcliente" INTEGER,
	"ca_vendedor" VARCHAR,
	"ca_coordinador" VARCHAR,
	"ca_proveedor" VARCHAR,
	"ca_pedido" VARCHAR,
	"ca_piezas" INTEGER,
	"ca_peso" NUMERIC,
	"ca_mercancia" VARCHAR,
	"ca_deposito" VARCHAR,
	"ca_fcharribo" DATE,
	"ca_modalidad" INTEGER,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_fchliquidado" DATE,
	"ca_usuliquidado" VARCHAR,
	"ca_fchcerrado" DATE,
	"ca_usucerrado" VARCHAR,
	"ca_nombrecontacto" VARCHAR,
	"ca_email" VARCHAR,
	"ca_analista" VARCHAR,
	"ca_trackingcode" VARCHAR,
	PRIMARY KEY ("ca_referencia")
);

COMMENT ON TABLE "tb_brk_maestra" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_brk_evento
-----------------------------------------------------------------------------

DROP TABLE "tb_brk_evento" CASCADE;


CREATE TABLE "tb_brk_evento"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_realizado" INTEGER,
	"ca_idevento" INTEGER  NOT NULL,
	"ca_usuario" VARCHAR,
	"ca_fchevento" TIMESTAMP,
	"ca_notas" VARCHAR,
	PRIMARY KEY ("ca_referencia","ca_idevento")
);

COMMENT ON TABLE "tb_brk_evento" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_brk_eventoextras
-----------------------------------------------------------------------------

DROP TABLE "tb_brk_eventoextras" CASCADE;


CREATE TABLE "tb_brk_eventoextras"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idevento" INTEGER  NOT NULL,
	"ca_usucreado" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_texto" VARCHAR,
	PRIMARY KEY ("ca_idevento")
);

COMMENT ON TABLE "tb_brk_eventoextras" IS '';


SET search_path TO public;
ALTER TABLE "tb_brk_maestra" ADD CONSTRAINT "tb_brk_maestra_FK_1" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");

ALTER TABLE "tb_brk_evento" ADD CONSTRAINT "tb_brk_evento_FK_1" FOREIGN KEY ("ca_referencia") REFERENCES "tb_brk_maestra" ("ca_referencia");

ALTER TABLE "tb_brk_eventoextras" ADD CONSTRAINT "tb_brk_eventoextras_FK_1" FOREIGN KEY ("ca_referencia") REFERENCES "tb_brk_maestra" ("ca_referencia");
