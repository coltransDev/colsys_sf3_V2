
-----------------------------------------------------------------------------
-- tb_cotizaciones
-----------------------------------------------------------------------------

DROP TABLE "tb_cotizaciones" CASCADE;

DROP SEQUENCE "tb_cotizaciones_id";

CREATE SEQUENCE "tb_cotizaciones_id";


CREATE TABLE "tb_cotizaciones"
(
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idcontacto" INTEGER  NOT NULL,
	"ca_consecutivo" VARCHAR,
	"ca_asunto" VARCHAR,
	"ca_saludo" VARCHAR,
	"ca_entrada" VARCHAR,
	"ca_despedida" VARCHAR,
	"ca_usuario" VARCHAR,
	"ca_anexos" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_fchsolicitud" DATE,
	"ca_horasolicitud" TIME,
	"ca_fchpresentacion" TIMESTAMP,
	"ca_fchanulado" DATE,
	"ca_usuanulado" VARCHAR,
	"ca_empresa" VARCHAR,
	"ca_datosag" VARCHAR,
	"ca_fuente" VARCHAR,
	PRIMARY KEY ("ca_idcotizacion")
);

COMMENT ON TABLE "tb_cotizaciones" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotproductos
-----------------------------------------------------------------------------

DROP TABLE "tb_cotproductos" CASCADE;

DROP SEQUENCE "tb_cotproductos_id";

CREATE SEQUENCE "tb_cotproductos_id";


CREATE TABLE "tb_cotproductos"
(
	"ca_idproducto" INTEGER  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_transporte" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_escala" VARCHAR,
	"ca_impoexpo" VARCHAR,
	"ca_imprimir" VARCHAR,
	"ca_producto" VARCHAR,
	"ca_incoterms" VARCHAR,
	"ca_frecuencia" VARCHAR,
	"ca_tiempotransito" VARCHAR,
	"ca_locrecargos" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_datosag" VARCHAR,
	"ca_idlinea" INTEGER,
	"ca_postularlinea" BOOLEAN,
	"ca_estado" VARCHAR,
	"ca_motivonoaprobado" VARCHAR,
	PRIMARY KEY ("ca_idproducto","ca_idcotizacion")
);

COMMENT ON TABLE "tb_cotproductos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotopciones
-----------------------------------------------------------------------------

DROP TABLE "tb_cotopciones" CASCADE;

DROP SEQUENCE "tb_cotopciones_id";

CREATE SEQUENCE "tb_cotopciones_id";


CREATE TABLE "tb_cotopciones"
(
	"ca_idopcion" VARCHAR  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idproducto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER,
	"ca_valor_tar" NUMERIC,
	"ca_aplica_tar" VARCHAR,
	"ca_valor_min" NUMERIC,
	"ca_aplica_min" VARCHAR,
	"ca_idmoneda" VARCHAR,
	"ca_recargos" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idopcion","ca_idcotizacion","ca_idproducto")
);

COMMENT ON TABLE "tb_cotopciones" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotrecargos
-----------------------------------------------------------------------------

DROP TABLE "tb_cotrecargos" CASCADE;


CREATE TABLE "tb_cotrecargos"
(
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idproducto" INTEGER  NOT NULL,
	"ca_idopcion" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_tipo" VARCHAR,
	"ca_valor_tar" NUMERIC,
	"ca_aplica_tar" VARCHAR,
	"ca_valor_min" NUMERIC,
	"ca_aplica_min" VARCHAR,
	"ca_idmoneda" VARCHAR,
	"ca_modalidad" VARCHAR  NOT NULL,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_consecutivo" INTEGER,
	PRIMARY KEY ("ca_idcotizacion","ca_idproducto","ca_idopcion","ca_idconcepto","ca_idrecargo","ca_modalidad")
);

COMMENT ON TABLE "tb_cotrecargos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotcontinuacion
-----------------------------------------------------------------------------

DROP TABLE "tb_cotcontinuacion" CASCADE;

