
-----------------------------------------------------------------------------
-- tb_inomaestra_sea
-----------------------------------------------------------------------------

DROP TABLE "tb_inomaestra_sea" CASCADE;


CREATE TABLE "tb_inomaestra_sea"
(
	"ca_fchreferencia" DATE  NOT NULL,
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_fchembarque" DATE,
	"ca_fcharribo" DATE,
	"ca_modalidad" VARCHAR,
	"ca_idlinea" INTEGER,
	"ca_motonave" VARCHAR,
	"ca_ciclo" VARCHAR,
	"ca_mbls" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchconfirmacion" DATE,
	"ca_horaconfirmacion" TIME,
	"ca_registroadu" VARCHAR,
	"ca_registrocap" VARCHAR,
	"ca_bandera" VARCHAR,
	"ca_fchliberacion" DATE,
	"ca_nroliberacion" VARCHAR,
	"ca_anulado" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_fchliquidado" DATE,
	"ca_usuliquidado" VARCHAR,
	"ca_fchcerrado" DATE,
	"ca_usucerrado" VARCHAR,
	"ca_mensaje" VARCHAR,
	"ca_fchdesconsolidacion" VARCHAR,
	"ca_mnllegada" VARCHAR,
	"ca_fchregistroadu" VARCHAR,
	"ca_fchconfirmado" TIMESTAMP,
	"ca_usuconfirmado" VARCHAR,
	"ca_asunto_otm" VARCHAR,
	"ca_mensaje_otm" VARCHAR,
	"ca_fchllegada_otm" VARCHAR,
	"ca_ciudad_otm" VARCHAR,
	"ca_fchconfirma_otm" TIMESTAMP,
	"ca_usuconfirma_otm" VARCHAR,
	"ca_provisional" BOOLEAN,
	"ca_sitiodevolucion" VARCHAR,
	PRIMARY KEY ("ca_referencia")
);

COMMENT ON TABLE "tb_inomaestra_sea" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_inoclientes_sea
-----------------------------------------------------------------------------

DROP TABLE "tb_inoclientes_sea" CASCADE;


CREATE TABLE "tb_inoclientes_sea"
(
	"oid" INTEGER,
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_hbls" VARCHAR  NOT NULL,
	"ca_idreporte" INTEGER,
	"ca_idproveedor" INTEGER,
	"ca_proveedor" VARCHAR,
	"ca_numpiezas" NUMERIC,
	"ca_peso" NUMERIC,
	"ca_volumen" NUMERIC,
	"ca_numorden" VARCHAR,
	"ca_confirmar" VARCHAR,
	"ca_login" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchliberacion" DATE,
	"ca_notaliberacion" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_fchliberado" TIMESTAMP,
	"ca_usuliberado" VARCHAR,
	"ca_mensaje" VARCHAR,
	"ca_continuacion" VARCHAR,
	"ca_continuacion_dest" VARCHAR,
	"ca_idbodega" INTEGER,
	PRIMARY KEY ("ca_referencia","ca_idcliente","ca_hbls")
);

COMMENT ON TABLE "tb_inoclientes_sea" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_inoingresos_sea
-----------------------------------------------------------------------------

DROP TABLE "tb_inoingresos_sea" CASCADE;


CREATE TABLE "tb_inoingresos_sea"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_hbls" VARCHAR  NOT NULL,
	"ca_factura" VARCHAR  NOT NULL,
	"ca_fchfactura" DATE,
	"ca_valor" NUMERIC,
	"ca_reccaja" VARCHAR,
	"ca_fchpago" DATE,
	"ca_tcambio" NUMERIC,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_observaciones" VARCHAR,
	PRIMARY KEY ("ca_referencia","ca_idcliente","ca_hbls","ca_factura")
);

COMMENT ON TABLE "tb_inoingresos_sea" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_inoavisos_sea
-----------------------------------------------------------------------------

DROP TABLE "tb_inoavisos_sea" CASCADE;


CREATE TABLE "tb_inoavisos_sea"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_hbls" VARCHAR  NOT NULL,
	"ca_idemail" INTEGER  NOT NULL,
	"ca_fchaviso" DATE,
	"ca_aviso" VARCHAR,
	"ca_idbodega" INTEGER,
	"ca_fchllegada" DATE,
	"ca_fchenvio" TIMESTAMP,
	"ca_usuenvio" VARCHAR,
	PRIMARY KEY ("ca_referencia","ca_idcliente","ca_hbls","ca_idemail")
);

COMMENT ON TABLE "tb_inoavisos_sea" IS '';


SET search_path TO public;
ALTER TABLE "tb_inomaestra_sea" ADD CONSTRAINT "tb_inomaestra_sea_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_inoclientes_sea" ADD CONSTRAINT "tb_inoclientes_sea_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_inoclientes_sea" ADD CONSTRAINT "tb_inoclientes_sea_FK_2" FOREIGN KEY ("ca_idproveedor") REFERENCES "tb_terceros" ("ca_idtercero");

ALTER TABLE "tb_inoclientes_sea" ADD CONSTRAINT "tb_inoclientes_sea_FK_3" FOREIGN KEY ("ca_referencia") REFERENCES "tb_inomaestra_sea" ("ca_referencia");

ALTER TABLE "tb_inoingresos_sea" ADD CONSTRAINT "tb_inoingresos_sea_FK_1" FOREIGN KEY ("ca_referencia") REFERENCES "tb_inomaestra_sea" ("ca_referencia");

ALTER TABLE "tb_inoingresos_sea" ADD CONSTRAINT "tb_inoingresos_sea_FK_2" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");

ALTER TABLE "tb_inoavisos_sea" ADD CONSTRAINT "tb_inoavisos_sea_FK_1" FOREIGN KEY ("ca_referencia") REFERENCES "tb_inomaestra_sea" ("ca_referencia");

ALTER TABLE "tb_inoavisos_sea" ADD CONSTRAINT "tb_inoavisos_sea_FK_2" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");
