
-----------------------------------------------------------------------------
-- tb_fileimported
-----------------------------------------------------------------------------

DROP TABLE "tb_fileimported" CASCADE;


CREATE TABLE "tb_fileimported"
(
	"ca_idfileheader" INTEGER  NOT NULL,
	"ca_fchimportacion" TIMESTAMP  NOT NULL,
	"ca_content" VARCHAR,
	"ca_usuario" VARCHAR  NOT NULL,
	"ca_procesado" BOOLEAN  NOT NULL,
	"ca_nombre" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_idfileheader","ca_fchimportacion","ca_nombre")
);

COMMENT ON TABLE "tb_fileimported" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_fileheader
-----------------------------------------------------------------------------

DROP TABLE "tb_fileheader" CASCADE;


CREATE TABLE "tb_fileheader"
(
	"ca_idfileheader" serial  NOT NULL,
	"ca_descripcion" VARCHAR  NOT NULL,
	"ca_tipoarchivo" VARCHAR  NOT NULL,
	"ca_separador" VARCHAR  NOT NULL,
	"ca_separadordec" VARCHAR  NOT NULL,
	"ca_fchcreado" TIMESTAMP  NOT NULL,
	"ca_usucreado" VARCHAR  NOT NULL,
	"ca_fchactualizado" TIMESTAMP  NOT NULL,
	"ca_usuactualizado" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_idfileheader")
);

COMMENT ON TABLE "tb_fileheader" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_filecolumns
-----------------------------------------------------------------------------

DROP TABLE "tb_filecolumns" CASCADE;


CREATE TABLE "tb_filecolumns"
(
	"ca_idfileheader" INTEGER  NOT NULL,
	"ca_idcolumna" serial  NOT NULL,
	"ca_columna" VARCHAR  NOT NULL,
	"ca_label" VARCHAR  NOT NULL,
	"ca_mascara" VARCHAR  NOT NULL,
	"ca_tipo" VARCHAR  NOT NULL,
	"ca_longitud" INTEGER  NOT NULL,
	"ca_precision" INTEGER  NOT NULL,
	"ca_idregistro" INTEGER  NOT NULL,
	"ca_fchcreado" TIMESTAMP  NOT NULL,
	"ca_usucreado" VARCHAR  NOT NULL,
	"ca_fchactualizado" TIMESTAMP  NOT NULL,
	"ca_usuactualizado" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_idcolumna")
);

COMMENT ON TABLE "tb_filecolumns" IS '';


SET search_path TO public;
ALTER TABLE "tb_fileimported" ADD CONSTRAINT "tb_fileimported_FK_1" FOREIGN KEY ("ca_idfileheader") REFERENCES "tb_fileheader" ("ca_idfileheader");

ALTER TABLE "tb_filecolumns" ADD CONSTRAINT "tb_filecolumns_FK_1" FOREIGN KEY ("ca_idfileheader") REFERENCES "tb_fileheader" ("ca_idfileheader");
