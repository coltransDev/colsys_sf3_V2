
-----------------------------------------------------------------------------
-- tb_bavarianotify
-----------------------------------------------------------------------------

DROP TABLE "tb_bavarianotify" CASCADE;


CREATE TABLE "tb_bavarianotify"
(
	"ca_consecutivo" VARCHAR(10)  NOT NULL,
	"ca_fchenvio" TIMESTAMP,
	"ca_usuenvio" VARCHAR,
	PRIMARY KEY ("ca_consecutivo")
);

COMMENT ON TABLE "tb_bavarianotify" IS '';


SET search_path TO public;