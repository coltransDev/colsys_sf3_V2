
-----------------------------------------------------------------------------
-- tb_inomaestra_air
-----------------------------------------------------------------------------

DROP TABLE "tb_inomaestra_air" CASCADE;


CREATE TABLE "tb_inomaestra_air"
(
	"ca_fchreferencia" DATE  NOT NULL,
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_impoexpo" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_idlinea" INTEGER,
	"ca_mawb" VARCHAR,
	"ca_piezas" INTEGER,
	"ca_peso" NUMERIC,
	"ca_pesovolumen" NUMERIC,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchpreaviso" DATE,
	"ca_fchllegada" DATE,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_fchliquidado" DATE,
	"ca_usuliquidado" VARCHAR,
	"ca_fchcerrado" DATE,
	"ca_usucerrado" VARCHAR,
	PRIMARY KEY ("ca_referencia")
);

COMMENT ON TABLE "tb_inomaestra_air" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_inoclientes_air
-----------------------------------------------------------------------------

DROP TABLE "tb_inoclientes_air" CASCADE;


CREATE TABLE "tb_inoclientes_air"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_hawb" VARCHAR  NOT NULL,
	"ca_idreporte" VARCHAR,
	"ca_idproveedor" INTEGER,
	"ca_proveedor" VARCHAR,
	"ca_numpiezas" INTEGER,
	"ca_peso" INTEGER,
	"ca_volumen" INTEGER,
	"ca_numorden" VARCHAR,
	"ca_loginvendedor" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_idbodega" INTEGER,
	PRIMARY KEY ("ca_referencia","ca_idcliente","ca_hawb")
);

COMMENT ON TABLE "tb_inoclientes_air" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_inoingresos_air
-----------------------------------------------------------------------------

DROP TABLE "tb_inoingresos_air" CASCADE;


CREATE TABLE "tb_inoingresos_air"
(
	"ca_referencia" VARCHAR  NOT NULL,
	"ca_idcliente" INTEGER  NOT NULL,
	"ca_hawb" VARCHAR  NOT NULL,
	"ca_factura" VARCHAR  NOT NULL,
	"ca_fchfactura" DATE,
	"ca_valor" NUMERIC,
	"ca_reccaja" VARCHAR,
	"ca_fchpago" DATE,
	"ca_tcalaico" NUMERIC,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	PRIMARY KEY ("ca_referencia","ca_idcliente","ca_hawb","ca_factura")
);

COMMENT ON TABLE "tb_inoingresos_air" IS '';


SET search_path TO public;
ALTER TABLE "tb_inomaestra_air" ADD CONSTRAINT "tb_inomaestra_air_FK_1" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_inoclientes_air" ADD CONSTRAINT "tb_inoclientes_air_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_inoclientes_air" ADD CONSTRAINT "tb_inoclientes_air_FK_2" FOREIGN KEY ("ca_idproveedor") REFERENCES "tb_terceros" ("ca_idtercero");

ALTER TABLE "tb_inoclientes_air" ADD CONSTRAINT "tb_inoclientes_air_FK_3" FOREIGN KEY ("ca_referencia") REFERENCES "tb_inomaestra_air" ("ca_referencia");

ALTER TABLE "tb_inoingresos_air" ADD CONSTRAINT "tb_inoingresos_air_FK_1" FOREIGN KEY ("ca_referencia") REFERENCES "tb_inomaestra_air" ("ca_referencia");

ALTER TABLE "tb_inoingresos_air" ADD CONSTRAINT "tb_inoingresos_air_FK_2" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");