DROP SEQUENCE "tb_cotcontinuacion_id";

CREATE SEQUENCE "tb_cotcontinuacion_id";


CREATE TABLE "tb_cotcontinuacion"
(
	"ca_idcontinuacion" INTEGER  NOT NULL,
	"ca_idcotizacion" INTEGER,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_modalidad" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_idconcepto" INTEGER,
	"ca_idmoneda" VARCHAR,
	"ca_idequipo" INTEGER,
	"ca_tarifa" VARCHAR,
	"ca_valor_tar" NUMERIC,
	"ca_valor_min" NUMERIC,
	"ca_frecuencia" VARCHAR,
	"ca_tiempotransito" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idcontinuacion")
);

COMMENT ON TABLE "tb_cotcontinuacion" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotseguro
-----------------------------------------------------------------------------

DROP TABLE "tb_cotseguro" CASCADE;

DROP SEQUENCE "tb_cotseguro_id";

CREATE SEQUENCE "tb_cotseguro_id";


CREATE TABLE "tb_cotseguro"
(
	"ca_idseguro" VARCHAR  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idmoneda" VARCHAR  NOT NULL,
	"ca_prima_tip" VARCHAR,
	"ca_prima_vlr" NUMERIC,
	"ca_prima_min" NUMERIC,
	"ca_obtencion" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_transporte" VARCHAR,
	PRIMARY KEY ("ca_idseguro")
);

COMMENT ON TABLE "tb_cotseguro" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_cotarchivos
-----------------------------------------------------------------------------

DROP TABLE "tb_cotarchivos" CASCADE;

DROP SEQUENCE "tb_cotarchivos_id";

CREATE SEQUENCE "tb_cotarchivos_id";


CREATE TABLE "tb_cotarchivos"
(
	"ca_idarchivo" VARCHAR  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_nombre" VARCHAR  NOT NULL,
	"ca_tamano" NUMERIC,
	"ca_tipo" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_datos" BYTEA,
	PRIMARY KEY ("ca_idarchivo")
);

COMMENT ON TABLE "tb_cotarchivos" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotizaciones" ADD CONSTRAINT "tb_cotizaciones_FK_1" FOREIGN KEY ("ca_idcontacto") REFERENCES "tb_concliente" ("ca_idcontacto");

ALTER TABLE "tb_cotizaciones" ADD CONSTRAINT "tb_cotizaciones_FK_2" FOREIGN KEY ("ca_usuario") REFERENCES "control.tb_usuarios" ("ca_login");

ALTER TABLE "tb_cotproductos" ADD CONSTRAINT "tb_cotproductos_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

ALTER TABLE "tb_cotproductos" ADD CONSTRAINT "tb_cotproductos_FK_2" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_cotopciones" ADD CONSTRAINT "tb_cotopciones_FK_1" FOREIGN KEY ("ca_idproducto","ca_idcotizacion") REFERENCES "tb_cotproductos" ("ca_idproducto","ca_idcotizacion");

ALTER TABLE "tb_cotopciones" ADD CONSTRAINT "tb_cotopciones_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_cotrecargos" ADD CONSTRAINT "tb_cotrecargos_FK_1" FOREIGN KEY ("ca_idopcion") REFERENCES "tb_cotopciones" ("ca_idopcion");

ALTER TABLE "tb_cotrecargos" ADD CONSTRAINT "tb_cotrecargos_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_cotcontinuacion" ADD CONSTRAINT "tb_cotcontinuacion_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

ALTER TABLE "tb_cotcontinuacion" ADD CONSTRAINT "tb_cotcontinuacion_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_cotseguro" ADD CONSTRAINT "tb_cotseguro_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

ALTER TABLE "tb_cotseguro" ADD CONSTRAINT "tb_cotseguro_FK_2" FOREIGN KEY ("ca_idmoneda") REFERENCES "tb_monedas" ("ca_idmoneda");

ALTER TABLE "tb_cotarchivos" ADD CONSTRAINT "tb_cotarchivos_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");
