
-----------------------------------------------------------------------------
-- helpdesk.tb_groups
-----------------------------------------------------------------------------

DROP TABLE "helpdesk.tb_groups" CASCADE;

DROP SEQUENCE "helpdesk.tb_groups_id";

CREATE SEQUENCE "helpdesk.tb_groups_id";


CREATE TABLE "helpdesk.tb_groups"
(
	"ca_idgroup" INTEGER  NOT NULL,
	"ca_iddepartament" INTEGER  NOT NULL,
	"ca_name" VARCHAR,
	PRIMARY KEY ("ca_idgroup")
);

COMMENT ON TABLE "helpdesk.tb_groups" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- helpdesk.tb_tickets
-----------------------------------------------------------------------------

DROP TABLE "helpdesk.tb_tickets" CASCADE;

DROP SEQUENCE "helpdesk.tb_tickets_id";

CREATE SEQUENCE "helpdesk.tb_tickets_id";


CREATE TABLE "helpdesk.tb_tickets"
(
	"ca_idticket" INTEGER  NOT NULL,
	"ca_idgroup" INTEGER  NOT NULL,
	"ca_idproject" INTEGER  NOT NULL,
	"ca_login" VARCHAR,
	"ca_title" VARCHAR,
	"ca_text" VARCHAR,
	"ca_priority" VARCHAR,
	"ca_opened" TIMESTAMP,
	"ca_type" VARCHAR,
	"ca_assignedto" VARCHAR,
	"ca_action" VARCHAR,
	PRIMARY KEY ("ca_idticket")
);

COMMENT ON TABLE "helpdesk.tb_tickets" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- helpdesk.tb_responses
-----------------------------------------------------------------------------

DROP TABLE "helpdesk.tb_responses" CASCADE;

DROP SEQUENCE "helpdesk.tb_responses_id";

CREATE SEQUENCE "helpdesk.tb_responses_id";


CREATE TABLE "helpdesk.tb_responses"
(
	"ca_idresponse" INTEGER  NOT NULL,
	"ca_idticket" INTEGER  NOT NULL,
	"ca_responsetoresponse" INTEGER  NOT NULL,
	"ca_login" VARCHAR  NOT NULL,
	"ca_createdat" TIMESTAMP  NOT NULL,
	"ca_text" VARCHAR,
	PRIMARY KEY ("ca_idresponse")
);

COMMENT ON TABLE "helpdesk.tb_responses" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- helpdesk.tb_projects
-----------------------------------------------------------------------------

DROP TABLE "helpdesk.tb_projects" CASCADE;

DROP SEQUENCE "helpdesk.tb_projects_id";

CREATE SEQUENCE "helpdesk.tb_projects_id";


CREATE TABLE "helpdesk.tb_projects"
(
	"ca_idproject" INTEGER  NOT NULL,
	"ca_idgroup" INTEGER  NOT NULL,
	"ca_name" VARCHAR  NOT NULL,
	"ca_description" VARCHAR,
	"ca_active" VARCHAR,
	PRIMARY KEY ("ca_idproject")
);

COMMENT ON TABLE "helpdesk.tb_projects" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- helpdesk.tb_usersgroups
-----------------------------------------------------------------------------

DROP TABLE "helpdesk.tb_usersgroups" CASCADE;


CREATE TABLE "helpdesk.tb_usersgroups"
(
	"ca_idgroup" INTEGER  NOT NULL,
	"ca_login" VARCHAR  NOT NULL,
	PRIMARY KEY ("ca_idgroup","ca_login")
);

COMMENT ON TABLE "helpdesk.tb_usersgroups" IS '';


SET search_path TO public;
ALTER TABLE "helpdesk.tb_groups" ADD CONSTRAINT "helpdesk.tb_groups_FK_1" FOREIGN KEY ("ca_iddepartament") REFERENCES "control.tb_departamentos" ("ca_iddepartamento");

ALTER TABLE "helpdesk.tb_tickets" ADD CONSTRAINT "helpdesk.tb_tickets_FK_1" FOREIGN KEY ("ca_idgroup") REFERENCES "helpdesk.tb_groups" ("ca_idgroup");

ALTER TABLE "helpdesk.tb_tickets" ADD CONSTRAINT "helpdesk.tb_tickets_FK_2" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");

ALTER TABLE "helpdesk.tb_tickets" ADD CONSTRAINT "helpdesk.tb_tickets_FK_3" FOREIGN KEY ("ca_idproject") REFERENCES "helpdesk.tb_projects" ("ca_idproject");

ALTER TABLE "helpdesk.tb_responses" ADD CONSTRAINT "helpdesk.tb_responses_FK_1" FOREIGN KEY ("ca_idticket") REFERENCES "helpdesk.tb_tickets" ("ca_idticket");

ALTER TABLE "helpdesk.tb_responses" ADD CONSTRAINT "helpdesk.tb_responses_FK_2" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");

ALTER TABLE "helpdesk.tb_projects" ADD CONSTRAINT "helpdesk.tb_projects_FK_1" FOREIGN KEY ("ca_idgroup") REFERENCES "helpdesk.tb_groups" ("ca_idgroup");

ALTER TABLE "helpdesk.tb_usersgroups" ADD CONSTRAINT "helpdesk.tb_usersgroups_FK_1" FOREIGN KEY ("ca_idgroup") REFERENCES "helpdesk.tb_groups" ("ca_idgroup");

ALTER TABLE "helpdesk.tb_usersgroups" ADD CONSTRAINT "helpdesk.tb_usersgroups_FK_2" FOREIGN KEY ("ca_login") REFERENCES "control.tb_usuarios" ("ca_login");
