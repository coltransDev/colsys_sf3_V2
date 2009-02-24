
-----------------------------------------------------------------------------
-- tb_reportes
-----------------------------------------------------------------------------

DROP TABLE "tb_reportes" CASCADE;


CREATE TABLE "tb_reportes"
(
	"ca_idreporte" serial  NOT NULL,
	"ca_fchreporte" DATE,
	"ca_consecutivo" VARCHAR(10),
	"ca_version" INTEGER,
	"ca_idcotizacion" INTEGER,
	"ca_origen" VARCHAR,
	"ca_destino" VARCHAR,
	"ca_impoexpo" VARCHAR,
	"ca_fchdespacho" DATE,
	"ca_idagente" INTEGER,
	"ca_incoterms" VARCHAR,
	"ca_mercancia_desc" VARCHAR,
	"ca_idproveedor" VARCHAR,
	"ca_orden_prov" VARCHAR,
	"ca_idconcliente" INTEGER,
	"ca_orden_clie" VARCHAR,
	"ca_confirmar_clie" VARCHAR,
	"ca_idrepresentante" INTEGER,
	"ca_informar_repr" VARCHAR,
	"ca_idconsignatario" INTEGER,
	"ca_informar_cons" VARCHAR,
	"ca_idnotify" INTEGER,
	"ca_informar_noti" VARCHAR,
	"ca_notify" INTEGER,
	"ca_transporte" VARCHAR,
	"ca_modalidad" VARCHAR,
	"ca_seguro" VARCHAR,
	"ca_liberacion" VARCHAR,
	"ca_tiempocredito" VARCHAR,
	"ca_preferencias_clie" VARCHAR,
	"ca_instrucciones" VARCHAR,
	"ca_idlinea" INTEGER,
	"ca_idconsignar" INTEGER,
	"ca_idconsignarmaster" INTEGER,
	"ca_idbodega" INTEGER,
	"ca_mastersame" VARCHAR,
	"ca_continuacion" VARCHAR,
	"ca_continuacion_dest" VARCHAR,
	"ca_continuacion_conf" VARCHAR,
	"ca_etapa_actual" VARCHAR,
	"ca_login" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	"ca_fchanulado" TIMESTAMP,
	"ca_usuanulado" VARCHAR,
	"ca_fchcerrado" TIMESTAMP,
	"ca_usucerrado" VARCHAR,
	"ca_colmas" VARCHAR,
	"ca_propiedades" VARCHAR,
	PRIMARY KEY ("ca_idreporte")
);

COMMENT ON TABLE "tb_reportes" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repavisos
-----------------------------------------------------------------------------

DROP TABLE "tb_repavisos" CASCADE;


CREATE TABLE "tb_repavisos"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idemail" INTEGER  NOT NULL,
	"ca_introduccion" VARCHAR,
	"ca_fchsalida" DATE,
	"ca_fchllegada" DATE,
	"ca_fchcontinuacion" VARCHAR,
	"ca_piezas" VARCHAR,
	"ca_peso" VARCHAR,
	"ca_volumen" VARCHAR,
	"ca_fchenvio" TIMESTAMP,
	"ca_usuenvio" VARCHAR,
	"ca_doctransporte" VARCHAR,
	"ca_idnave" VARCHAR,
	"ca_notas" VARCHAR,
	"ca_etapa" VARCHAR,
	"ca_docmaster" VARCHAR,
	"ca_equipos" VARCHAR,
	"ca_horasalida" TIME,
	"ca_tipo" VARCHAR,
	PRIMARY KEY ("ca_idreporte","ca_idemail")
);

COMMENT ON TABLE "tb_repavisos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repstatus
-----------------------------------------------------------------------------

DROP TABLE "tb_repstatus" CASCADE;


