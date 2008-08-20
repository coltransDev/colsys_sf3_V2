
-----------------------------------------------------------------------------
-- tb_cotizaciones
-----------------------------------------------------------------------------

DROP TABLE "tb_cotizaciones" CASCADE;


CREATE TABLE "tb_cotizaciones"
(
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_fchcotizacion" DATE  NOT NULL,
	"ca_fchpresentacion" DATE  NOT NULL,
	"ca_idcontacto" INTEGER  NOT NULL,
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
	PRIMARY KEY ("ca_idcotizacion")
);

COMMENT ON TABLE "tb_cotizaciones" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotizaciones" ADD CONSTRAINT "tb_cotizaciones_FK_1" FOREIGN KEY ("ca_idcontacto") REFERENCES "tb_concliente" ("ca_idcontacto");

ALTER TABLE "tb_cotizaciones" ADD CONSTRAINT "tb_cotizaciones_FK_2" FOREIGN KEY ("ca_usuario") REFERENCES "control.tb_usuarios" ("ca_login");

-----------------------------------------------------------------------------
-- tb_cotproductos
-----------------------------------------------------------------------------

DROP TABLE "tb_cotproductos" CASCADE;


CREATE TABLE "tb_cotproductos"
(
	"ca_idproducto" INTEGER  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_transporte" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
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
	PRIMARY KEY ("ca_idproducto","ca_idcotizacion")
);

COMMENT ON TABLE "tb_cotproductos" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotproductos" ADD CONSTRAINT "tb_cotproductos_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

-----------------------------------------------------------------------------
-- tb_cotopciones
-----------------------------------------------------------------------------

DROP TABLE "tb_cotopciones" CASCADE;

DROP SEQUENCE "tb_cotopciones_seq";

CREATE SEQUENCE "tb_cotopciones_seq";


CREATE TABLE "tb_cotopciones"
(
	"ca_idopcion" VARCHAR  NOT NULL,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idproducto" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER,
	"ca_idmoneda" VARCHAR,
	"ca_tarifa" VARCHAR,
	"ca_oferta" VARCHAR,
	"ca_recargos" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idopcion","ca_idcotizacion")
);

COMMENT ON TABLE "tb_cotopciones" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotopciones" ADD CONSTRAINT "tb_cotopciones_FK_1" FOREIGN KEY ("ca_idproducto","ca_idcotizacion") REFERENCES "tb_cotproductos" ("ca_idproducto","ca_idcotizacion");

ALTER TABLE "tb_cotopciones" ADD CONSTRAINT "tb_cotopciones_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

-----------------------------------------------------------------------------
-- tb_cotrecargos
-----------------------------------------------------------------------------

DROP TABLE "tb_cotrecargos" CASCADE;


CREATE TABLE "tb_cotrecargos"
(
	"ca_idopcion" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_tipo" VARCHAR,
	"ca_valor_tar" NUMERIC,
	"ca_aplica_tar" VARCHAR,
	"ca_valor_min" NUMERIC,
	"ca_aplica_min" VARCHAR,
	"ca_idmoneda" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idproducto" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_idopcion","ca_idrecargo")
);

COMMENT ON TABLE "tb_cotrecargos" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotrecargos" ADD CONSTRAINT "tb_cotrecargos_FK_1" FOREIGN KEY ("ca_idopcion") REFERENCES "tb_cotopciones" ("ca_idopcion");

ALTER TABLE "tb_cotrecargos" ADD CONSTRAINT "tb_cotrecargos_FK_2" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

-----------------------------------------------------------------------------
-- tb_cotcontinuacion
-----------------------------------------------------------------------------

DROP TABLE "tb_cotcontinuacion" CASCADE;


CREATE TABLE "tb_cotcontinuacion"
(
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_modalidad" VARCHAR,
	"ca_origen" VARCHAR  NOT NULL,
	"ca_destino" VARCHAR  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_idmoneda" VARCHAR,
	"ca_idequipo" INTEGER,
	"ca_tarifa" VARCHAR,
	"ca_frecuencia" VARCHAR,
	"ca_tiempotransito" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idcotizacion","ca_tipo","ca_origen","ca_destino","ca_idconcepto")
);

COMMENT ON TABLE "tb_cotcontinuacion" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotcontinuacion" ADD CONSTRAINT "tb_cotcontinuacion_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

ALTER TABLE "tb_cotcontinuacion" ADD CONSTRAINT "tb_cotcontinuacion_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

-----------------------------------------------------------------------------
-- tb_cotseguro
-----------------------------------------------------------------------------

DROP TABLE "tb_cotseguro" CASCADE;


CREATE TABLE "tb_cotseguro"
(
	"ca_idcotizacion" INTEGER  NOT NULL,
	"ca_idmoneda" VARCHAR  NOT NULL,
	"ca_prima" VARCHAR,
	"ca_obtencion" VARCHAR,
	"ca_observaciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR
);

COMMENT ON TABLE "tb_cotseguro" IS '';


SET search_path TO public;
ALTER TABLE "tb_cotseguro" ADD CONSTRAINT "tb_cotseguro_FK_1" FOREIGN KEY ("ca_idcotizacion") REFERENCES "tb_cotizaciones" ("ca_idcotizacion");

ALTER TABLE "tb_cotseguro" ADD CONSTRAINT "tb_cotseguro_FK_2" FOREIGN KEY ("ca_idmoneda") REFERENCES "tb_monedas" ("ca_idmoneda");
