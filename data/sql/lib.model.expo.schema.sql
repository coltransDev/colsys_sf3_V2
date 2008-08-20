
-----------------------------------------------------------------------------
-- tb_expo_reportes
-----------------------------------------------------------------------------

DROP TABLE "tb_expo_reportes" CASCADE;

DROP SEQUENCE "tb_expo_reportes_seq";

CREATE SEQUENCE "tb_expo_reportes_seq";


CREATE TABLE "tb_expo_reportes"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idcliente" INTEGER,
	"ca_consecutivo" VARCHAR(10),
	"ca_version" INTEGER,
	"ca_idproducto" INTEGER,
	"ca_producto" VARCHAR,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_peso" FLOAT,
	"ca_pesovolumen" FLOAT,
	"ca_via" VARCHAR,
	"ca_valorcarga" FLOAT,
	"ca_modalidad" VARCHAR,
	"ca_idsia" INTEGER,
	"ca_fchreporte" DATE,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	"ca_contacto" VARCHAR,
	"ca_idagente" INTEGER,
	"ca_tipoexpo" INTEGER,
	"ca_incoterm" INTEGER,
	"ca_idconsignatario" INTEGER,
	"ca_login" VARCHAR(15),
	"ca_vendedor" VARCHAR(15),
	"ca_preferencias_clie" VARCHAR,
	"ca_instrucciones_agente" VARCHAR,
	"ca_instrucciones_aduana" VARCHAR,
	"ca_piezas" INTEGER,
	"ca_dimensiones" VARCHAR,
	"ca_idlinea" INTEGER,
	"ca_idlineaterrestre" INTEGER,
	"ca_tipocarga" VARCHAR,
	"ca_valorseguro" NUMERIC,
	"ca_porcprimaseguro" INTEGER,
	"ca_porcprimacliente" INTEGER,
	"ca_valoremisionpoliza" NUMERIC,
	"ca_idmonedapoliza" VARCHAR,
	"ca_solicitudanticipo" BOOLEAN,
	PRIMARY KEY ("ca_idreporte")
);

COMMENT ON TABLE "tb_expo_reportes" IS '';


SET search_path TO public;
ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_1" FOREIGN KEY ("ca_idcliente") REFERENCES "tb_clientes" ("ca_idcliente");

ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_2" FOREIGN KEY ("ca_idconsignatario") REFERENCES "tb_terceros" ("ca_idtercero");

ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_3" FOREIGN KEY ("ca_idagente") REFERENCES "tb_agentes" ("ca_idagente");

ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_4" FOREIGN KEY ("ca_idsia") REFERENCES "tb_sia" ("ca_idsia");

ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_5" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_expo_reportes" ADD CONSTRAINT "tb_expo_reportes_FK_6" FOREIGN KEY ("ca_idproducto") REFERENCES "tb_cotproductos" ("ca_idproducto");

-----------------------------------------------------------------------------
-- tb_expo_repconceptos
-----------------------------------------------------------------------------

DROP TABLE "tb_expo_repconceptos" CASCADE;


CREATE TABLE "tb_expo_repconceptos"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_cantidad" NUMERIC  NOT NULL,
	"ca_neta_tar" NUMERIC  NOT NULL,
	"ca_neta_min" NUMERIC  NOT NULL,
	"ca_neta_idm" VARCHAR(3)  NOT NULL,
	"ca_reportar_tar" NUMERIC  NOT NULL,
	"ca_reportar_min" NUMERIC  NOT NULL,
	"ca_reportar_idm" VARCHAR(3)  NOT NULL,
	"ca_cobrar_tar" NUMERIC  NOT NULL,
	"ca_cobrar_min" NUMERIC  NOT NULL,
	"ca_cobrar_idm" VARCHAR(3)  NOT NULL,
	PRIMARY KEY ("ca_idreporte","ca_idconcepto")
);

COMMENT ON TABLE "tb_expo_repconceptos" IS '';


SET search_path TO public;
ALTER TABLE "tb_expo_repconceptos" ADD CONSTRAINT "tb_expo_repconceptos_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_expo_reportes" ("ca_idreporte");

ALTER TABLE "tb_expo_repconceptos" ADD CONSTRAINT "tb_expo_repconceptos_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

-----------------------------------------------------------------------------
-- tb_expo_repgastos
-----------------------------------------------------------------------------

DROP TABLE "tb_expo_repgastos" CASCADE;


CREATE TABLE "tb_expo_repgastos"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idrecargo" INTEGER  NOT NULL,
	"ca_aplicacion" VARCHAR  NOT NULL,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_neta_tar" NUMERIC  NOT NULL,
	"ca_neta_min" NUMERIC  NOT NULL,
	"ca_reportar_tar" NUMERIC  NOT NULL,
	"ca_reportar_min" NUMERIC  NOT NULL,
	"ca_cobrar_tar" NUMERIC  NOT NULL,
	"ca_cobrar_min" NUMERIC  NOT NULL,
	"ca_idmoneda" VARCHAR(3)  NOT NULL,
	"ca_detalles" VARCHAR(3)  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_idreporte","ca_idrecargo","ca_idconcepto")
);

COMMENT ON TABLE "tb_expo_repgastos" IS '';


SET search_path TO public;
ALTER TABLE "tb_expo_repgastos" ADD CONSTRAINT "tb_expo_repgastos_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_expo_reportes" ("ca_idreporte");

ALTER TABLE "tb_expo_repgastos" ADD CONSTRAINT "tb_expo_repgastos_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_expo_repgastos" ADD CONSTRAINT "tb_expo_repgastos_FK_3" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

-----------------------------------------------------------------------------
-- tb_expo_repaduana
-----------------------------------------------------------------------------

DROP TABLE "tb_expo_repaduana" CASCADE;


CREATE TABLE "tb_expo_repaduana"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idcosto" INTEGER  NOT NULL,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_vlrcosto" NUMERIC  NOT NULL,
	"ca_mincosto" NUMERIC,
	"ca_netcosto" NUMERIC,
	"ca_idmoneda" VARCHAR,
	"ca_detalles" VARCHAR,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idreporte","ca_idcosto")
);

COMMENT ON TABLE "tb_expo_repaduana" IS '';


SET search_path TO public;
ALTER TABLE "tb_expo_repaduana" ADD CONSTRAINT "tb_expo_repaduana_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_expo_reportes" ("ca_idreporte");

ALTER TABLE "tb_expo_repaduana" ADD CONSTRAINT "tb_expo_repaduana_FK_2" FOREIGN KEY ("ca_idcosto") REFERENCES "tb_costos" ("ca_idcosto");