CREATE TABLE "tb_repstatus"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idemail" INTEGER  NOT NULL,
	"ca_fchstatus" DATE,
	"ca_status" VARCHAR,
	"ca_comentarios" VARCHAR,
	"ca_fchrecibo" TIMESTAMP,
	"ca_fchenvio" TIMESTAMP,
	"ca_usuenvio" VARCHAR,
	"ca_etapa" VARCHAR,
	"ca_introduccion" VARCHAR,
	"ca_fchsalida" DATE,
	"ca_fchllegada" DATE,
	"ca_fchcontinuacion" VARCHAR,
	"ca_piezas" VARCHAR,
	"ca_peso" VARCHAR,
	"ca_volumen" VARCHAR,
	"ca_doctransporte" VARCHAR,
	"ca_idnave" VARCHAR,
	"ca_docmaster" VARCHAR,
	"ca_fchreserva" DATE,
	"ca_fchcierrereserva" DATE,
	"ca_equipos" VARCHAR,
	"ca_horasalida" TIME,
	"ca_horallegada" TIME,
	PRIMARY KEY ("ca_idreporte","ca_idemail")
);

COMMENT ON TABLE "tb_repstatus" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repstatusrespuestas
-----------------------------------------------------------------------------

DROP TABLE "tb_repstatusrespuestas" CASCADE;


CREATE TABLE "tb_repstatusrespuestas"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idemail" INTEGER  NOT NULL,
	"ca_idrepstatusrespuestas" INTEGER  NOT NULL,
	"ca_respuesta" VARCHAR,
	"ca_email" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	PRIMARY KEY ("ca_idrepstatusrespuestas")
);

COMMENT ON TABLE "tb_repstatusrespuestas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repequipos
-----------------------------------------------------------------------------

DROP TABLE "tb_repequipos" CASCADE;


CREATE TABLE "tb_repequipos"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_idconcepto" INTEGER  NOT NULL,
	"ca_cantidad" NUMERIC,
	"ca_idequipo" VARCHAR(12),
	"ca_observaciones" VARCHAR,
	PRIMARY KEY ("ca_idreporte","ca_idconcepto")
);

COMMENT ON TABLE "tb_repequipos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repgastos
-----------------------------------------------------------------------------

DROP TABLE "tb_repgastos" CASCADE;


CREATE TABLE "tb_repgastos"
(
	"oid" INTEGER  NOT NULL,
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
	PRIMARY KEY ("oid")
);

COMMENT ON TABLE "tb_repgastos" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repseguro
-----------------------------------------------------------------------------

DROP TABLE "tb_repseguro" CASCADE;


CREATE TABLE "tb_repseguro"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_vlrasegurado" NUMERIC  NOT NULL,
	"ca_idmoneda_vlr" VARCHAR  NOT NULL,
	"ca_primaventa" NUMERIC  NOT NULL,
	"ca_minimaventa" NUMERIC  NOT NULL,
	"ca_idmoneda_vta" VARCHAR  NOT NULL,
	"ca_obtencionpoliza" NUMERIC  NOT NULL,
	"ca_idmoneda_pol" VARCHAR  NOT NULL,
	"ca_seguro_conf" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_idreporte")
);

COMMENT ON TABLE "tb_repseguro" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repaduanadet
-----------------------------------------------------------------------------

DROP TABLE "tb_repaduanadet" CASCADE;


CREATE TABLE "tb_repaduanadet"
(
	"oid" INTEGER  NOT NULL,
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
	PRIMARY KEY ("oid")
);

COMMENT ON TABLE "tb_repaduanadet" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_reptarifas
-----------------------------------------------------------------------------

DROP TABLE "tb_reptarifas" CASCADE;


CREATE TABLE "tb_reptarifas"
(
	"oid" INTEGER  NOT NULL,
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
	"ca_observaciones" VARCHAR(255)  NOT NULL,
	"ca_fchcreado" DATE,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" DATE,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("oid")
);

COMMENT ON TABLE "tb_reptarifas" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repaduana
-----------------------------------------------------------------------------

DROP TABLE "tb_repaduana" CASCADE;


CREATE TABLE "tb_repaduana"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_coordinador" VARCHAR  NOT NULL,
	"ca_transnacarga" VARCHAR  NOT NULL,
	"ca_transnatipo" VARCHAR  NOT NULL,
	"ca_instrucciones" VARCHAR,
	"ca_fchcreado" TIMESTAMP,
	"ca_usucreado" VARCHAR,
	"ca_fchactualizado" TIMESTAMP,
	"ca_usuactualizado" VARCHAR,
	PRIMARY KEY ("ca_idreporte")
);

COMMENT ON TABLE "tb_repaduana" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_repexpo
-----------------------------------------------------------------------------

