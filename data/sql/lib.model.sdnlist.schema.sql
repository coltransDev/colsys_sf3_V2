
-----------------------------------------------------------------------------
-- tb_sdn
-----------------------------------------------------------------------------

DROP TABLE "tb_sdn" CASCADE;


CREATE TABLE "tb_sdn"
(
	"ca_uid" NUMERIC  NOT NULL,
	"ca_firstName" VARCHAR,
	"ca_lastName" VARCHAR,
	"ca_title" VARCHAR,
	"ca_sdnType" VARCHAR,
	"ca_remarks" VARCHAR,
	PRIMARY KEY ("ca_uid")
);

COMMENT ON TABLE "tb_sdn" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_sdnid
-----------------------------------------------------------------------------

DROP TABLE "tb_sdnid" CASCADE;


CREATE TABLE "tb_sdnid"
(
	"ca_uid" NUMERIC  NOT NULL,
	"ca_uid_id" NUMERIC  NOT NULL,
	"ca_idType" VARCHAR,
	"ca_idNumber" VARCHAR,
	"ca_idCountry" VARCHAR,
	"ca_issueDate" VARCHAR,
	"ca_expirationDate" VARCHAR,
	PRIMARY KEY ("ca_uid","ca_uid_id")
);

COMMENT ON TABLE "tb_sdnid" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_sdnaka
-----------------------------------------------------------------------------

DROP TABLE "tb_sdnaka" CASCADE;


CREATE TABLE "tb_sdnaka"
(
	"ca_uid" NUMERIC  NOT NULL,
	"ca_uid_aka" NUMERIC  NOT NULL,
	"ca_type" VARCHAR,
	"ca_category" VARCHAR,
	"ca_firstName" VARCHAR,
	"ca_lastName" VARCHAR,
	PRIMARY KEY ("ca_uid","ca_uid_aka")
);

COMMENT ON TABLE "tb_sdnaka" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_sdnaddress
-----------------------------------------------------------------------------

DROP TABLE "tb_sdnaddress" CASCADE;


CREATE TABLE "tb_sdnaddress"
(
	"ca_uid" NUMERIC  NOT NULL,
	"ca_uid_address" NUMERIC  NOT NULL,
	"ca_address1" VARCHAR,
	"ca_address2" VARCHAR,
	"ca_address3" VARCHAR,
	"ca_city" VARCHAR,
	"ca_state" VARCHAR,
	"ca_postal" VARCHAR,
	"ca_country" VARCHAR,
	PRIMARY KEY ("ca_uid","ca_uid_address")
);

COMMENT ON TABLE "tb_sdnaddress" IS '';


SET search_path TO public;
ALTER TABLE "tb_sdnid" ADD CONSTRAINT "tb_sdnid_FK_1" FOREIGN KEY ("ca_uid") REFERENCES "tb_sdn" ("ca_uid");

ALTER TABLE "tb_sdnaka" ADD CONSTRAINT "tb_sdnaka_FK_1" FOREIGN KEY ("ca_uid") REFERENCES "tb_sdn" ("ca_uid");

ALTER TABLE "tb_sdnaddress" ADD CONSTRAINT "tb_sdnaddress_FK_1" FOREIGN KEY ("ca_uid") REFERENCES "tb_sdn" ("ca_uid");