DROP TABLE "tb_repexpo" CASCADE;


CREATE TABLE "tb_repexpo"
(
	"ca_idreporte" INTEGER  NOT NULL,
	"ca_peso" NUMERIC,
	"ca_volumen" NUMERIC,
	"ca_piezas" VARCHAR,
	"ca_dimensiones" VARCHAR,
	"ca_valorcarga" NUMERIC,
	"ca_anticipo" VARCHAR,
	"ca_idsia" INTEGER,
	"ca_tipoexpo" INTEGER,
	"ca_idlineaterrestre" INTEGER,
	"ca_motonave" VARCHAR,
	"ca_emisionbl" VARCHAR,
	"ca_datosbl" VARCHAR,
	"ca_numbl" INTEGER,
	PRIMARY KEY ("ca_idreporte")
);

COMMENT ON TABLE "tb_repexpo" IS '';


SET search_path TO public;
ALTER TABLE "tb_reportes" ADD CONSTRAINT "tb_reportes_FK_1" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");

ALTER TABLE "tb_reportes" ADD CONSTRAINT "tb_reportes_FK_2" FOREIGN KEY ("ca_idlinea") REFERENCES "tb_transporlineas" ("ca_idlinea");

ALTER TABLE "tb_reportes" ADD CONSTRAINT "tb_reportes_FK_3" FOREIGN KEY ("ca_idproveedor") REFERENCES "tb_terceros" ("ca_idtercero");

ALTER TABLE "tb_reportes" ADD CONSTRAINT "tb_reportes_FK_4" FOREIGN KEY ("ca_idagente") REFERENCES "tb_agentes" ("ca_idagente");

ALTER TABLE "tb_reportes" ADD CONSTRAINT "tb_reportes_FK_5" FOREIGN KEY ("ca_idbodega") REFERENCES "tb_bodegas" ("ca_idbodega");

ALTER TABLE "tb_repavisos" ADD CONSTRAINT "tb_repavisos_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repavisos" ADD CONSTRAINT "tb_repavisos_FK_2" FOREIGN KEY ("ca_idemail") REFERENCES "tb_emails" ("ca_idemail");

ALTER TABLE "tb_repstatus" ADD CONSTRAINT "tb_repstatus_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repstatus" ADD CONSTRAINT "tb_repstatus_FK_2" FOREIGN KEY ("ca_idemail") REFERENCES "tb_emails" ("ca_idemail");

ALTER TABLE "tb_repstatusrespuestas" ADD CONSTRAINT "tb_repstatusrespuestas_FK_1" FOREIGN KEY ("ca_idreporte","ca_idemail") REFERENCES "tb_repstatus" ("ca_idreporte","ca_idemail");

ALTER TABLE "tb_repequipos" ADD CONSTRAINT "tb_repequipos_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repequipos" ADD CONSTRAINT "tb_repequipos_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_repgastos" ADD CONSTRAINT "tb_repgastos_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repgastos" ADD CONSTRAINT "tb_repgastos_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_repgastos" ADD CONSTRAINT "tb_repgastos_FK_3" FOREIGN KEY ("ca_idrecargo") REFERENCES "tb_tiporecargo" ("ca_idrecargo");

ALTER TABLE "tb_repseguro" ADD CONSTRAINT "tb_repseguro_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repaduanadet" ADD CONSTRAINT "tb_repaduanadet_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repaduanadet" ADD CONSTRAINT "tb_repaduanadet_FK_2" FOREIGN KEY ("ca_idcosto") REFERENCES "tb_costos" ("ca_idcosto");

ALTER TABLE "tb_reptarifas" ADD CONSTRAINT "tb_reptarifas_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_reptarifas" ADD CONSTRAINT "tb_reptarifas_FK_2" FOREIGN KEY ("ca_idconcepto") REFERENCES "tb_conceptos" ("ca_idconcepto");

ALTER TABLE "tb_repaduana" ADD CONSTRAINT "tb_repaduana_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");

ALTER TABLE "tb_repexpo" ADD CONSTRAINT "tb_repexpo_FK_1" FOREIGN KEY ("ca_idreporte") REFERENCES "tb_reportes" ("ca_idreporte");
